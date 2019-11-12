<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;

/**
 * Class Seller
 * @package CdekSDK2\BaseTypes
 */
class Seller extends Base
{
    /**
     * Наименование истинного продавца
     * @Type("string")
     * @var string
     */
    public $name;

    /**
     * ИНН истинного продавца
     * @SkipWhenEmpty()
     * @Type("integer")
     * @var int
     */
    public $inn;

    /**
     * Телефон истинного продавца
     * @Type("CdekSDK2\BaseTypes\Phone")
     * @var Phone
     */
    public $phone;

    /**
     * Код формы собственности
     * @Type("integer")
     * @var int
     */
    public $ownership_form;

    /**
     * Адрес истинного продавца.
     * Используется при печати инвойсов для отображения адреса настоящего продавца товара, либо торгового названия.
     * Только для международных заказов
     * @Type("string")
     * @var string
     */
    public $address;
}
