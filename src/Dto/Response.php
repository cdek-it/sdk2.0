<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use CdekSDK2\BaseTypes\Barcode;
use CdekSDK2\BaseTypes\Intake;
use CdekSDK2\BaseTypes\Invoice;
use CdekSDK2\BaseTypes\Order;
use CdekSDK2\BaseTypes\WebHook;
use JMS\Serializer\Annotation\Type;

/**
 * Class Response
 * @package CdekSDK2\Dto
 */
class Response
{
    /**
     * @Type("CdekSDK2\BaseTypes\WebHook")
     * @var Barcode | Intake | Invoice | Order | WebHook
     */
    public $entity;

    /**
     * @Type("array<CdekSDK2\Dto\Request>")
     * @var Request[]
     */
    public $requests;
}
