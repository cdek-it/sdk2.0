<?php

declare(strict_types=1);

namespace CdekSDK2\Dto;

use JMS\Serializer\Annotation\Type;

/**
 * Class Request
 * @package CdekSDK2\Dto
 */
class Request
{
    /**
     * Идентификатор запроса
     * @Type("string")
     * @var string
     */
    public $request_uuid;

    /**
     * Тип запроса
     * Может принимать значения: CREATE, UPDATE, DELETE, AUTH, GET
     * @Type("string")
     * @var string
     */
    public $type;

    /**
     * Текущее состояние запроса
     * Может принимать значения: ACCEPTED, WAITING, SUCCESSFUL, INVALID
     * @Type("string")
     * @var string
     */
    public $state;

    /**
     * Время
     * @Type("string")
     * @var string
     */
    public $date_time;

    /**
     * Список ошибок
     * @Type("array<CdekSDK2\Dto\Error>")
     * @var Error[]
     */
    public $errors;

    /**
     * Список предупреждений
     * @Type("array<CdekSDK2\Dto\Warning>")
     * @var Warning[]
     */
    public $warnings;
}
