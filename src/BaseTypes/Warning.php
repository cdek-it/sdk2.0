<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

class Warning
{
    /**
     * Код предупреждения
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     * Описание предупреждения
     * @Type("string")
     * @var string
     */
    public $message;
}
