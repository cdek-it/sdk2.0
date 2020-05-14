<?php

declare(strict_types=1);

namespace CdekSDK2\Actions;

use CdekSDK2\BaseTypes\WebHook;
use CdekSDK2\Dto\InputHook;
use CdekSDK2\Http\ApiResponse;

/**
 * Class Webhooks
 * @package CdekSDK2\Actions
 */
class Webhooks extends ActionsWithDelete
{
    /**
     * URL для запросов к API
     * @var string
     */
    public const URL = '/webhooks';

    /**
     * Добавление нового слушателя вебхуков
     * @param WebHook $webHook
     * @return ApiResponse
     * @throws \CdekSDK2\Exceptions\RequestException
     */
    public function add(WebHook $webHook): ApiResponse
    {
        $params = $this->serializer->toArray($webHook);
        return $this->preparedAdd($params);
    }

    /**
     * Получение списка вебхуков
     * @return ApiResponse
     * @throws \CdekSDK2\Exceptions\RequestException
     */
    public function list(): ApiResponse
    {
        return $this->get('');
    }

    /**
     * Парсер входящих хуков
     * @param string $string
     * @return InputHook
     */
    public function parse(string $string): InputHook
    {
        try {
            $result = $this->serializer->deserialize($string, InputHook::class, 'json');
        } catch (\Exception $e) {
            $result = new InputHook();
        }
        return $result;
    }
}
