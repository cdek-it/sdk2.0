<?php

namespace CdekSDK2\BaseTypes;

class TariffByCode extends Base
{
    /** @var int Тип заказа */
    public $type;
    /** @var int Код тарифа */
    public $tariff_code;

    /** @var Location Адрес отправления */
    public $from_location;
    /** @var Location Адрес получения */
    public $to_location;

    /** @var Package[] Список информации по местам (упаковкам) */
    public $packages;

    /** @var int Общий вес (в граммах) */
    public $weight;

    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'type' => 'required|numeric',
            'tariff_code' => 'required|numeric',
            'weight' => 'required|integer',
            'from_location' => [
                'required',
                function ($value) {
                    if ($value instanceof Location) {
                        return $value->validate();
                    }
                }
            ],
            'to_location' => [
                'required',
                function ($value) {
                    if ($value instanceof Location) {
                        return $value->validate();
                    }
                }
            ],
            'packages' => [
                'required', 'array',
                function ($value) {
                    if (!is_array($value) || empty($value) || count($value) < 1) {
                        return false;
                    }
                    $i = 0;
                    foreach ($value as $item) {
                        if ($item instanceof Package) {
                            $i += (int)$item->validate();
                        }
                    }
                    return ($i === count($value));
                }
            ],
        ];
    }
}
