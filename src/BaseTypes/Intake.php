<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use CdekSDK2\Dto\Statuses;
use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;

/**
 * Class Intake
 * @package CdekSDK2\BaseTypes
 */
class Intake extends Base
{
    /**
     * Идентификатор заявки
     * @Type("string")
     * @var string
     */
    public $uuid;

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

    /**
     * Дата ожидания курьера (дата в формате ISO 8601: YYYY-MM-DD)
     * @Type("string")
     * @var string
     */
    public $intake_date;

    /**
     * Время начала ожидания курьера (время в формате ISO 8601: hh:mm)
     * @Type("string")
     * @var string
     */
    public $intake_time_from;

    /**
     * Время окончания ожидания курьера (время в формате ISO 8601: hh:mm)
     * @Type("string")
     * @var string
     */
    public $intake_time_to;

    /**
     * Время начала обеда, должно входить в диапазон [intake_time_to;intake_time_to]
     * @Type("string")
     * @var string
     */
    public $lunch_time_from;

    /**
     * Время окончания обеда, должно входить в диапазон [intake_time_to;intake_time_to]
     * @Type("string")
     * @var string
     */
    public $lunch_time_to;

    /**
     * Описание груза
     * @Type("string")
     * @var string
     */
    public $name;

    /**
     * Общий вес (в граммах)
     * @Type("int")
     * @var int
     */
    public $weight;

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
     * Комментарий к заявке для курьера
     * @Type("string")
     * @var string
     */
    public $comment;

    /**
     * Отправитель
     * @Type("CdekSDK2\BaseTypes\Contact")
     * @var Contact
     */
    public $sender;

    /**
     * Адрес отправителя (забора)
     * @Type("CdekSDK2\BaseTypes\Location")
     * @var Location
     */
    public $from_location;

    /**
     * Необходим прозвон отправителя
     * @Type("bool")
     * @var bool
     */
    public $need_call = false;

    /**
     * @SkipWhenEmpty()
     * @Type("array<CdekSDK2\Dto\Statuses>")
     * @var Statuses[]
     */
    public $statuses;

    /**
     * Intake constructor.
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'intake_date' => 'required|date:Y-m-d',
            'intake_time_from' => 'required|date:H:i',
            'intake_time_to' => 'required|date:H:i',
            'weight' => 'numeric',
            'sender' => [
                '',
                function ($value) {
                    if ($value instanceof Contact) {
                        return $value->validate();
                    }
                }
            ],
            'from_location' => [
                '',
                function ($value) {
                    if ($value instanceof Location) {
                        return $value->validate();
                    }
                }
            ],
            'length' => 'numeric',
            'width' => 'numeric',
            'height' => 'numeric',
        ];
    }
}
