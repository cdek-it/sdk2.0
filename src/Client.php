<?php

declare(strict_types=1);

namespace CdekSDK2;

use CdekSDK2\Actions\Barcodes;
use CdekSDK2\Actions\Calculator;
use CdekSDK2\Actions\Intakes;
use CdekSDK2\Actions\Invoices;
use CdekSDK2\Actions\LocationCities;
use CdekSDK2\Actions\LocationRegions;
use CdekSDK2\Actions\Offices;
use CdekSDK2\Actions\Orders;
use CdekSDK2\Actions\Webhooks;
use CdekSDK2\Dto\CityList;
use CdekSDK2\Dto\RegionList;
use CdekSDK2\Dto\Tariff;
use CdekSDK2\Dto\TariffList;
use CdekSDK2\Dto\WebHookList;
use CdekSDK2\Dto\PickupPointList;
use CdekSDK2\Dto\Response;
use CdekSDK2\Exceptions\AuthException;
use CdekSDK2\Exceptions\ParsingException;
use CdekSDK2\Exceptions\RequestException;
use CdekSDK2\Http\Api;
use CdekSDK2\Http\ApiResponse;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Psr\Http\Client\ClientInterface;

/**
 * Class Client
 * @package CdekSDK2
 */
class Client
{
    /**
     * Объект для взаимодействия с API СДЭК
     * @var Api
     */
    private $http_client;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var Orders
     */
    private $orders;

    /**
     * @var Intakes
     */
    private $intakes;

    /**
     * @var Calculator
     */
    private $calculator;

    /**
     * @var Webhooks
     */
    private $webhooks;

    /**
     * @var Offices
     */
    private $offices;

    /**
     * @var Barcodes
     */
    private $barcodes;

    /**
     * @var Invoices
     */
    private $invoices;

    /**
     * @var LocationRegions
     */
    private $regions;

    /**
     * @var LocationCities
     */
    private $cities;

    /**
     * Client constructor.
     * @param ClientInterface $http
     * @param string|null $account
     * @param string|null $secure
     * @psalm-suppress PropertyTypeCoercion
     */
    public function __construct(ClientInterface $http, string $account = null, string $secure = null)
    {
        $this->http_client = new Api($http, $account, $secure);
        $this->serializer = SerializerBuilder::create()->setPropertyNamingStrategy(
            new SerializedNameAnnotationStrategy(
                new IdenticalPropertyNamingStrategy()
            )
        )->build();
    }

    /**
     * @return string
     */
    public function getAccount(): string
    {
        return $this->http_client->getAccount();
    }

    /**
     * @param string $account
     * @return self
     */
    public function setAccount(string $account): self
    {
        $this->http_client->setAccount($account);
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->http_client->getToken();
    }

    /**
     * @param string $token
     * @return self
     */
    public function setToken(string $token): self
    {
        $this->http_client->setToken($token);
        return $this;
    }

    /**
     * @return string
     */
    public function getSecure(): string
    {
        return $this->http_client->getSecure();
    }

    /**
     * @param string $secure
     * @return self
     */
    public function setSecure(string $secure): self
    {
        $this->http_client->setSecure($secure);
        return $this;
    }

    /**
     * @return bool
     */
    public function isTest(): bool
    {
        return $this->http_client->isTest();
    }

    /**
     * @param bool $test
     * @return self
     */
    public function setTest(bool $test): self
    {
        $this->http_client->setTest($test);
        return $this;
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->http_client->isExpired();
    }

    /**
     * @return int
     */
    public function getExpire(): int
    {
        return $this->http_client->getExpire();
    }

    /**
     * @param int $timestamp
     * @return self
     */
    public function setExpire(int $timestamp): self
    {
        $this->http_client->setExpire($timestamp);
        return $this;
    }

    /**
     * Авторизация клиента в сервисе Интеграции
     * @return bool
     * @throws AuthException
     * @throws Exceptions\RequestException
     */
    public function authorize(): bool
    {
        return $this->http_client->authorize();
    }

    /**
     * @return Intakes
     */
    public function intakes(): Intakes
    {
        if ($this->intakes === null) {
            $this->intakes = new Intakes($this->http_client, $this->serializer);
        }
        return $this->intakes;
    }

