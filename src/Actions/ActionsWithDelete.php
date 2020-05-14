<?php

declare(strict_types=1);

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
    public function delete(string $uuid): ApiResponse
    {
        $response = $this->http_client->delete($this->slug($uuid));
        return $response;
    }
}
