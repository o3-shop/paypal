<?php
/**
 * This file is part of O3-Shop Paypal module.
 *
 * O3-Shop is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, version 3.
 *
 * O3-Shop is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with O3-Shop.  If not, see <http://www.gnu.org/licenses/>
 *
 * @copyright  Copyright (c) 2022 OXID eSales AG (https://www.oxid-esales.com)
 * @copyright  Copyright (c) 2022 O3-Shop (https://www.o3-shop.com)
 * @license    https://www.gnu.org/licenses/gpl-3.0  GNU General Public License 3 (GPLv3)
 */

namespace OxidEsales\PayPalModule\Tests\Unit\Model\Action\Data;

/**
 * Testing \OxidEsales\PayPalModule\Model\Action\Data\OrderRefundActionData class.
 */
class OrderRefundActionDataTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
    public function providerRefundAmount()
    {
        return [
            ['59,92', '59.92'],
            ['59.92', '59.92'],
            ['1000,33', '1000.33'],
            ['10,000,33', '10,000.33']
        ];
    }

    /**
     * Tests setting parameters from request
     *
     * @dataProvider providerRefundAmount
     *
     * @param string $refundAmount
     */
    public function testSettingParameters_FromRequest($refundAmount, $calculatedAmount)
    {
        $transactionId = '123456';
        $type = 'Full';

        $params = array(
            'transaction_id' => $transactionId,
            'refund_amount'  => $refundAmount,
            'refund_type'    => $type,
        );
        $request = $this->_createStub(\OxidEsales\PayPalModule\Core\Request::class, array('getPost' => $params));

        $order = $this->getOrder();

        $actionData = new \OxidEsales\PayPalModule\Model\Action\Data\OrderRefundActionData($request, $order);

        $this->assertEquals($transactionId, $actionData->getTransactionId());
        $this->assertEquals($calculatedAmount, $actionData->getAmount());
        $this->assertEquals($type, $actionData->getType());
    }

    /**
     * Tests getting amount when amount is not set and no amount is passed with request. Should be taken from order
     */
    public function testGetAmount_AmountNotSet_TakenFromOrderPayment()
    {
        $remainingRefundSum = 59.67;

        $payment = $this->_createStub('oePayPalPayPalOrderPayment', array('getRemainingRefundAmount' => $remainingRefundSum));
        $request = $this->_createStub(\OxidEsales\PayPalModule\Core\Request::class, array('getPost' => array()));

        $order = $this->getOrder();

        $mockBuilder = $this->getMockBuilder(\OxidEsales\PayPalModule\Model\Action\Data\OrderRefundActionData::class);
        $mockBuilder->setMethods(['getPaymentBeingRefunded']);
        $mockBuilder->setConstructorArgs([$request, $order]);
        $actionData = $mockBuilder->getMock();
        $actionData->expects($this->any())->method('getPaymentBeingRefunded')->will($this->returnValue($payment));

        $this->assertEquals($remainingRefundSum, $actionData->getAmount());
    }

    /**
     * Test loading of payment by transaction id
     */
    public function testGetPaymentBeingRefunded_LoadedByTransactionId_TransactionIdSet()
    {
        $transactionId = 'test_transId';

        $payment = new \OxidEsales\PayPalModule\Model\OrderPayment();
        $payment->setTransactionId($transactionId);
        $payment->setOrderId('_testOrderId');
        $payment->save();

        $params = array('transaction_id' => $transactionId);
        $request = $this->_createStub(\OxidEsales\PayPalModule\Core\Request::class, array('getPost' => $params));

        $order = $this->getOrder();

        $actionData = new \OxidEsales\PayPalModule\Model\Action\Data\OrderRefundActionData($request, $order);

        $payment = $actionData->getPaymentBeingRefunded();

        $this->assertEquals($transactionId, $payment->getTransactionId());
    }

    /**
     *  Returns Request object with given parameters
     *
     * @param $params
     *
     * @return mixed
     */
    protected function getRequest($params)
    {
        $request = $this->_createStub(\OxidEsales\PayPalModule\Core\Request::class, array('getGet' => $params));

        return $request;
    }

    /**
     *
     */
    protected function getOrder()
    {
        $order = new \OxidEsales\PayPalModule\Model\PayPalOrder();

        return $order;
    }
}