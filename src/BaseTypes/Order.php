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
class Order extends Base
{
    /**
     * Идентификатор заказа
     * @SkipWhenEmpty()
     * @Type("string")
     * @var string
     */
    public $uuid;

    /**
     * Тип заказа
     * @Type("integer")
     * @var int
     */
    public $type = 1;

    /**
     * Номер заказа в системе СДЭК
     * @Type("int")
     * @var int
     */
    public $cdek_number;

    /**
     * Номер заказа в ИС Клиента
     * @Type("string")
     * @var string
     */
    public $number;

    /**
     * Код тарифа
     * @Type("int")
     * @var int
     */
    public $tariff_code;

    /**
     * Комментарий к заказу
     * @Type("string")
     * @var string
     */
    public $comment;

    /**
     * Код ПВЗ для забора
     * @SkipWhenEmpty()
     * @Type("string")
     * @var string
     */
    public $shipment_point;

    /**
     * Код ПВЗ СДЭК для доставки
     * @SkipWhenEmpty()
     * @Type("string")
     * @var string
     */
    public $delivery_point;

    /**
     * Код валюты объявленной стоимости заказа
     * @SkipWhenEmpty()
     * @Type("string")
     * @var string
     */
    public $items_cost_currency;

    /**
     * Код валюты наложенного платежа
     * @SkipWhenEmpty()
     * @Type("string")
     * @var string
     */
    public $recipient_currency;

    /**
     * Дата инвойса
     * @Type("string")
     * @var string
     */
    public $date_invoice;

    /**
     * Грузоотправитель
     * @Type("string")
     * @var string
     */
    public $shipper_name;

    /**
     * Адрес грузоотправителя
     * @Type("string")
     * @var string
     */
    public $shipper_address;

    /**
     * Стоимость доставки, которую ИМ берет с получателя
     * @Type("CdekSDK2\BaseTypes\Money")
     * @var Money
     */
    public $delivery_recipient_cost;

    /**
     * Доп. сбор за доставку (которую ИМ берет с получателя) в зависимости от суммы заказа
     * @Type("array<CdekSDK2\BaseTypes\Threshold>")
     * @var Threshold[]
     */
    public $delivery_recipient_cost_adv;

    /**
     * Отправитель
     * @Type("CdekSDK2\BaseTypes\Contact")
     * @var Contact
     */
    public $sender;

    /**
     * Реквизиты реального продавца
     * @Type("CdekSDK2\BaseTypes\Seller")
     * @var Seller
     */
    public $seller;

    /**
     * Получатель
     * @Type("CdekSDK2\BaseTypes\Contact")
     * @var Contact
     */
    public $recipient;

    /**
     * Адрес отправления
     * @Type("CdekSDK2\BaseTypes\Location")
     * @var Location
     */
    public $from_location;

    /**
     * Адрес получения
     * @Type("CdekSDK2\BaseTypes\Location")
     * @var Location
     */
    public $to_location;

    /**
     * Дополнительные услуги
     * @Type("array<CdekSDK2\BaseTypes\Services>")
     * @var Services[]
     */
    public $services;

    /**
     * Список информации по местам
     * @Type("array<CdekSDK2\BaseTypes\Package>")
     * @var Package[]
     */
    public $packages;

    /**
     * Список статусов по заказу, отсортированных по дате и времени
     * @SkipWhenEmpty()
     * @Type("array<CdekSDK2\Dto\Statuses>")
     * @var Statuses[]
     */
    public $statuses;

    /**
     * Order constructor.
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'tariff_code' => 'required|numeric',
            'services' => 'array',
            'sender' => [
                'required',
                function ($value) {
                    if ($value instanceof Contact) {
                        return $value->validate();
                    }
                }
            ],
            'recipient' => [
                'required',
                function ($value) {
                    if ($value instanceof Contact) {
                        return $value->validate();
                    }
                }
            ],
            'from_location' => [
                'required',
                function ($value) {
                    if ($value instanceof Location) {
                        return $value->validate();
                    }
                }
            ],
            'to_location' => [
                'required',
                function ($value) {
                    if ($value instanceof Location) {
                        return $value->validate();
                    }
                }
            ],
            'packages' => [
                'required', 'array',
                function ($value) {
                    if (!is_array($value) || empty($value) || count($value) < 1) {
                        return false;
                    }
                    $i = 0;
                    foreach ($value as $item) {
                        if ($item instanceof Package) {
                            $i += (int)$item->validate();
                        }
                    }
                    return ($i === count($value));
                }
            ],
        ];
    }
}
