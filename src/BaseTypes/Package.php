<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class Package
 * @package CdekSDK2\BaseTypes
 */
class Package extends Base
{
    /**
     * Номер упаковки
     * @Type("string")
     * @var string
     */
    public $number;

    /**
     * Общий вес (в граммах)
     * @Type("int")
     * @var int
     */
    public $weight;

    /**
     * Объемный вес (в граммах)
     * @Type("int")
     * @var int
     */
    public $weight_volume;

    /**
     * Расчетный вес (в граммах)
     * @Type("int")
     * @var int
     */
    public $weight_calc;

    /**
     * Габариты упаковки. Длина (в сантиметрах)
     * @Type("int")
     * @var int
     */
    public $length;

    /**
     * Габариты упаковки. Ширина (в сантиметрах)
     * @Type("int")
     * @var int
     */
    public $width;

    /**
     * Габариты упаковки. Высота (в сантиметрах)
     * @Type("int")
     * @var int
     */
    public $height;

    /**
     * Комментарий к упаковке
     * @Type("string")
     * @var string
     */
    public $comment;

    /**
     * Позиции товаров в упаковке
     * @Type("array<CdekSDK2\BaseTypes\Item>")
     * @var Item[]
     */
    public $items;

    /**
     * Package constructor.
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'number' => 'required',
            'weight' => 'required|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'items' => [
                'required', 'array',
                function ($value) {
                    foreach ($value as $item) {
                        if ($item instanceof Item) {
                            $item->validate();
                        }
                    }
                }
            ],
        ];
    }
}
