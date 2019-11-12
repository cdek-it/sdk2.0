<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\Actions;

use CdekSDK2\Exceptions\RequestException;
use CdekSDK2\Http\Api;
use CdekSDK2\Http\ApiResponse;
use JMS\Serializer\Serializer;

/**
 * Class Action
 * @package CdekSDK2\Actions
 */
class Action
{
    /**
     * URL для запросов к API
     * @var string
     */
    const URL = '';

    /**
     * Объект для взаимодействия с API СДЭК
     * @var Api
     */
    protected $http_client;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * Action constructor.
     * @param Api $request
     * @param Serializer $serializer
     */
    public function __construct(Api $request, Serializer $serializer)
    {
        $this->http_client = $request;
        $this->serializer = $serializer;
    }

    /**
     * Получить данные по uuid
     * @param string $uuid
     * @return ApiResponse
     * @throws RequestException
     */
    public function get(string $uuid): ApiResponse
    {
        $response = $this->http_client->get($this->slug($uuid));
        return $response;
    }

    /**
     * Отправка запрос на добавление элемента
     * @param array $params
     * @return ApiResponse
     * @throws RequestException
     */
    protected function preparedAdd(array $params = []): ApiResponse
    {
        $response = $this->http_client->post($this->slug(), $params);
        return $response;
    }

    /**
     * Форматирование url для запросов
     * @param string|null $uuid
     * @return string
     */
    protected function slug(string $uuid = null)
    {
        if (empty($uuid)) {
            return static::URL;
        }
        return static::URL . '/' . $uuid;
    }
}
