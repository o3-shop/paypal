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

declare(strict_types=1);

namespace OxidEsales\PayPalModule\GraphQL\DataType;

use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

/**
 * @Type()
 */
final class PayPalCommunicationInformation
{
    /** @var string */
    private $token;

    /** @var string */
    private $communicationUrl;

    public function __construct(string $token, string $communicationUrl)
    {
        $this->token = $token;
        $this->communicationUrl = $communicationUrl;
    }

    /**
     * @Field()
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @Field()
     */
    public function getCommunicationUrl(): string
    {
        return $this->communicationUrl;
    }
}
