<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use CdekSDK2\Dto\ResponseStatus;
use JMS\Serializer\Annotation\Type;

class Invoice extends Base
{
    /**
     * Идентификатор запроса на печать квитанции
     * @Type("string")
     * @var string
     */
    public $uuid;

    /**
     * Список заказов
     * @Type("array<CdekSDK2\BaseTypes\OrdersList>")
     * @var OrdersList[]
     */
    public $orders;

    /**
     * Число копий. По умолчанию 2
     * @Type("int")
     * @var int
     */
    public $copy_count = 2;

    /**
     * Шаблон для квитанции
     * @Type("string")
     * @var string
     */
    public $type;

    /**
     * Ссылка на скачивание файла
     * @Type("string")
     * @var string
     */
    public $url;

    /**
     * Список статусов запроса
     * @Type("array<CdekSDK2\Dto\ResponseStatus>")
     * @var ResponseStatus[]
     */
    public $statuses;
}
