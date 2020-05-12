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
 * Class Response
 * @package CdekSDK2\BaseTypes
 */
class Response
{
    /**
     * @Type("CdekSDK2\BaseTypes\WebHook")
     * @var Barcode | Intake | Invoice | Order | WebHook
     */
    public $entity;

    /**
     * @Type("array<CdekSDK2\BaseTypes\Request>")
     * @var Request[]
     */
    public $requests;
}
