<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use CdekSDK2\Dto\Statuses;
use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;

/**
 * Class Order
 * @package CdekSDK2\BaseTypes
 */
class TariffWithoutCode extends Base
{
    /**
     * Дата и время планируемой передачи заказа
     * @SkipWhenEmpty()
     * @Type("string")
     * @var string
     */
    public $date;

    /**
     * Тип заказа
     * @SkipWhenEmpty()
     * @Type("int")
     * @var int
     */
    public $type = 1;

    /**
     * Валюта
     * @SkipWhenEmpty()
     * @Type("int")
     * @var int
     */
    public $currency = 1;

    /**
     * Адрес отправления
     * @Type("CdekSDK2\BaseTypes\FromToLocation")
     * @var FromToLocation
     */
    public $from_location;

    /**
     * Адрес получения
     * @Type("CdekSDK2\BaseTypes\FromToLocation")
     * @var FromToLocation
     */
    public $to_location;

    /**
     * Адрес получения
     * @Type("CdekSDK2\BaseTypes\Services")
     * @var Services
     */
    public $services;

    /**
     * Список информации по местам (упаковкам)
     * Список информации по местам
     * @Type("array<CdekSDK2\BaseTypes\PackageTariff>")
     * @var PackageTariff[]
     */
    public $packages;

    /**
     * Tariffs constructor.
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'from_location' => [
                'required',
                function ($value) {
                    if ($value instanceof FromToLocation) {
                        return $value->validate();
                    }
                }
            ],
            'to_location' => [
                'required',
                function ($value) {
                    if ($value instanceof FromToLocation) {
                        return $value->validate();
                    }
                }
            ],
            'packages' => [
                'required',
                'array',
                function ($value) {
                    if (!is_array($value) || empty($value) || count($value) < 1) {
                        return false;
                    }
                    $i = 0;
                    foreach ($value as $item) {
                        if ($item instanceof PackageTariff) {
                            $i += (int)$item->validate();
                        }
                    }
                    return ($i === count($value));
                }
            ],
        ];
    }
}
