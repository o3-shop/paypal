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

namespace OxidEsales\PayPalModule\Tests\Unit\Model\Response;

/**
 * Testing \OxidEsales\PayPalModule\Model\Response\ResponseDoVoid class.
 */
class ResponseDoVoidTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
    /**
     * Returns response data
     *
     * @return array
     */
    protected function getResponseData()
    {
        $data = array(
            'AUTHORIZATIONID' => 'authorizationId',
            'CORRELATIONID'   => 'correlationId',
            'PAYMENTSTATUS'   => 'completed'
        );

        return $data;
    }

    /**
     * Test get authorization id
     */
    public function testGetAuthorizationId()
    {
        $response = new \OxidEsales\PayPalModule\Model\Response\ResponseDoVoid();
        $response->setData($this->getResponseData());
        $this->assertEquals('authorizationId', $response->getAuthorizationId());
    }

    /**
     * Test get correlation id
     */
    public function testGetCorrelationId()
    {
        $response = new \OxidEsales\PayPalModule\Model\Response\ResponseDoCapture();
        $response->setData($this->getResponseData());
        $this->assertEquals('correlationId', $response->getCorrelationId());
    }
}
