<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use CdekSDK2\BaseTypes\Phone;
use JMS\Serializer\Annotation\Type;

/**
 * Class PickupPoint
 * @package CdekSDK2\Dto
 */
class PickupPoint
{
    /**
     * Код ПВЗ
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     * Название ПВЗ
     * @Type("string")
     * @var string
     */
    public $name;

    /**
     * Адрес ПВЗ
     * @Type("CdekSDK2\Dto\PickupPointLocation")
     * @var PickupPointLocation
     */
    public $location;

    /**
     * Режим работы, строка вида «пн-пт 9-18, сб 9-16»
     * @Type("string")
     * @var string
     */
    public $work_time;

    /**
     * Примечание по ПВЗ
     * @Type("string")
     * @var string
     */
    public $note;

    /**
     * Минимальный вес (в кг.), принимаемый в ПВЗ (> WeightMin)
     * @Type("float")
     * @var float
     */
    public $weight_min;

    /**
     * Максимальный вес (в кг.), принимаемый в ПВЗ (<=WeightMax)
     * @Type("float")
     * @var float
     */
    public $weight_max;

    /**
     * Тип ПВЗ: Склад СДЭК или Почтомат партнера, PVZ — склад СДЭК, POSTOMAT — почтомат партнера СДЭК
     * @Type("string")
     * @var string
     */
    public $type;

    /**
     * Принадлежность ПВЗ компании
     * @Type("string")
     * @var string
     */
    public $owner_code;

    /**
     * Является ли ПВЗ только пунктом выдачи или также осуществляет приём грузов
     * @Type("bool")
     * @var bool
     */
    public $take_only;

    /**
     * Есть ли примерочная
     * @Type("bool")
     * @var bool
     */
    public $is_dressing_room;

    /**
     * Есть терминал оплаты
     * @Type("bool")
     * @var bool
     */
    public $have_cashless;

    /**
     * Есть приём наличных
     * @Type("bool")
     * @var bool
     */
    public $have_cash;

    /**
     * Разрешен наложенный платеж в ПВЗ
     * @Type("bool")
     * @var bool
     */
    public $allowed_cod;

    /**
     * Работает ли офис с LTL (сборный груз)
     * @Type("bool")
     * @var bool
     */
    public $is_ltl;

    /**
     * Работает ли офис с "Фулфилмент. Приход"
     * @Type("bool")
     * @var bool
     */
    public $fulfillment;

    /**
     * Ближайшая станция/остановка транспорта
     * @Type("string")
     * @var string
     */
    public $nearest_station;

    /**
     * Ближайшая станция метро
     * @Type("string")
     * @var string
     */
    public $nearest_metro_station;

    /**
     * Ссылка на данный ПВЗ на сайте СДЭК
     * @Type("string")
     * @var string
     */
    public $site;

    /**
     * Адрес электронной почты
     * @Type("string")
     * @var string
     */
    public $email;

    /**
     * Описание местоположения
     * @Type("string")
     * @var string
     */
    public $address_comment;

    /**
     * Все фото офиса
     * @Type("array<CdekSDK2\Dto\PickupImage>")
     * @var PickupImage[]
     */
    public $office_image_list;

    /**
     * График работы на неделю
     * @Type("array<CdekSDK2\Dto\WorkTime>")
     * @var WorkTime[]
     */
    public $work_time_list;

    /**
     * Исключения в графике работы офиса
     * @Type("array<CdekSDK2\Dto\WorkTimeExceptions>")
     * @var WorkTimeExceptions[]
     */
    public $work_time_exceptions;

    /**
     * Список телефонов
     * @Type("array<CdekSDK2\BaseTypes\Phone>")
     * @var Phone[]
     */
    public $phones = [];
}
