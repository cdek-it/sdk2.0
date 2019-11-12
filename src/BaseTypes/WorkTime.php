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
 * Class WorkTime
 * @package CdekSDK2\BaseTypes
 */
class WorkTime extends Base
{
    /**
     * Порядковый номер дня начиная с единицы. Понедельник = 1, воскресенье = 7.
     * @Type("int")
     * @var int
     */
    private $day;

    /**
     * Период работы в эти дни. Если в этот день не работают, то не отображать.
     * @Type("string")
     * @var string
     */
    private $periods;
}
