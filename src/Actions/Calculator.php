<?php

declare(strict_types=1);

namespace CdekSDK2\Actions;

use CdekSDK2\BaseTypes\Tariff;
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
    public const URL = '/calculator';

    /**
     * @var Tarifflist|Tariff
     */
    private $lastAction;

    /**
     * Создание запроса на расчёт стоимости
     * @param Tarifflist|Tariff $tarifflist
     * @return ApiResponse
     * @throws RequestException
     */
    public function add($tarifflist): ApiResponse
    {
        $this->lastAction = $tarifflist;
        $params = $this->serializer->toArray($tarifflist);
        return $this->preparedAdd($params);
    }

    protected function slug(string $uuid = null): string
    {
        if ($this->lastAction instanceof Tariff) {
            return static::URL . '/tariff';
        }

        return static::URL . '/tarifflist';
    }
}
