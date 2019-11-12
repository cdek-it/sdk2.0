<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\Actions;

use CdekSDK2\Http\ApiResponse;

/**
 * Class ActionsWithDelete
 * @package CdekSDK2\Actions
 */
class ActionsWithDelete extends Action
{
    /**
     * Запрос на удаление по uuid
     * @param string $uuid
     * @return ApiResponse
     * @throws \CdekSDK2\Exceptions\RequestException
     */
    public function delete(string $uuid)
    {
        $response = $this->http_client->delete($this->slug($uuid));
        return $response;
    }
}
