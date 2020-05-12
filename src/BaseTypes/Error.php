<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

class Error
{
    /**
     * Код ошибки
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     * Описание ошибки
     * @Type("string")
     * @var string
     */
    public $message;
}
