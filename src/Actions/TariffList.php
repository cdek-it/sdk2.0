<?php

declare(strict_types=1);


namespace CdekSDK2\Actions;


use CdekSDK2\BaseTypes\TariffWithoutCode;
use CdekSDK2\Http\ApiResponse;

class TariffList extends Action
{
    /**
     * URL для запросов к API
     * @var string
     */
    public const URL = '/calculator/tarifflist';

    /**
     * Создание заказа
     * @param TariffWithoutCode $tariffWithoutCode
     * @return ApiResponse
     * @throws \CdekSDK2\Exceptions\RequestException
     */
    public function check(TariffWithoutCode $tariffWithoutCode): ApiResponse
    {
        $params = $this->serializer->toArray($tariffWithoutCode);
        return $this->preparedAdd($params);

    }
}
