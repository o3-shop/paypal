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

namespace OxidEsales\PayPalModule\Tests\Unit\Controller\Admin;

use OxidEsales\Eshop\Application\Model\Order;

class OrderPayPalTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
    /**
     *  Setup: Prepare data - create need tables
     */
    protected function setUp(): void
    {
        \OxidEsales\Eshop\Core\DatabaseProvider::getDb()->execute('TRUNCATE `oepaypal_order`');
    }

    /**
     * Adds order to oepaypal_order and oxorder tables and checks if order is created using current PayPal module.
     * Expected result- true
     */
    public function testIsNewPayPalOrder_True()
    {
        $soxId = '_testOrderId';

        $payPalOrderModel = new \OxidEsales\PayPalModule\Model\PayPalOrder();
        $payPalOrderModel->setOrderId($soxId);
        $payPalOrderModel->save();

        $payPalOrderModel->load();

        $mockBuilder = $this->getMockBuilder(Order::class);
        $mockBuilder->setMethods(['getPayPalOrder']);
        $payPalOxOrder = $mockBuilder->getMock();
        $payPalOxOrder->expects($this->any())->method('getPayPalOrder')->will($this->returnValue($payPalOrderModel));

        $mockBuilder = $this->getMockBuilder(\OxidEsales\PayPalModule\Controller\Admin\OrderController::class);
        $mockBuilder->setMethods(['getEditObject', 'isPayPalOrder']);
        $payPalOrder = $mockBuilder->getMock();
        $payPalOrder->expects($this->any())->method('getEditObject')->will($this->returnValue($payPalOxOrder));
        $payPalOrder->expects($this->once())->method('isPayPalOrder')->will($this->returnValue(true));

        $this->assertTrue($payPalOrder->isNewPayPalOrder());
    }

    /**
     * Checks if order is created using current PayPal module.
     * Expected result- false
     */
    public function testIsNewPayPalOrder_False()
    {
        $soxId = '_testOrderId';

        $payPalOrderModel = new \OxidEsales\PayPalModule\Model\PayPalOrder();
        $payPalOrderModel->setOrderId($soxId);
        $payPalOrderModel->save();

        $mockBuilder = $this->getMockBuilder(\OxidEsales\PayPalModule\Model\Order::class);
        $mockBuilder->setMethods(['getPayPalOrder']);
        $payPalOxOrder = $mockBuilder->getMock();
        $payPalOxOrder->expects($this->any())->method('getPayPalOrder')->will($this->returnValue($payPalOrderModel));

        $mockBuilder = $this->getMockBuilder(\OxidEsales\PayPalModule\Controller\Admin\OrderController::class);
        $mockBuilder->setMethods(['getEditObject', 'isPayPalOrder']);
        $payPalOrder = $mockBuilder->getMock();
        $payPalOrder->expects($this->any())->method('getEditObject')->will($this->returnValue($payPalOxOrder));
        $payPalOrder->expects($this->once())->method('isPayPalOrder')->will($this->returnValue(false));

        $this->assertFalse($payPalOrder->isNewPayPalOrder());
    }

    /**
     * Checks if order was made using PayPal payment method.
     * Expected result- true
     */
    public function testIsPayPalOrder_True()
    {
        $payPalOrder = new \OxidEsales\PayPalModule\Controller\Admin\OrderController();
        $soxId = '_testOrderId';

        $session = oxNew(\OxidEsales\Eshop\Core\Session::class);
        $session->setVariable('saved_oxid', $soxId);

        $order = oxNew(\OxidEsales\Eshop\Application\Model\Order::class);
        $order->setId($soxId);
        $order->oxorder__oxpaymenttype = new \OxidEsales\Eshop\Core\Field('oxidpaypal');
        $order->save();

        $this->assertTrue($payPalOrder->isPayPalOrder());
    }

    /**
     * Checks if order was made using PayPal payment method.
     * Expected result- false
     */
    public function testIsPayPalOrder_False()
    {
        $payPalOrder = new \OxidEsales\PayPalModule\Controller\Admin\OrderController();
        $soxId = '_testOrderId';

        $session = oxNew(\OxidEsales\Eshop\Core\Session::class);
        $session->setVariable('saved_oxid', $soxId);

        $order = oxNew(\OxidEsales\Eshop\Application\Model\Order::class);
        $order->setId($soxId);
        $order->oxorder__oxpaymenttype = new \OxidEsales\Eshop\Core\Field('other');
        $order->save();

        $this->assertFalse($payPalOrder->isPayPalOrder());
    }
}
