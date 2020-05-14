<?php

declare(strict_types=1);

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
    public const URL = '';

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
        return $this->http_client->get($this->slug($uuid));
    }

    /**
     * Отправка запрос на добавление элемента
     * @param array $params
     * @return ApiResponse
     * @throws RequestException
     */
    protected function preparedAdd(array $params = []): ApiResponse
    {
        return $this->http_client->post($this->slug(), $params);
    }

    /**
     * Форматирование url для запросов
     * @param string|null $uuid
     * @return string
     */
    protected function slug(string $uuid = null): string
    {
        if (empty($uuid)) {
            return static::URL;
        }
        return static::URL . '/' . $uuid;
    }
}
