<?php

/**
 * Copyright (c) 2020. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class Request
 * @package CdekSDK2\BaseTypes
 */
class Request
{
    /**
     * Идентификатор запроса
     * @Type("string")
     * @var string
     */
    public $request_uuid;

    /**
     * Тип запроса
     * Может принимать значения: CREATE, UPDATE, DELETE, AUTH, GET
     * @Type("string")
     * @var string
     */
    public $type;

    /**
     * Текущее состояние запроса
     * Может принимать значения: ACCEPTED, WAITING, SUCCESSFUL, INVALID
     * @Type("string")
     * @var string
     */
    public $state;

    /**
     * Время
     * @Type("string")
     * @var string
     */
    public $date_time;

    /**
     * Список ошибок
     * @Type("array<CdekSDK2\BaseTypes\Error>")
     * @var Error[]
     */
    public $errors;

    /**
     * Список предупреждений
     * @Type("array<CdekSDK2\BaseTypes\Warning>")
     * @var Warning[]
     */
    public $warnings;
}
