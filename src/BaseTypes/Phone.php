<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class Phone
 * Номер телефона (мобильный/городской):
 * @package CdekSDK2\BaseTypes
 */
class Phone extends Base
{
    /**
     * Номер телефона
     * @Type("string")
     * @var string
     */
    public $number;

    /**
     * Добавочный номер
     * @Type("string")
     * @var string
     */
    public $additional;

    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'number' => 'required',
        ];
    }
}
