<?php

namespace CdekSDK2\Actions;

use CdekSDK2\BaseTypes\TariffByCode;
use CdekSDK2\Http\ApiResponse;

class Calculate extends Action
{
    public const URL = '/calculator/tariff';

    public function calculateByTariffCode(TariffByCode $tariffByCode): ApiResponse
    {
        $params = $this->serializer->toArray($tariffByCode);
        return $this->preparedAdd($params);
    }
}
