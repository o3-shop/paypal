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

namespace OxidEsales\PayPalModule\Tests\Unit\Controller;

use OxidEsales\Eshop\Application\Controller\PaymentController;

/**
 * Testing PaymentController class.
 */
class PaymentControllerTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
    /**
     * Test case for PaymentController::validatePayment()
     * Test validatePayment
     */
    public function testValidatePayment()
    {
        // forcing payment id
        $this->setRequestParameter("paymentid", null);

        $view = oxNew(PaymentController::class);
        $this->assertNull($view->validatePayment());

        // forcing payment id
        $this->setRequestParameter("paymentid", "oxidpaypal");
        $this->setRequestParameter("displayCartInPayPal", 1);

        $view = new \OxidEsales\PayPalModule\Controller\PaymentController();
        $this->assertEquals("oepaypalstandarddispatcher?fnc=setExpressCheckout&displayCartInPayPal=1", $view->validatePayment());
        $this->assertEquals("oxidpaypal", $this->getSession()->getVariable("paymentid"));
    }

    /**
     * Test, that the method validatePayment if the order was already checked by paypal.
     */
    public function testValidatePaymentIfCheckedByPayPal()
    {
        // forcing payment id
        $this->setRequestParameter("paymentid", "oxidpaypal");
        $this->setRequestParameter("displayCartInPayPal", 1);

        $mockBuilder = $this->getMockBuilder(\OxidEsales\PayPalModule\Controller\PaymentController::class);
        $mockBuilder->setMethods(['isConfirmedByPayPal']);
        $view = $mockBuilder->getMock();
        $view->expects($this->once())->method("isConfirmedByPayPal")->will($this->returnValue(true));

        $this->assertNull($view->validatePayment());
        $this->assertNull($this->getSession()->getVariable("paymentid"));
    }

    /**
     * Test case for PaymentController::isConfirmedByPayPal()
     * Test isConfirmedByPayPal
     */
    public function testIsConfirmedByPayPal()
    {
        // forcing payment id
        $this->setRequestParameter("paymentid", "oxidpaypal");
        $this->getSession()->setVariable("oepaypal-basketAmount", 129.00);

        $mockBuilder = $this->getMockBuilder(\OxidEsales\Eshop\Core\Price::class);
        $mockBuilder->setMethods(['getBruttoPrice']);
        $price = $mockBuilder->getMock();
        $price->expects($this->once())->method("getBruttoPrice")->will($this->returnValue(129.00));

        $mockBuilder = $this->getMockBuilder(\OxidEsales\Eshop\Application\Model\Basket::class);
        $mockBuilder->setMethods(['getPrice']);
        $basket = $mockBuilder->getMock();
        $basket->expects($this->once())->method("getPrice")->will($this->returnValue($price));

        $view = new \OxidEsales\PayPalModule\Controller\PaymentController();

        $this->assertTrue($view->isConfirmedByPayPal($basket));
    }
}
