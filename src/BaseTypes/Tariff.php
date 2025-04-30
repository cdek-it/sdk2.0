<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class Tarifflist
 * @package CdekSDK2\BaseTypes
 */
class Tariff extends Tarifflist
{
    /**
     * Код тарифа
     * @Type("integer")
     * @var integer
     */
    public $tariff_code;

    /**
     * Дополнительные услуги
     * @Type("array<CdekSDK2\BaseTypes\Services>")
     * @var Services[]
     */
    public $services;

    /**
     * Intake constructor.
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $this->rules['tariff_code'] = 'numeric|required';
        $this->rules['services'] = [
            '',
            function ($value) {
                if ($value instanceof Services) {
                    return $value->validate();
                }
            }
        ];
    }
}
