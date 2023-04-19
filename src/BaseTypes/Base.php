<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Rakit\Validation\Validator;

/**
 * Class Base
 * @package CdekSDK2\BaseTypes
 */
class Base
{
    /**
     * Правила для валидаций
     * @Serializer\Exclude()
     * @var array
     */
    protected $rules = [];

    /**
     * Ошибки валидации
     * @Serializer\Exclude()
     * @Type("array")
     * @var array
     */
    protected $validationErrors = [];

    /**
     * Base конструктор
     * @param array $param
     */
    public function __construct(array $param = [])
    {
        foreach ($param as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Валидация правил
     * @return bool
     * @psalm-suppress UndefinedDocblockClass
     */
    public function validate(): bool
    {
        $validator = new Validator();
        $validation = $validator->validate(get_object_vars($this), $this->rules);

        if ($validation->fails()) {
            $this->validationErrors[] = $validation->errors()->all();
        }
        return $validation->passes();
    }

    /**
     * Создание объекта из массива
     * @param array $data
     * @return static
     */
    public static function create(array $data = []): self
    {
        \assert(\is_array($data));

        return new static($data);
    }
}
