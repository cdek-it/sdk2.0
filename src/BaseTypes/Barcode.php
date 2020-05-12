<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\BaseTypes;

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
     * @Type("integer")
     * @var integer
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
     * @Type("array<CdekSDK2\BaseTypes\ResponseStatus>")
     * @var ResponseStatus[]
     */
    public $statuses;
}
