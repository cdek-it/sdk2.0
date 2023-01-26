<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use CdekSDK2\Dto\ResponseStatus;
use JMS\Serializer\Annotation\Type;

class Barcode extends Base
{
    /**
     * Идентификатор запроса на печать штрих-кода
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
     * Число копий. По умолчанию 1
     * @Type("int")
     * @var int
     */
    public $copy_count = 1;

    /**
     * Формат печати. Может принимать значения: A4, A5, A6. По умолчанию A4
     * @Type("string")
     * @var string
     */
    public $format = 'A4';

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
