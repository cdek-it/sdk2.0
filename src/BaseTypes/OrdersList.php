<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

class OrdersList extends Base
{
    /**
     * Идентификатор заказа
     * @Type("string")
     * @var string
     */
    public $order_uuid;

    /**
     * Номер заказа СДЭК
     * @Type("int")
     * @var int
     */
    public $cdek_number;

    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'order_uuid' => 'alpha_dash',
            'cdek_number' => 'required_if:order_uuid,==,|integer',
        ];
    }
}
