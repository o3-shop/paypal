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

use OxidEsales\Eshop\Core\Registry as EshopRegistry;

$data = array(
    'class'         => \OxidEsales\PayPalModule\Controller\ExpressCheckoutDispatcher::class,
    'action'        => 'setExpressCheckout',
    'articles'      => array(
        0 => array(
            'oxid'    => 'testUserLogged1',
            'oxprice' => 10,
            'oxvat'   => 10,
            'amount'  => 3,
        ),
    ),
    'groups'        => array(
        0 => array(
            'oxid'           => 'UserLoggedTestGroup',
            'oxactive'       => 1,
            'oxtitle'        => 'checkoutTestGroup',
            'oxobject2group' => array('TestLoggedUser', 'oxidpaypal'),
        ),
    ),
    'user'          => array(
        'oxid'        => 'TestLoggedUser',
        'oxactive'    => 1,
        'oxusername'  => 'testuser@email.com',
        'oxfname'     => 'Name',
        'oxlname'     => 'LName',
        'oxstreet'    => 'Street',
        'oxstreetnr'  => 'StreetNr',
        'oxcity'      => 'City',
        'oxzip'       => 'ZipCode',
        'oxfon'       => 'PhoneNr',
        'oxcountryid' => '8f241f11096877ac0.98748826', // United States
        'oxstateid'   => 'IL', // Illinois
        'address'     => array(
            'oxid'        => 'TestUserAddressId',
            'oxfname'     => 'AddressName',
            'oxlname'     => 'AddressLName',
            'oxstreet'    => 'AddressStreet',
            'oxstreetnr'  => 'AddressStreetNr',
            'oxcity'      => 'AddressCity',
            'oxzip'       => 'AddressZipCode',
            'oxfon'       => 'AddressPhoneNr',
            'oxcountryid' => 'a7c40f6323c4bfb36.59919433', // Italy
        ),
    ),
    'config'        => array(
        'blSeoMode' => false,
        'sOEPayPalTransactionMode' => 'Sale',
    ),
    'session'       => array(
        'deladrid' => 'TestUserAddressId',
    ),
    'requestToShop' => array(
        'displayCartInPayPal' => true,
    ),
    'expected'      => array(
        'requestToPayPal' => array(
            'VERSION'                            => '84.0',
            'PWD'                                => EshopRegistry::getConfig()->getConfigParam('sOEPayPalSandboxPassword'),
            'USER'                               => EshopRegistry::getConfig()->getConfigParam('sOEPayPalSandboxUsername'),
            'SIGNATURE'                          => EshopRegistry::getConfig()->getConfigParam('sOEPayPalSandboxSignature'),
            'CALLBACKVERSION'                    => '84.0',
            'LOCALECODE'                         => 'de_DE',
            'SOLUTIONTYPE'                       => 'Mark',
            'BRANDNAME'                          => 'PayPal Testshop',
            'CARTBORDERCOLOR'                    => '2b8da4',
            'RETURNURL'                          => '{SHOP_URL}index.php?lang=0&sid=&rtoken=token&shp={SHOP_ID}&cl=oepaypalexpresscheckoutdispatcher&fnc=getExpressCheckoutDetails',
            'CANCELURL'                          => '{SHOP_URL}index.php?lang=0&sid=&rtoken=token&shp={SHOP_ID}&cl=basket',
            'PAYMENTREQUEST_0_PAYMENTACTION'     => 'Sale',
            'CALLBACK'                           => '{SHOP_URL}index.php?lang=0&sid=&rtoken=token&shp={SHOP_ID}&cl=oepaypalexpresscheckoutdispatcher&fnc=processCallBack',
            'CALLBACKTIMEOUT'                    => '6',
            'NOSHIPPING'                         => '2',
            'PAYMENTREQUEST_0_AMT'               => '27.27',
            'PAYMENTREQUEST_0_CURRENCYCODE'      => 'EUR',
            'PAYMENTREQUEST_0_ITEMAMT'           => '27.27',
            'PAYMENTREQUEST_0_SHIPPINGAMT'       => '0.00',
            'PAYMENTREQUEST_0_SHIPDISCAMT'       => '0.00',
            'L_SHIPPINGOPTIONISDEFAULT0'         => 'true',
            'L_SHIPPINGOPTIONNAME0'              => '#1',
            'L_SHIPPINGOPTIONAMOUNT0'            => '0.00',
            'PAYMENTREQUEST_0_DESC'              => 'Ihre Bestellung bei PayPal Testshop in Höhe von 27,27 EUR',
            'PAYMENTREQUEST_0_CUSTOM'            => 'Ihre Bestellung bei PayPal Testshop in Höhe von 27,27 EUR',
            'MAXAMT'                             => '58.27',
            'L_PAYMENTREQUEST_0_NAME0'           => '',
            'L_PAYMENTREQUEST_0_AMT0'            => '9.09',
            'L_PAYMENTREQUEST_0_QTY0'            => '3',
            'L_PAYMENTREQUEST_0_ITEMURL0'        => '{SHOP_URL}index.php?cl=details&amp;anid=testUserLogged1',
            'L_PAYMENTREQUEST_0_NUMBER0'         => '',
            'EMAIL'                              => 'testuser@email.com',
            'PAYMENTREQUEST_0_SHIPTONAME'        => 'AddressName AddressLName',
            'PAYMENTREQUEST_0_SHIPTOSTREET'      => 'AddressStreet AddressStreetNr',
            'PAYMENTREQUEST_0_SHIPTOCITY'        => 'AddressCity',
            'PAYMENTREQUEST_0_SHIPTOZIP'         => 'AddressZipCode',
            'PAYMENTREQUEST_0_SHIPTOPHONENUM'    => 'AddressPhoneNr',
            'PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE' => 'IT',
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
