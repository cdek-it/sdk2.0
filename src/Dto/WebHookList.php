<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use CdekSDK2\BaseTypes\WebHook;
use JMS\Serializer\Annotation\Type;

class WebHookList
{
    /**
     * Список ПВЗ
     * @Type("array<CdekSDK2\BaseTypes\WebHook>")
     * @var WebHook[]
     */
    public $items = [];
}
