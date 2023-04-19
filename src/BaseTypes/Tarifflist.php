<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use DateTime;
use JMS\Serializer\Annotation\SkipWhenEmpty;
use JMS\Serializer\Annotation\Type;

/**
 * Class Tarifflist
 * @package CdekSDK2\BaseTypes
 */
class Tarifflist extends Base
{
    /**
     *  Типы заказа:
     */
    public const TYPE_ECOMMERCE = 1; //интернет-магазин
    public const TYPE_DELIVERY = 2; //доставка

    /**
     * Язык вывода информации о тарифах
     */
    public const LANG_RUS = 'rus'; //Русский
    public const LANG_END = 'eng'; //Английский
    public const LANG_ZHO = 'zho'; //Китайский

    /**
     * Дата и время планируемой передачи заказа
     * По умолчанию - текущая
     * @Type("string")
     * @var string
     */
    public $date;

    /**
     * Тип заказа:
     * 1 - "интернет-магазин"
     * 2 - "доставка"
     * По умолчанию - 1
     * @Type("integer")
     * @var integer
     */
    public $type;

    /**
     * Валюта, в которой необходимо произвести расчет
     * По умолчанию - валюта договора
     * @Type("integer")
     * @var integer
     */
    public $currency;

    /**
     * Язык вывода информации о тарифах
     * Возможные значения: rus, eng, zho
     * По умолчанию - rus
     * @Type("string")
     * @var string
     */
    public $lang;

    /**
     * Адрес отправителя
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
     * Список информации по местам (упаковкам)
     * @Type("array<int, CdekSDK2\BaseTypes\Package>")
     * @var array
     */
    public $packages;

    /**
     * Intake constructor.
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        parent::__construct($param);

        $timeFormat = \DateTime::ISO8601;
        $this->rules = [
            'date' => "date:{$timeFormat}",
            'type' => 'numeric|in:1,2',
            'currency' => 'numeric',
            'lang' => 'in:rus,eng,zho',
            'from_location' => [
                '',
                function ($value) {
                    if ($value instanceof Location) {
                        return $value->validate();
                    }
                }
            ],
            'to_location' => [
                '',
                function ($value) {
                    if ($value instanceof Location) {
                        return $value->validate();
                    }
                }
            ],
            'packages' => [
                '',
                function ($value) {
                    if ($value instanceof Package) {
                        return $value->validate();
                    }
                }
            ]
        ];
    }
}
