<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class Services
 * @package CdekSDK2\BaseTypes
 */
class Services extends Base
{
    /**
     * Код дополнительной услуги
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     * Параметр дополнительной услуги
     * @Type("float")
     * @var float
     */
    public $parameter;

    /**
     * Сумма услуги (в валюте договора)
     * @Type("float")
     * @var float
     */
    public $sum;

    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'code' => 'required|alpha',
            'parameter' => 'numeric',
        ];
    }
}
