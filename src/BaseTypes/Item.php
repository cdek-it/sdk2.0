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
 * Class Item
 * @package CdekSDK2\BaseTypes
 */
class Item extends Base
{
    /**
     * Наименование товара
     * @Type("string")
     * @var string
     */
    public $name;

    /**
     * Идентификатор/артикул товара
     * @Type("string")
     * @var string
     */
    public $ware_key;

    /**
     * Оплата за товар при получении
     * @Type("CdekSDK2\BaseTypes\Money")
     * @var Money
     */
    public $payment;

    /**
     * Объявленная стоимость товара
     * @Type("float")
     * @var float
     */
    public $cost;

    /**
     * Вес (за единицу товара, в граммах)
     * @Type("integer")
     * @var integer
     */
    public $weight;

    /**
     * Вес брутто (только для международных заказов)
     * @Type("integer")
     * @var integer
     */
    public $weight_gross;

    /**
     * Количество единиц товара
     * @Type("integer")
     * @var integer
     */
    public $amount;

    /**
     * Наименование на иностранном языке
     * @Type("string")
     * @var string
     */
    public $name_i18n;

    /**
     * Бренд на иностранном языке
     * @Type("string")
     * @var string
     */
    public $brand;

    /**
     * Код страны в формате  ISO_3166-1_alpha-2
     * @Type("string")
     * @var string
     */
    public $country_code;

    /**
     * Название материала из которого сделан товар
     * @Type("string")
     * @var string
     */
    public $material;

    /**
     * Содержит ли радиочастотные модули (wifi/gsm)
     * @Type("boolean")
     * @var boolean
     */
    public $wifi_gsm = false;

    /**
     * Ссылка на сайт интернет-магазина с описанием товара
     * @Type("string")
     * @var string
     */
    public $url;

    /**
     * Item constructor.
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'name' => 'required',
            'ware_key' => 'required',
            'cost' => 'required|numeric',
            'weight' => 'required|numeric',
            'amount' => 'required|integer',
            'payment' => [
                'required',
                function ($value) {
                    if (is_subclass_of($value, Base::class) && $value instanceof Money) {
                        /* @var $value Money */
                        $value->validate();
                    }
                }
            ],
            'weight_gross' => 'numeric',
            'country_code' => 'alpha:2',
            'url' => 'url',
        ];
    }
}
