<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class Threshold
 * @package CdekSDK2\BaseTypes
 */
class Threshold extends Base
{
    /**
     * Порог стоимости товара (действует по условию меньше или равно) в целых единицах валюты
     * @Type("integer")
     * @var integer
     */
    public $threshold;

    /**
     * Доп. сбор за доставку товаров, общая стоимость которых попадает в интервал
     * @Type("float")
     * @var float
     */
    public $sum;

    /**
     * Сумма НДС, включённая в доп. сбор за доставку
     * @Type("float")
     * @var float
     */
    public $vat_sum;

    /**
     * Ставка НДС
     * @Type("integer")
     * @var integer|null
     */
    public $vat_rate;

    /**
     * Threshold constructor.
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'threshold ' => 'required|numeric',
            'sum ' => 'required|numeric',
            'vat_sum' => 'numeric',
        ];
    }
}
