<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class Location
 * @package CdekSDK2\BaseTypes
 */
class Location extends Base
{
    /**
     * Код локации из справочника СДЭК
     * @Type("int")
     * @var int
     */
    public $code;

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
     * Название района региона
     * @Type("string")
     * @var string
     */
    public $sub_region;

    /**
     * Название города
     * @Type("string")
     * @var string
     */
    public $city;

    /**
     * Код КЛАДР
     * @Type("string")
     * @var string
     */
    public $kladr_code;

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


    /**
     * Location constructor.
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'address' => 'required',
            'code' => 'numeric',
            'fias_guid' => 'alpha',
            'postal_code' => 'alpha',
            'longitude' => 'numeric',
            'latitude' => 'numeric',
            'country_code' => 'alpha:2',
            'region' => 'alpha',
            'sub_region' => 'alpha',
            'city' => 'alpha',
            'kladr_code' => 'alpha',
        ];
    }
}
