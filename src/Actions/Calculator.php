<?php

declare(strict_types=1);

namespace CdekSDK2\Actions;

use CdekSDK2\BaseTypes\Tarifflist;
use CdekSDK2\Exceptions\RequestException;
use CdekSDK2\Http\ApiResponse;

/**
 * Class Calculator
 * @package CdekSDK2\Actions
 */
class Calculator extends Action
{
    /**
     * URL для запросов к API
     * @var string
     */
    public const URL = '/calculator/tarifflist';

    /**
     * Создание запроса на расчёт стоимости
     * @param Tarifflist $tarifflist
     * @return ApiResponse
     * @throws RequestException
     */
    public function add(Tarifflist $tarifflist): ApiResponse
    {
        $params = $this->serializer->toArray($tarifflist);
        return $this->preparedAdd($params);
    }
}
