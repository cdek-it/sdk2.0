<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\Actions;

use CdekSDK2\BaseTypes\Order;
use CdekSDK2\Http\ApiResponse;

/**
 * Class Orders
 * @package CdekSDK2\Actions
 */
class Orders extends ActionsWithDelete
{
    /**
     * URL для запросов к API
     * @var string
     */
    const URL = '/orders';

    /**
     * Создание заказа
     * @param Order $order
     * @return ApiResponse
     * @throws \CdekSDK2\Exceptions\RequestException
     */
    public function add(Order $order): ApiResponse
    {
        $params = $this->serializer->toArray($order);
        return $this->preparedAdd($params);
    }
}
