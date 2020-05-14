<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

/**
 * Class WorkTime
 * @package CdekSDK2\BaseTypes
 */
class WorkTime
{
    /**
     * Порядковый номер дня начиная с единицы. Понедельник = 1, воскресенье = 7.
     * @Type("int")
     * @var int
     */
    public $day;

    /**
     * Период работы в эти дни. Если в этот день не работают, то не отображать.
     * @Type("string")
     * @var string
     */
    public $time;
}
