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

namespace OxidEsales\PayPalModule\Tests\Unit\Component\Widget;

class ArticleDetailsTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
    protected function createDetailsMock($articleInfo, $showECSPopUp = 0)
    {
        $mockBuilder = $this->getMockBuilder(\OxidEsales\Eshop\Application\Component\BasketComponent::class);
        $mockBuilder->setMethods(['getCurrentArticleInfo', 'shopECSPopUp']);
        $basketComponent = $mockBuilder->getMock();
        $basketComponent->expects($this->any())->method('getCurrentArticleInfo')->will($this->returnValue($articleInfo));
        $basketComponent->expects($this->any())->method('shopECSPopUp')->will($this->returnValue($showECSPopUp));

        $mockBuilder = $this->getMockBuilder(\OxidEsales\Eshop\Application\Component\Widget\ArticleDetails::class);
        $mockBuilder->setMethods(['oePayPalGetRequest', 'getComponent']);
        $details = $mockBuilder->getMock();
        $details->expects($this->any())->method('getComponent')->will($this->returnValue($basketComponent));

        return $details;
    }

    public function providerOePayPalGetArticleAmount()
    {
        return array(
            // Given amount 5
            array(array('am' => 5), 5),
            // Not given any amount
            array('', 1)
        );
    }

    /**
     * Tests if returns correct amount
     *
     * @param $articleInfo
     * @param $expectedResult
     *
     * @dataProvider providerOePayPalGetArticleAmount
     */
    public function testOePayPalGetArticleAmount($articleInfo, $expectedResult)
    {
        $details = $this->createDetailsMock($articleInfo);

        $this->assertEquals($expectedResult, $details->oePayPalGetArticleAmount());
    }

    public function providerOePayPalShowECSPopup()
    {
        return array(
            array(true, true),
            array(false, false),
            array('', false),
        );
    }

    /**
     * Tests if function gets parameter and returns correct result
     *
     * @param $showPopUp
     * @param $expectedResult
     *
     * @dataProvider providerOePayPalShowECSPopup
     */
    public function testOePayPalShowECSPopup($showPopUp, $expectedResult)
    {
        $details = $this->createDetailsMock(array(), $showPopUp);

        $this->assertEquals($expectedResult, $details->oePayPalShowECSPopup());
    }

    public function providerOePayPalGetPersistentParam()
    {
        return array(
            array(array('persparam' => array('details' => 'aa')), 'aa'),
            array(array('persparam' => null), null),
        );
    }

    /**
     * Tests if function returns correct persistent param
     *
     * @param $articleInfo
     * @param $expectedResult
     *
     * @dataProvider providerOePayPalGetPersistentParam
     */
    public function testOePayPalGetPersistentParam($articleInfo, $expectedResult)
    {
        $details = $this->createDetailsMock($articleInfo);

        $this->assertEquals($expectedResult, $details->oePayPalGetPersistentParam());
    }

    public function providerOePayPalGetSelection()
    {
        return array(
            array(array('sel' => array(1, 0)), array(1, 0)),
            array(array('sel' => null), null),
        );
    }

    /**
     * Tests if returns correct selection lists values
     *
     * @param $articleInfo
     * @param $expectedResult
     *
     * @dataProvider providerOePayPalGetSelection
     */
    public function testOePayPalGetSelection($articleInfo, $expectedResult)
    {
        $details = $this->createDetailsMock($articleInfo);

        $this->assertEquals($expectedResult, $details->oePayPalGetSelection());
    }
}