<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

class Invoice extends Base
{
    /**
     * Идентификатор запроса на печать квитаниции
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
     * @Type("integer")
     * @var integer
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
     * @Type("array<CdekSDK2\BaseTypes\ResponseStatus>")
     * @var ResponseStatus[]
     */
    public $statuses;
}
