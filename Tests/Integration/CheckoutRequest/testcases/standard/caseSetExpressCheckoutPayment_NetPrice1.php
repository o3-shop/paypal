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

/**
 * Price enter mode: brut
 * Price view mode: net
 *
 * In costs there is wrapping.
 */
$data = array(
    'class'         => \OxidEsales\PayPalModule\Controller\StandardDispatcher::class,
    'action'        => 'setExpressCheckout',
    'articles'      => array(
        0 => array(
            'oxid'    => '_testId1',
            'oxprice' => 119,
            'oxvat'   => 19,
            'amount'  => 10,
        ),
        1 => array(
            'oxid'    => '_testId2',
            'oxprice' => 11.9,
            'oxvat'   => 19,
            'amount'  => 100,
        ),
    ),
    'costs'         => array(
        'wrapping' => array(
            0 => array(
                'oxtype'     => 'WRAP',
                'oxname'     => 'testWrap9001',
                'oxprice'    => 11.9,
                'oxactive'   => 1,
                'oxarticles' => array('_testId1')
            ),
        ),
    ),
    'config'        => array(
        'sOEPayPalSandboxUsername'  => 'testUser',
        'sOEPayPalSandboxPassword'  => 'testPassword',
        'sOEPayPalSandboxSignature' => 'testSignature',
        'sOEPayPalTransactionMode'  => 'Authorization',
        'blSeoMode'                 => false,
        'blShowNetPrice'            => true,
    ),
    'requestToShop' => array(
        'displayCartInPayPal' => true,
    ),
    'expected'      => array(
        'requestToPayPal' => array(
            'VERSION'                            => '84.0',
            'PWD'                                => 'testPassword',
            'USER'                               => 'testUser',
            'SIGNATURE'                          => 'testSignature',
            'CALLBACKVERSION'                    => '84.0',
            'LOCALECODE'                         => 'de_DE',
            'SOLUTIONTYPE'                       => 'Mark',
            'BRANDNAME'                          => 'PayPal Testshop',
            'CARTBORDERCOLOR'                    => '2b8da4',
            'RETURNURL'                          => '{SHOP_URL}index.php?lang=0&sid=&rtoken=token&shp={SHOP_ID}&cl=oepaypalstandarddispatcher&fnc=getExpressCheckoutDetails',
            'CANCELURL'                          => '{SHOP_URL}index.php?lang=0&sid=&rtoken=token&shp={SHOP_ID}&cl=payment',
            'PAYMENTREQUEST_0_PAYMENTACTION'     => 'Authorization',
            'NOSHIPPING'                         => '0',
            'ADDROVERRIDE'                       => '1',
            'PAYMENTREQUEST_0_TAXAMT'            => '399.00',
            'PAYMENTREQUEST_0_AMT'               => '2499.00',
            'PAYMENTREQUEST_0_CURRENCYCODE'      => 'EUR',
            'PAYMENTREQUEST_0_ITEMAMT'           => '2100.00',
            'PAYMENTREQUEST_0_SHIPPINGAMT'       => '0.00',
            'PAYMENTREQUEST_0_SHIPDISCAMT'       => '0.00',
            'L_SHIPPINGOPTIONISDEFAULT0'         => 'true',
            'L_SHIPPINGOPTIONNAME0'              => '#1',
            'L_SHIPPINGOPTIONAMOUNT0'            => '0.00',
            'PAYMENTREQUEST_0_DESC'              => 'Ihre Bestellung bei PayPal Testshop in Höhe von 2.499,00 EUR',
            'PAYMENTREQUEST_0_CUSTOM'            => 'Ihre Bestellung bei PayPal Testshop in Höhe von 2.499,00 EUR',
            'MAXAMT'                             => '2500.00',
            'L_PAYMENTREQUEST_0_NAME0'           => '',
            'L_PAYMENTREQUEST_0_AMT0'            => '100.00',
            'L_PAYMENTREQUEST_0_QTY0'            => '10',
            'L_PAYMENTREQUEST_0_ITEMURL0'        => '{SHOP_URL}index.php?cl=details&amp;anid=_testId1',
            'L_PAYMENTREQUEST_0_NUMBER0'         => '',
            'L_PAYMENTREQUEST_0_NAME1'           => '',
            'L_PAYMENTREQUEST_0_AMT1'            => '10.00',
            'L_PAYMENTREQUEST_0_QTY1'            => '100',
            'L_PAYMENTREQUEST_0_ITEMURL1'        => '{SHOP_URL}index.php?cl=details&amp;anid=_testId2',
            'L_PAYMENTREQUEST_0_NUMBER1'         => '',
            'L_PAYMENTREQUEST_0_NAME2'           => 'Geschenkverpackung',
            'L_PAYMENTREQUEST_0_AMT2'            => '100.00',
            'L_PAYMENTREQUEST_0_QTY2'            => '1',
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
