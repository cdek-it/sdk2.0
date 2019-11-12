<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class InputHook
 * @package CdekSDK2\BaseTypes
 */
class InputHook extends Base
{
    /**
     * Тип события
     * @Type("string")
     * @var string
     */
    public $type;

    /**
     * Дата и время события в UTC
     * @Type("string")
     * @var string
     */
    public $date_time;

    /**
     * Идентификатор заказа
     * @Type("string")
     * @var string
     */
    public $uuid;

    /**
     * Атрибуты события
     * @Type("CdekSDK2\BaseTypes\Statuses")
     * @var Statuses
     */
    public $attributes;
}
