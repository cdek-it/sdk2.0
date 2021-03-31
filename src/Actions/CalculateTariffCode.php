<?php

declare(strict_types=1);


namespace CdekSDK2\Actions;


use CdekSDK2\BaseTypes\Order;
use CdekSDK2\BaseTypes\Tariff;
use CdekSDK2\Http\ApiResponse;

class CalculateTariffCode extends ActionsWithDelete
{
    /**
     * URL для запросов к API
     * @var string
     */
    public const URL = '/calculator/tariff';

    /**
     * Создание заказа
     * @param Tariff $tariff
     * @return ApiResponse
     * @throws \CdekSDK2\Exceptions\RequestException
     */
    public function add(Tariff $tariff): ApiResponse
    {

        $params = $this->serializer->toArray($tariff);
        return $this->preparedAdd($params);

    }
}
