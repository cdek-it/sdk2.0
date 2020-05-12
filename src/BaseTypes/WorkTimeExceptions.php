<?php

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

class WorkTimeExceptions
{
    /**
     * Дата
     * @Type("string")
     * @var string
     */
    private $date;

    /**
     * Период работы в указанную дату. Если в этот день не работают, то не отображается.
     * @Type("string")
     * @var string
     */
    private $time;

    /**
     * Признак рабочего/нерабочего дня в указанную дату
     * @Type("boolean")
     * @var boolean
     */
    private $is_working;
}
