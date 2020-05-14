<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class WebHook
 * @package CdekSDK2\BaseTypes
 */
class WebHook extends Base
{
    /**
     * Идентификатор подписки
     * @Type("string")
     * @var string
     */
    public $uuid;

    /**
     * Тип события
     * @Type("string")
     * @var string
     */
    public $type;

    /**
     * URL клиента для получения вебхуков
     * @Type("string")
     * @var string
     */
    public $url;

    /**
     * WebHook constructor.
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        parent::__construct($param);
        $this->rules = [
            'type' => 'required|alpha_dash',
            'url' => 'required|url',
        ];
    }
}
