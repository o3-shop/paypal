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

// -------------------------------
// RESOURCE IDENTIFIER = STRING
// -------------------------------
$aLang = array(
    'charset'                                                => 'UTF-8',
    'SHOP_MODULE_GROUP_oepaypal_display'                     => 'Display on PayPal payment page',
    'SHOP_MODULE_GROUP_oepaypal_checkout'                    => 'PayPal integration',
    'SHOP_MODULE_GROUP_oepaypal_payment'                     => 'Shopping cart on PayPal payment page',
    'SHOP_MODULE_GROUP_oepaypal_transaction'                 => 'Capture',
    'SHOP_MODULE_GROUP_oepaypal_api'                         => 'API signature',
    'SHOP_MODULE_GROUP_oepaypal_development'                 => 'Development settings',

    'SHOP_MODULE_sOEPayPalBrandName'                         => 'Name of the shop',
    'HELP_SHOP_MODULE_sOEPayPalBrandName'                    => 'Please enter the name of your shop that shall appear on the PayPal payment page.',
    'SHOP_MODULE_sOEPayPalBorderColor'                       => 'Cart Area Color on the PayPal payment page',
    'HELP_SHOP_MODULE_sOEPayPalBorderColor'                  => 'Please enter the hexadecimal code of the color that shall be used on the PayPal payment page.',

    'SHOP_MODULE_blOEPayPalStandardCheckout'                 => 'PayPal Basis',
    'HELP_SHOP_MODULE_blOEPayPalStandardCheckout'            => 'PayPal will be offered as a payment method at the end of the checkout process. If the customer chooses PayPal, he has to confirm his purchase at the PayPal payment page and will be redirected back to the shop.',
    'SHOP_MODULE_blOEPayPalExpressCheckout'                  => 'PayPal Express',
    'HELP_SHOP_MODULE_blOEPayPalExpressCheckout'             => 'When pushing the PayPal Express button the customer will be led directly to the PayPal payment page, where he has to confirm his purchase. Once this is done he\'ll be redirected to the shop again, and all relevant data for the order will be handed over from PayPal to the shop.',
    'SHOP_MODULE_blOEPayPalGuestBuyRole'                     => 'Enable guest buy role',
    'HELP_SHOP_MODULE_blOEPayPalGuestBuyRole'                => 'The customer has the option to check out without a PayPal account. He can complete the payment first, and then decides if to save his data in a PayPal account for future purchases.',

    'SHOP_MODULE_blOEPayPalSendToPayPal'                     => 'Show shopping cart on PayPal site',
    'HELP_SHOP_MODULE_blOEPayPalSendToPayPal'                => 'After logging in the content of the shopping cart appears in PayPal including product information, prices and shipping costs. During the checkout process the customer can choose if this data should be transferred. Hint: if there are products with a fraction of a quantity (e.g. 1,5) in the shopping cart, the shopping cart will not be submitted to PayPal, no matter if the purchaser activated this option during the checkout.',
    'SHOP_MODULE_blOEPayPalDefaultUserChoice'                => 'Preset customer confirmation',
    'HELP_SHOP_MODULE_blOEPayPalDefaultUserChoice'           => 'During the checkout process the customer has to confirm explicitly that all shopping cart information including products, prices and shipping costs, shall be transferred to PayPal. You can activate the presetting here that the customer confirms data transfer by default.',

    'SHOP_MODULE_sOEPayPalLogoImageOption'                   => 'Shop logo on the PayPal payment page',
    'HELP_SHOP_MODULE_sOEPayPalLogoImageOption'              => 'You can set a shop logo to be shown on the PayPal payment page. It is possible to send a default shop logo, defined in shop\'s configuration file, or send a custom logo file. The logo size should not be bigger than 190px*60px (width*height). Bigger images will be resized and renamed with the file name prefix "resized_". For each different used theme, the logo file has to be located in the /out/{theme}/img directory. If the logo is not shown, please check if the provided filename is correct and if the file exists in the required directory. For the default shop logo, check the "sShopLogo" setting in the config.inc.php file. Add the setting if needed.',

    'SHOP_MODULE_sOEPayPalCustomShopLogoImage'               => 'Custom shop logo for the PayPal payment page',
    'HELP_SHOP_MODULE_sOEPayPalCustomShopLogoImage'          => 'You can use a custom shop logo on the PayPal payment page. You have to save the logo in your shop\'s image directory(/out/{theme}/img) and provide the file name here. For each different used theme, the logo file has to be located in an appropriate directory.',

    'SHOP_MODULE_sOEPayPalLogoImageOption_noLogo'            => 'Don\'t send any shop logo',
    'SHOP_MODULE_sOEPayPalLogoImageOption_shopLogo'          => 'Send default shop logo ',
    'SHOP_MODULE_sOEPayPalLogoImageOption_customLogo'        => 'Send custom shop logo',

    'SHOP_MODULE_sOEPayPalTransactionMode'                   => 'Time of money transfer',
    'HELP_SHOP_MODULE_sOEPayPalTransactionMode'              => 'Select the time when money should be transferred. You\'ll have the option to capture the value on PayPal site immediately automated during the purchase (SALE) or manually shortly before the shipping of the products (AUTH). You can also decide that the time of money transfer is automatically handled by the shop depending on the stock amount of the ordered products (AUTOMATIC).',

    'SHOP_MODULE_sOEPayPalTransactionMode_Automatic'         => 'AUTOMATIC - depending on the stock amount of the ordered products',
    'SHOP_MODULE_sOEPayPalTransactionMode_Sale'              => 'SALE - immediately automated',
    'SHOP_MODULE_sOEPayPalTransactionMode_Authorization'     => 'AUTH - manually before the shipment',
    'SHOP_MODULE_sOEPayPalEmptyStockLevel'                   => 'Remaining stock',
    'HELP_SHOP_MODULE_sOEPayPalEmptyStockLevel'              => 'This value applies to AUTOMATIC and influences, whether AUTH or SALE is used as the time of money transfer. It is checked after an order, whether the stock of one of the products is lower than the defined remaining stock. In this case AUTH is used as the transfer method, otherwise SALE.',

    'SHOP_MODULE_sOEPayPalUserEmail'                         => 'E-mail address of PayPal user',
    'SHOP_MODULE_sOEPayPalUsername'                          => 'API user name',
    'HELP_SHOP_MODULE_sOEPayPalUsername'                     => 'Login to your <a target="_blank" href="https://www.paypal.com/en/cgi-bin/webscr?cmd=_get-api-signature&generic-flow=true">PayPal Account</a> to get your API Signature.',
    'SHOP_MODULE_sOEPayPalPassword'                          => 'API password',
    'SHOP_MODULE_sOEPayPalSignature'                         => 'Signature',

    'SHOP_MODULE_blOEPayPalSandboxMode'                      => 'Activate sandbox mode',
    'SHOP_MODULE_sOEPayPalSandboxUserEmail'                  => 'Sandbox: E-mail address of PayPal user',
    'SHOP_MODULE_sOEPayPalSandboxUsername'                   => 'Sandbox: API user name',
    'HELP_SHOP_MODULE_sOEPayPalSandboxUsername'              => 'Login to your <a target="_blank" href="https://www.sandbox.paypal.com/en/cgi-bin/webscr?cmd=_get-api-signature&generic-flow=true">PayPal Account</a> to get your API Signature for the PayPal Sandbox.',
    'SHOP_MODULE_sOEPayPalSandboxPassword'                   => 'Sandbox: API password',
    'SHOP_MODULE_sOEPayPalSandboxSignature'                  => 'Sandbox: Signature',

    'SHOP_MODULE_blPayPalLoggerEnabled'                      => 'Activate PayPal logging',

    'SHOP_MODULE_blOEPayPalECheckoutInMiniBasket'            => 'Show Express Checkout in the mini cart',
    'HELP_SHOP_MODULE_blOEPayPalECheckoutInMiniBasket'       => 'If PayPal Express is enabled, the PayPal Express button will be displayed in the mini cart.',

    'SHOP_MODULE_blOEPayPalFinalizeOrderOnPayPal'            => 'Finalize order after PayPal checkout',

    'SHOP_MODULE_blOEPayPalECheckoutInDetails'               => 'Show Express Checkout in the products detail page',
    'HELP_SHOP_MODULE_blOEPayPalECheckoutInDetails'          => 'If PayPal Express is enabled, the PayPal Express button will be displayed in the products detail page.',

    'SHOP_MODULE_GROUP_oepaypal_banners'                     => 'Banner settings | Offer your customers PayPal installment payment with 0% effective annual interest. Read <a href="https://www.paypal.com/de/webapps/mpp/installments" target="_blank">more</a>.',
    'SHOP_MODULE_oePayPalClientId'                           => 'Client ID',
    'SHOP_MODULE_oePayPalBannersHideAll'                     => 'Hide installment banner',
    'SHOP_MODULE_oePayPalBannersStartPage'                   => 'Show installment banner on start page',
    'SHOP_MODULE_oePayPalBannersStartPageSelector'           => 'CSS selector of the start page after which the banner is displayed.',
    'HELP_SHOP_MODULE_oePayPalBannersStartPageSelector'      => 'Default values for Flow and Wave themes are: \'#wrapper .row\' and \'#wrapper .container\'. After these CSS selectors the banner is displayed.',
    'SHOP_MODULE_oePayPalBannersCategoryPage'                => 'Show installment banner on category pages',
    'SHOP_MODULE_oePayPalBannersCategoryPageSelector'        => 'CSS selector of the category pages after which the banner is displayed.',
    'HELP_SHOP_MODULE_oePayPalBannersCategoryPageSelector'   => 'Default values for Flow and Wave themes are: \'.page-header\' and \'.page-header\'. After these CSS selectors the banner is displayed.',
    'SHOP_MODULE_oePayPalBannersSearchResultsPage'           => 'Show installment banner on search results pages',
    'SHOP_MODULE_oePayPalBannersSearchResultsPageSelector'   => 'CSS selector of the search results pages after which the banner is displayed.',
    'HELP_SHOP_MODULE_oePayPalBannersSearchResultsPageSelector' => 'Default values for Flow and Wave themes are: \'#content .page-header .clearfix\' and \'.page-header\'. After these CSS selectors the banner is displayed.',
    'SHOP_MODULE_oePayPalBannersProductDetailsPage'          => 'Show installment banner on product details pages',
    'SHOP_MODULE_oePayPalBannersProductDetailsPageSelector'  => 'CSS selector of the product detail pages after which the banner is displayed.',
    'HELP_SHOP_MODULE_oePayPalBannersProductDetailsPageSelector' => 'Default values for Flow and Wave themes are: \'.detailsParams\' and \'#detailsItemsPager\'. After these CSS selectors the banner is displayed.',
    'SHOP_MODULE_oePayPalBannersCheckoutPage'                => 'Show installment banner on checkout pages',
    'SHOP_MODULE_oePayPalBannersCartPageSelector'            => 'CSS selector of the "Cart" page (checkout step 1) after which the banner is displayed.',
    'HELP_SHOP_MODULE_oePayPalBannersCartPageSelector'       => 'Default values for Flow and Wave themes are: \'.cart-buttons\' and \'.cart-buttons\'. After these CSS selectors the banner is displayed.',
    'SHOP_MODULE_oePayPalBannersPaymentPageSelector'         => 'CSS selector of the "Pay" page (checkout step 3) after which the banner is displayed.',
    'HELP_SHOP_MODULE_oePayPalBannersPaymentPageSelector'    => 'Default values for Flow and Wave themes are: \'.checkoutSteps ~ .spacer\' and \'.checkout-steps\'. After these CSS selectors the banner is displayed.',
    'SHOP_MODULE_oePayPalBannersColorScheme'                 => 'Select installment banner\'s color',
    'SHOP_MODULE_oePayPalBannersColorScheme_blue'            => 'blue',
    'SHOP_MODULE_oePayPalBannersColorScheme_black'           => 'black',
    'SHOP_MODULE_oePayPalBannersColorScheme_white'           => 'white',
    'SHOP_MODULE_oePayPalBannersColorScheme_white-no-border' => 'white, no border',
);
