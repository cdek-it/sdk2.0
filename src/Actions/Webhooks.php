<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\Actions;

use CdekSDK2\BaseTypes\InputHook;
use CdekSDK2\BaseTypes\WebHook;
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
    const URL = '/webhooks';

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
