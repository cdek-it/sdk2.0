<?php

declare(strict_types=1);

namespace CdekSDK2\Actions;

/**
 * Class Offices
 * @package CdekSDK2\Actions
 */
class Offices extends Action
{
    use FilteredTrait;

    /**
     * URL для запросов к API
     * @var string
     */
    public const URL = '/deliverypoints';

    /**
     * Список корректных параметров, которые разрешено передавать для поиска офисов
     * @var array
     */
    public const FILTER = [
        'postal_code' => '',
        'city_code' => '',
        'type' => '',
        'country_code' => '',
        'region_code' => '',
        'have_cashless' => '',
        'have_cash' => '',
        'allowed_cod' => '',
        'is_dressing_room' => '',
        'weight_max' => '',
        'weight_min' => '',
        'lang' => '',
        'take_only' => '',
        'is_handout' => '',
        'is_reception' => '',
        'fias_guid' => '',
        'code' => '',
        'is_ltl' => '',
        'fulfillment' => '',
    ];
}
