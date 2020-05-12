<?php

namespace CdekSDK2\BaseTypes;

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
