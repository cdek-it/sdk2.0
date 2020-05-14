<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

class WorkTimeExceptions
{
    /**
     * Дата
     * @Type("string")
     * @var string
     */
    public $date;

    /**
     * Период работы в указанную дату. Если в этот день не работают, то не отображается.
     * @Type("string")
     * @var string
     */
    public $time;

    /**
     * Признак рабочего/нерабочего дня в указанную дату
     * @Type("bool")
     * @var bool
     */
    public $is_working;
}
