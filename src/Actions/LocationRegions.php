<?php

declare(strict_types=1);

namespace CdekSDK2\Actions;

/**
 * Class LocationRegions
 * @package CdekSDK2\Actions
 */
class LocationRegions extends Action
{
    use FilteredTrait;

    /**
     * URL для запросов к API
     * @var string
     */
    public const URL = '/location/regions';

    /**
     * Список корректных параметров, которые разрешено передавать для поиска регионов
     * @var array
     */
    public const FILTER = [
        'country_codes' => '',
        'region_code' => '',
        'kladr_region_code' => '',
        'fias_region_guid' => '',
        'size' => '',
        'page' => '',
        'lang' => '',
    ];
}
