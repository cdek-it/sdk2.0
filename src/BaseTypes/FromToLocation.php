<?php

declare(strict_types=1);

namespace CdekSDK2\BaseTypes;

use JMS\Serializer\Annotation\Type;

/**
 * Class Location
 * @package CdekSDK2\BaseTypes
 */
class FromToLocation extends Base
{
    /**
     *
     * @Type("string")
     * @var string
     */
    public $code;

    /**
     *
     * @Type("string")
     * @var string
     */
    public $postal_code;

    /**
     *
     * @Type("string")
     * @var string
     */
    public $country_code;

    /**
     *
     * @Type("string")
     * @var string
     */
    public $city;

    /**
     * Широта
     * @Type("string")
     * @var string
     */
    public $address;
}
