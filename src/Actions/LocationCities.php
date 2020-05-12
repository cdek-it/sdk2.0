<?php

declare(strict_types=1);

namespace CdekSDK2\Actions;

/**
 * Class LocationRegions
 * @package CdekSDK2\Actions
 */
class LocationCities extends Action
{
    use FilteredTrait;

    /**
     * URL для запросов к API
     * @var string
     */
    public const URL = '/location/cities';

    /**
     * Список корректных параметров, которые разрешено передавать для поиска населенных пунктов
     * @var array
     */
    public const FILTER = [
        'country_codes' => '',
        'region_code' => '',
        'kladr_region_code' => '',
        'fias_region_guid' => '',
        'kladr_code' => '',
        'fias_guid' => '',
        'postal_code' => '',
        'code' => '',
        'city' => '',
        'size' => '',
        'page' => '',
        'lang' => '',
        'payment_limit' => '',
    ];
}
