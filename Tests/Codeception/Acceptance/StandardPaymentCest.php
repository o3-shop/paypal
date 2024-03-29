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

namespace OxidEsales\PayPalModule\Tests\Codeception\Acceptance;

use Codeception\Util\Fixtures;
use OxidEsales\Codeception\Page\Checkout\ThankYou;
use OxidEsales\Codeception\Step\Basket;
use OxidEsales\Codeception\Page\Checkout\PaymentCheckout;
use OxidEsales\PayPalModule\Tests\Codeception\AcceptanceTester;
use OxidEsales\PayPalModule\Tests\Codeception\Page\PayPalLogin;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * @group oepaypal
 * @group oepaypal_standard
 * @group oepaypal_standard_checkout
 *
 * Tests for checkout with regular payment method 'oxidpaypal'
 */
class StandardPaymentCest extends BaseCest
{
    /**
     * @group oepaypal_mandatory_test_with_graphql
     */
    public function checkoutWithPaypalStandard(AcceptanceTester $I)
    {
        $I->wantToTest('checking out as logged in user with PayPal as payment method. Shop login and PayPal login mail are different.');

        //order will be captured and finalized in shop
        $I->updateConfigInDatabase('sOEPayPalTransactionMode', 'Sale', 'str');

        $this->proceedToPaymentStep($I, Fixtures::get('userName'));

        $paymentPage = new PaymentCheckout($I);
        $paymentPage = $paymentPage->selectPayment('oxidpaypal');
        $I->click($paymentPage->nextStepButton);

        $loginPage = new PayPalLogin($I);
        $orderCheckout = $loginPage->checkoutWithStandardPayPal($_ENV['sBuyerLogin'], $_ENV['sBuyerPassword']);
        $orderCheckout->submitOrder();

        $thankYouPage = new ThankYou($I);
        $orderNumber = $thankYouPage->grabOrderNumber();
        $I->assertGreaterThan(1, $orderNumber);

        $I->seeInDataBase(
            'oxorder',
            [
                'OXORDERNR' => $orderNumber,
                'OXTOTALORDERSUM' => '119.6',
                'OXBILLFNAME' => Fixtures::get('details')['firstname'],
                'OXBILLCITY' => Fixtures::get('details')['oxcity'],
                'OXDELCITY' => ''
            ]
        );

        //Order was captured, so it should be marked as paid
        $oxPaid = $I->grabFromDatabase('oxorder', 'oxpaid', ['OXORDERNR' => $orderNumber]);
        $I->assertStringStartsWith(date('Y-m-d'), $oxPaid);
    }

    public function checkoutWithPaypalStandardSameUserData(AcceptanceTester $I): void
    {
        $I->wantToTest('checking out as logged in user with PayPal as payment method. Shop login and PayPal login mail are the same.');

        //order will be only authorized
        $I->updateConfigInDatabase('sOEPayPalTransactionMode', 'Authorization', 'str');

        $this->setUserDataSameAsPayPal($I);
        $this->proceedToPaymentStep($I, $_ENV['sBuyerLogin']);

        $paymentPage = new PaymentCheckout($I);
        $paymentPage = $paymentPage->selectPayment('oxidpaypal');
        $I->click($paymentPage->nextStepButton);

        $loginPage = new PayPalLogin($I);
        $orderCheckout = $loginPage->checkoutWithStandardPayPal($_ENV['sBuyerLogin'], $_ENV['sBuyerPassword']);
        $orderCheckout->submitOrder();

        $thankYouPage = new ThankYou($I);
        $orderNumber = $thankYouPage->grabOrderNumber();
        $I->assertGreaterThan(1, $orderNumber);

        $orderId = $I->grabFromDatabase('oxorder', 'oxid', ['OXORDERNR' => $orderNumber]);

        $I->seeInDataBase(
            'oxorder',
            [
                'OXID' => $orderId,
                'OXTOTALORDERSUM' => '119.6',
                'OXBILLFNAME' => $_ENV['sBuyerFirstName'],
                'OXBILLCITY' => 'Freiburg',
                'OXDELCITY' => ''
            ]
        );

        //Order was only authorized, so it should not yet be marked as paid
        $oxPaid = $I->grabFromDatabase('oxorder', 'oxpaid', ['OXORDERNR' => $orderNumber]);
        $I->assertStringStartsWith(date('0000-00-00'), $oxPaid);
    }

    public function changeBasketDuringCheckout(AcceptanceTester $I)
    {
        $I->wantToTest('changing basket contents after payment was authorized');

        $this->proceedToPaymentStep($I, Fixtures::get('userName'));

        $paymentPage = new PaymentCheckout($I);
        $paymentPage = $paymentPage->selectPayment('oxidpaypal');
        $I->click($paymentPage->nextStepButton);

        $loginPage = new PayPalLogin($I);
        $loginPage->checkoutWithStandardPayPal($_ENV['sBuyerLogin'], $_ENV['sBuyerPassword']);

        $I->amOnUrl($this->getShopUrl() . '/en/cart');

        $product = Fixtures::get('product');
        $basket = new Basket($I);
        $basket->addProductToBasketAndOpenBasket($product['id'], $product['amount'], 'basket');

        //finalize order in previous tab
        $I->amOnUrl($this->getShopUrl() . '?cl=order');

        $orderNumber = $this->finalizeOrderInOrderStep($I);
        $I->assertGreaterThan(1, $orderNumber);

        $shopOrderId = $I->grabFromDatabase(
            'oxorder',
            'oxid',
            [
                'OXORDERNR' => $orderNumber,
                'OXTOTALORDERSUM' => '239.2'
            ]
        );
        $I->seeInDatabase(
            'oepaypal_order',
            [
                'OEPAYPAL_ORDERID' => $shopOrderId,
                'OEPAYPAL_PAYMENTSTATUS' => 'completed',
                'OEPAYPAL_CAPTUREDAMOUNT' => '239.20'
            ]
        );
    }
}
