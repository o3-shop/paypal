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

namespace OxidEsales\PayPalModule\Tests\Unit\Model;

/**
 * Testing oePayPalOxState class.
 */
class OrderPaymentActionManagerTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
    /**
     * Data provider for testIsActionValidCapture()
     *
     * @return array
     */
    public function isActionValid_dataProvider()
    {
        return array(
            array('capture', 1000, 0, 'Completed', 'refund', true),
            array('capture', 1000, 50, 'Completed', 'refund', true),
            array('capture', 1000, 1000, 'Completed', 'refund', false),
            array('capture', 0, 0, 'Completed', 'refund', false),
            array('capture', 0, 20, 'Completed', 'refund', false),
            array('capture', -30, 20, 'Completed', 'refund', false),
            array('capture', 1000, 0, 'Pending', 'refund', false),
            array('void', 1000, 0, 'Voided', 'refund', false),
            array('authorization', 1000, 0, 'Pending', 'refund', false),
            array('testAction', -99, -8, 'test', 'testAction', false),
        );
    }

    /**
     * Tests isPayPalActionValid
     *
     * @dataProvider isActionValid_dataProvider
     *
     * @param $paymentMethod
     * @param $amount
     * @param $refunded
     * @param $state
     * @param $action
     * @param $isValid
     */
    public function testIsActionAvailable($paymentMethod, $amount, $refunded, $state, $action, $isValid)
    {
        $payment = new \OxidEsales\PayPalModule\Model\OrderPayment();

        $payment->setAction($paymentMethod);
        $payment->setAmount($amount);
        $payment->setRefundedAmount($refunded);
        $payment->setStatus($state);

        $actionManager = new \OxidEsales\PayPalModule\Model\OrderPaymentActionManager();
        $actionManager->setPayment($payment);

        $this->assertEquals($isValid, $actionManager->isActionAvailable($action));
    }
}
