<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class DeliveryDetail
{
    /**
     * Дата доставки
     * @Type("string")
     * @var string
     */
    public $date;

    /**
     * Получатель при доставке
     * @Type("string")
     * @var string
     */
    public $recipient_name;

    /**
     * Сумма наложенного платежа, которую взяли с получателя,
     * в валюте страны получателя, по умолчанию руб. с учетом частичной доставки
     * @Type("float")
     * @var float
     */
    public $payment_sum;

    /**
     * Стоимость услуги доставки
     * @Type("float")
     * @var float
     */
    public $delivery_sum;

    /**
     * Итоговая стоимость заказа
     * @Type("float")
     * @var float
     */
    public $total_sum;
}
