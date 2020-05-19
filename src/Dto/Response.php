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
     * Информация о сущности, над которой выполняется запрос
     * (заказ, заявка, печатная форма, договоренность о доставке, подписка)
     * @Type("CdekSDK2\BaseTypes\WebHook")
     * @var Barcode | Intake | Invoice | Order | WebHook | OrderInfo
     */
    public $entity;

    /**
     * Информация о запросах над сущностью
     * @Type("array<CdekSDK2\Dto\Request>")
     * @var Request[]
     */
    public $requests;

    /**
     * Связанные с заказом сущности
     * @Type("array<CdekSDK2\Dto\Relations>")
     * @var  Relations[]
     */
    public $related_entities;
}
