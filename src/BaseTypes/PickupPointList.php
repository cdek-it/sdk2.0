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
 * Class PickupPointList
 * @package CdekSDK2\BaseTypes
 */
class PickupPointList
{
    /**
     * Список ПВЗ
     * @Type("array<CdekSDK2\BaseTypes\PickupPoint>")
     * @var PickupPoint[]
     */
    public $items = [];

    /**
     * @return int|void
     */
    public function getCount()
    {
        return count($this->items);
    }

    /**
     * @param array $filter
     * @return array
     */
    public function filter(array $filter = []): array
    {
        $filtered = [];
        /* @var PickupPoint $pvz */
        foreach ($this->items as $pvz) {
            foreach ($filter as $k => $v) {
                if (property_exists(PickupPoint::class, $k) && mb_strtolower($pvz->$k) === mb_strtolower($v)) {
                    $filtered[] = $pvz;
                    break;
                }
            }
        }
        return $filtered;
    }
}
