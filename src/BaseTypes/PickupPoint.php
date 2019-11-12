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
class PickupPoint extends Base
{
    /**
     * Код ПВЗ
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     * Почтовый индекс
     * @Type("string")
     * @var string
     */
    public $postalCode;

    /**
     * Название ПВЗ
     * @Type("string")
     * @var string
     */
    public $name;

    /**
     * Код страны в формате ISO_3166-1_alpha-2
     * @Type("string")
     * @var string
     */
    public $countryCodeIso;

    /**
     * Название страны
     * @Type("string")
     * @var string
     */
    public $countryName;

    /**
     * Код региона
     * @Type("integer")
     * @var integer
     */
    public $regionCode;

    /**
     * Название региона
     * @Type("string")
     * @var string
     */
    public $regionName;

    /**
     * Код города по базе СДЭК
     * @Type("integer")
     * @var integer
     */
    public $cityCode;

    /**
     * Название города
     * @Type("string")
     * @var string
     */
    public $city;

    /**
     * Режим работы, строка вида «пн-пт 9-18, сб 9-16»
     * @Type("string")
     * @var string
     */
    public $workTime;

    /**
     * Адрес (улица, дом, офис) в указанном городе
     * @Type("string")
     * @var string
     */
    public $address;

    /**
     * Полный адрес с указанием страны, региона, города, и т.д.
     * @Type("string")
     * @var string
     */
    public $fullAddress;

    /**
     * Телефон
     * @Type("string")
     * @var string
     */
    public $phone;

    /**
     * Примечание по ПВЗ
     * @Type("string")
     * @var string
     */
    public $note;

    /**
     * Координаты местоположения (долгота) в градусах
     * @Type("float")
     * @var float
     */
    public $coordX;

    /**
     * Координаты местоположения (широта) в градусах
     * @Type("float")
     * @var float
     */
    public $coordY;

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
    public $ownerCode;

    /**
     * Есть ли примерочная
     * @Type("boolean")
     * @var boolean
     */
    public $isDressingRoom;

    /**
     * Есть терминал оплаты
     * @Type("boolean")
     * @var boolean
     */
    public $haveCashless;

    /**
     * Разрешен наложенный платеж в ПВЗ
     * @Type("boolean")
     * @var boolean
     */
    public $allowedCod;

    /**
     * Ближайшая станция/остановка транспорта
     * @Type("string")
     * @var string
     */
    public $nearestStation;

    /**
     * Ближайшая станция метро
     * @Type("string")
     * @var string
     */
    public $metroStation;

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
    public $addressComment;

    /**
     * Все фото офиса
     * @Type("string")
     * @var string
     */
    public $officeImageList;

    /**
     * График работы на неделю
     * @Type("array<CdekSDK2\BaseTypes\WorkTime>")
     * @var WorkTime[]
     */
    public $workTimeYList;

    /**
     * @Type("array<CdekSDK2\BaseTypes\Phone>")
     * @var Phone[]
     */
    public $phoneDetailList = [];
}
