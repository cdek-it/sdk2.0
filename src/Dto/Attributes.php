<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class Attributes
{
    /**
     * Признак возвратного заказа
     * @Type("bool")
     * @var bool
     */
    public $is_return;

    /**
     * Признак возвратного заказа
     * @Type("bool")
     * @var bool
     */
    public $is_reverse;

    /**
     * Признак клиентского возврата
     * @Type("bool")
     * @var bool
     */
    public $is_client_return;

    /**
     * Номер заказа СДЭК
     * @Type("int")
     * @var int
     */
    public $cdek_number;

    /**
     * Номер заказа в ИС Клиента
     * @Type("string")
     * @var string
     */
    public $number;

    /**
     * Код статуса
     * @Type("string")
     * @var string
     * @deprecated
     */
    public $code;

    /**
     * Код статуса
     * @Type("string")
     * @var string
     * @deprecated
     */
    public $status_code;

    /**
     * Код дополнительного статуса
     * @Type("string")
     * @var string
     */
    public $status_reason_code;

    /**
     * Дата и время установки статуса
     * @Type("string")
     * @var string
     */
    public $status_date_time;

    /**
     * Наименование города(места), где произошло изменение статуса
     * @Type("string")
     * @var string
     */
    public $city;

    /**
     * Тип печатной формы
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

    // @TODO: Support related_entities attribute
}
