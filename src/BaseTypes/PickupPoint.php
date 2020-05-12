<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class PickupPoint
 * @package CdekSDK2\BaseTypes
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
     * Почтовый индекс
     * @Type("array<CdekSDK2\BaseTypes\Location>")
     * @var Location
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
     * @Type("boolean")
     * @var boolean
     */
    public $take_only;

    /**
     * Есть ли примерочная
     * @Type("boolean")
     * @var boolean
     */
    public $is_dressing_room;

    /**
     * Есть терминал оплаты
     * @Type("boolean")
     * @var boolean
     */
    public $have_cashless;

    /**
     * Есть приём наличных
     * @Type("boolean")
     * @var boolean
     */
    public $have_cash;

    /**
     * Разрешен наложенный платеж в ПВЗ
     * @Type("boolean")
     * @var boolean
     */
    public $allowed_cod;

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
     * @Type("array<CdekSDK2\BaseTypes\PickupImage>")
     * @var PickupImage[]
     */
    public $office_image_list;

    /**
     * График работы на неделю
     * @Type("array<CdekSDK2\BaseTypes\WorkTime>")
     * @var WorkTime[]
     */
    public $work_time_list;

    /**
     * Исключения в графике работы офиса
     * @Type("array<CdekSDK2\BaseTypes\WorkTimeExceptions>")
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
