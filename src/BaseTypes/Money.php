<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class Money
 * @package CdekSDK2\BaseTypes
 */
class Money extends Base
{
    /**
     * Сумма в валюте
     * @Type("float")
     * @var float
     */
    public $value;

    /**
     * Сумма НДС
     * @Type("float")
     * @var float|null
     */
    public $vat_sum;

    /**
     * Ставка НДС
     * @Type("int")
     * @var int|null
     */
    public $vat_rate;

    /**
     * Money constructor.
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'value' => 'required|numeric',
            'vat_sum' => 'numeric',
        ];
    }
}
