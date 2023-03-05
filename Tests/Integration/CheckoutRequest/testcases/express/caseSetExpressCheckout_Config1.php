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

$data = array(
    'class'         => \OxidEsales\PayPalModule\Controller\ExpressCheckoutDispatcher::class,
    'action'        => 'setExpressCheckout',
    'articles'      => array(
        0 => array(
            'oxid'    => 9001,
            'oxprice' => 100,
            'oxvat'   => 19,
            'amount'  => 33,
        ),
    ),
    'config'        => array(
        'sOEPayPalBrandName'           => 'ShopBrandName',
        'sOEPayPalBorderColor'         => 'testColor',
        'dMaxPayPalDeliveryAmount'     => 50,
        'sOEPayPalLogoImageOption'     => 'customLogo',
        'shopLogo'                     => 'shouldNotBeUsed.ico',
        'sOEPayPalCustomShopLogoImage' => 'favicon.ico',
        'blOEPayPalSendToPayPal'       => false,
        'blOEPayPalSandboxMode'        => true,
        'sOEPayPalUsername'            => 'tesUser',
        'sOEPayPalPassword'            => 'tesPassword',
        'sOEPayPalSignature'           => 'tesSignature',
        'sOEPayPalSandboxUsername'     => 'testSandboxUser',
        'sOEPayPalSandboxPassword'     => 'testSandboxPassword',
        'sOEPayPalSandboxSignature'    => 'testSandboxSignature',
        'sOEPayPalTransactionMode'     => 'Sales',
        'blOEPayPalGuestBuyRole'       => true,
    ),
    'requestToShop' => array(
        'displayCartInPayPal' => false,
    ),
    'expected'      => array(
        'requestToPayPal' => array(
            'VERSION'                            => '84.0',
            'PWD'                                => 'testSandboxPassword',
            'USER'                               => 'testSandboxUser',
            'SIGNATURE'                          => 'testSandboxSignature',
            'CALLBACKVERSION'                    => '84.0',
            'LOCALECODE'                         => 'de_DE',
            'SOLUTIONTYPE'                       => 'Sole',
            'BRANDNAME'                          => 'ShopBrandName',
            'CARTBORDERCOLOR'                    => 'testColor',
            'RETURNURL'                          => '{SHOP_URL}index.php?lang=0&sid=&rtoken=token&shp={SHOP_ID}&cl=oepaypalexpresscheckoutdispatcher&fnc=getExpressCheckoutDetails',
            'CANCELURL'                          => '{SHOP_URL}index.php?lang=0&sid=&rtoken=token&shp={SHOP_ID}&cl=basket',
            'LOGOIMG'                            => '{SHOP_URL}out/azure/img/favicon.ico',
            'PAYMENTREQUEST_0_PAYMENTACTION'     => 'Sales',
            'CALLBACK'                           => '{SHOP_URL}index.php?lang=0&sid=&rtoken=token&shp={SHOP_ID}&cl=oepaypalexpresscheckoutdispatcher&fnc=processCallBack',
            'CALLBACKTIMEOUT'                    => '6',
            'NOSHIPPING'                         => '2',
            'PAYMENTREQUEST_0_AMT'               => '3300.00',
            'PAYMENTREQUEST_0_CURRENCYCODE'      => 'EUR',
            'PAYMENTREQUEST_0_ITEMAMT'           => '3300.00',
            'PAYMENTREQUEST_0_SHIPPINGAMT'       => '0.00',
            'PAYMENTREQUEST_0_SHIPDISCAMT'       => '0.00',
            'L_SHIPPINGOPTIONISDEFAULT0'         => 'true',
            'L_SHIPPINGOPTIONNAME0'              => '#1',
            'L_SHIPPINGOPTIONAMOUNT0'            => '0.00',
            'PAYMENTREQUEST_0_DESC'              => 'Ihre Bestellung bei ShopBrandName in Höhe von 3.300,00 EUR',
            'PAYMENTREQUEST_0_CUSTOM'            => 'Ihre Bestellung bei ShopBrandName in Höhe von 3.300,00 EUR',
            'MAXAMT'                             => '3351.00',
            'L_PAYMENTREQUEST_0_NAME0'           => 'Gesamtsumme:',
            'L_PAYMENTREQUEST_0_AMT0'            => '3300.00',
            'L_PAYMENTREQUEST_0_QTY0'            => '1',

            'EMAIL'                              => 'admin',
            'PAYMENTREQUEST_0_SHIPTONAME'        => 'John Doe',
            'PAYMENTREQUEST_0_SHIPTOSTREET'      => 'Maple Street 10',
            'PAYMENTREQUEST_0_SHIPTOCITY'        => 'Any City',
            'PAYMENTREQUEST_0_SHIPTOZIP'         => '9041',
            'PAYMENTREQUEST_0_SHIPTOPHONENUM'    => '217-8918712',
            'PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE' => 'DE',
            'METHOD'                             => 'SetExpressCheckout',
        ),
        'header'          => array(
            0 => 'POST /cgi-bin/webscr HTTP/1.1',
            1 => 'Content-Type: application/x-www-form-urlencoded',
            2 => 'Host: api-3t.sandbox.paypal.com',
            3 => 'Connection: close',
        )
    )
);