    /**
     * @return Calculator
     */
    public function calculator(): Calculator
    {
        if ($this->calculator === null) {
            $this->calculator = new Calculator($this->http_client, $this->serializer);
        }
        return $this->calculator;
    }

    /**
     * @return Orders
     */
    public function orders(): Orders
    {
        if ($this->orders === null) {
            $this->orders = new Orders($this->http_client, $this->serializer);
        }
        return $this->orders;
    }

    /**
     * @return Offices
     */
    public function offices(): Offices
    {
        if ($this->offices === null) {
            $this->offices = new Offices($this->http_client, $this->serializer);
        }
        return $this->offices;
    }

    /**
     * @return LocationRegions
     */
    public function regions(): LocationRegions
    {
        if ($this->regions === null) {
            $this->regions = new LocationRegions($this->http_client, $this->serializer);
        }
        return $this->regions;
    }

    /**
     * @return LocationCities
     */
    public function cities(): LocationCities
    {
        if ($this->cities === null) {
            $this->cities = new LocationCities($this->http_client, $this->serializer);
        }
        return $this->cities;
    }

    /**
     * @return Webhooks
     */
    public function webhooks(): Webhooks
    {
        if ($this->webhooks === null) {
            $this->webhooks = new Webhooks($this->http_client, $this->serializer);
        }
        return $this->webhooks;
    }

    /**
     * @return Invoices
     */
    public function invoice(): Invoices
    {
        if ($this->invoices === null) {
            $this->invoices = new Invoices($this->http_client, $this->serializer);
        }
        return $this->invoices;
    }

    /**
     * @return Barcodes
     */
    public function barcodes(): Barcodes
    {
        if ($this->barcodes === null) {
            $this->barcodes = new Barcodes($this->http_client, $this->serializer);
        }
        return $this->barcodes;
    }

    /**
     * @param ApiResponse $response
     * @param string $className
     * @return Response
     * @throws \Exception
     */
    public function formatResponse(ApiResponse $response, string $className): Response
    {
        $this->checkResponseIsOkOrThrowError($response);

        if (!class_exists($className)) {
            throw new ParsingException('Class ' . $className . ' not found');
        }

        /* @var $result Response */
        $result = $this->serializer->deserialize($response->getBody(), Response::class, 'json');
        $result->entity = null;

        $array_response = json_decode($response->getBody(), true);
        $entity = $this->serializer->deserialize(json_encode($array_response['entity']), $className, 'json');
        $result->entity = $entity;

        return $result;
    }

    /**
     * Пока что этот метод возвращет только Tariff, так как нужен только для одного запроса
     * @param ApiResponse $response
     * @param string $className
     * @return Tariff
     * @throws \Exception
     */
    public function formatBaseResponse(ApiResponse $response, string $className): Tariff
    {
        $this->checkResponseIsOkOrThrowError($response);

        if (!class_exists($className)) {
            throw new ParsingException('Class ' . $className . ' not found');
        }

        return $this->serializer->deserialize($response->getBody(), $className, 'json');
    }

    /**
     * @param ApiResponse $response
     * @param string $className
     * @return CityList|RegionList|PickupPointList|WebHookList|TariffList
     * @throws \Exception
     */
    public function formatResponseList(ApiResponse $response, string $className)
    {
        $this->checkResponseIsOkOrThrowError($response);

        if (!class_exists($className)) {
            throw new ParsingException('Class ' . $className . ' not found');
        }

        if ((new \ReflectionClass($className))->getShortName() == 'TariffList') {
            return $this->serializer->deserialize($response->getBody(), $className, 'json');
        }

        $body = '{"items":' . $response->getBody() . '}';
        return $this->serializer->deserialize($body, $className, 'json');
    }

    /**
     * @throws RequestException
     */
    protected function checkResponseIsOkOrThrowError(ApiResponse $response): void
    {
        if ($response->isOk()) {
            return;
        }

        $errors = $response->getErrors();
        throw new RequestException($errors[0]['message'], $response->getStatus());
    }
}
