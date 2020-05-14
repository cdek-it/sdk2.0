<?php

declare(strict_types=1);

namespace CdekSDK2\Actions;

use CdekSDK2\BaseTypes\Barcode;
use CdekSDK2\Exceptions\RequestException;
use CdekSDK2\Http\ApiResponse;

/**
 * Class Barcodes
 * @package CdekSDK2\Actions
 */
class Barcodes extends Action
{
    /**
     * URL для запросов к API на формирование ШК
     * @var string
     */
    public const URL = '/print/barcodes';

    /**
     * Запрос на формирование ШК-места к заказу
     * @param Barcode $barcode
     * @return ApiResponse
     * @throws RequestException
     */
    public function add(Barcode $barcode): ApiResponse
    {
        $params = $this->serializer->toArray($barcode);
        return $this->preparedAdd($params);
    }

    /**
     * Запрос на получение данных печатной формы
     * @param string $uuid
     * @return ApiResponse
     * @throws RequestException
     */
    public function download(string $uuid): ApiResponse
    {
        return $this->http_client->get($this->slug($uuid) . '.pdf');
    }
}
