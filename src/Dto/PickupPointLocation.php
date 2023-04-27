<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class PickupPointLocation
{
    /**
     * Код населенного пункта СДЭК (используется в выдаче списка офисов)
     * @Type("integer")
     * @var integer
     */
    public $city_code;

    /**
     * Уникальный идентификатор ФИАС
     * @Type("string")
     * @var string
     */
    public $fias_guid;

    /**
     * Почтовый индекс
     * @Type("string")
     * @var string
     */
    public $postal_code;

    /**
     * Долгота
     * @Type("float")
     * @var float
     */
    public $longitude;

    /**
     * Широта
     * @Type("float")
     * @var float
     */
    public $latitude;

    /**
     * Код страны в формате  ISO_3166-1_alpha-2
     * @example RU, DE, TR
     * @Type("string")
     * @var string
     */
    public $country_code;

    /**
     * Название региона
     * @Type("string")
     * @var string
     */
    public $region;

    /**
     * Код региона (справочник СДЭК)
     * @Type("int")
     * @var int
     */
    public $region_code;

    /**
     * Название города
     * @Type("string")
     * @var string
     */
    public $city;

    /**
     * Строка адреса
     * @Type("string")
     * @var string
     */
    public $address;

    /**
     * Полный адрес с указанием страны, региона, города, и т.д.
     * @Type("string")
     * @var string
     */
    public $address_full;
}
