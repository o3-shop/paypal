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

namespace OxidEsales\PayPalModule\Model\Response;

/**
 * PayPal response class for do verify with PayPal
 */
class ResponseDoVerifyWithPayPal extends \OxidEsales\PayPalModule\Model\Response\Response
{
    /**
     * String PayPal sends if all is ok.
     *
     * @var string
     */
    const PAYPAL_ACK = 'VERIFIED';

    /**
     * String PayPal receiver email. It should be same as shop owner credential for PayPal.
     *
     * @var string
     */
    const RECEIVER_EMAIL = 'receiver_email';

    /**
     * Sandbox mode parameter name.
     *
     * @var string
     */
    const PAYPAL_SANDBOX = 'test_ipn';

    /**
     * String PayPal payment status parameter name.
     *
     * @var string
     */
    const PAYPAL_PAYMENT_STATUS = 'payment_status';

    /**
     * String PayPal transaction id.
     *
     * @var string
     */
    const PAYPAL_TRANSACTION_ID = 'txn_id';

    /**
     * String PayPal whole price including payment and shipment.
     *
     * @var string
     */
    const MC_GROSS = 'mc_gross';

    /**
     * String PayPal payment currency.
     *
     * @var string
     */
    const MC_CURRENCY = 'mc_currency';

    /**
     * Return if response verified as ACK from PayPal.
     *
     * @return boolean
     */
    public function isPayPalAck()
    {
        $response = $this->getData();

        return isset($response[self::PAYPAL_ACK]);
    }

    /**
     * Return if response verified as ACK from PayPal.
     *
     * @return string
     */
    public function getReceiverEmail()
    {
        return $this->getValue(self::RECEIVER_EMAIL);
    }

    /**
     * Return payment status.
     *
     * @return string
     */
    public function getPaymentStatus()
    {
        return $this->getValue(self::PAYPAL_PAYMENT_STATUS);
    }

    /**
     * Return payment transaction id.
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->getValue(self::PAYPAL_TRANSACTION_ID);
    }

    /**
     * Return payment currency.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->getValue(self::MC_CURRENCY);
    }

    /**
     * Return payment amount.
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->getValue(self::MC_GROSS);
    }
}
