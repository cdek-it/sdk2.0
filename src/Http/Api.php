<?php

declare(strict_types=1);

namespace CdekSDK2\Http;

use CdekSDK2\Constants;
use CdekSDK2\Exceptions\AuthException;
use CdekSDK2\Exceptions\RequestException;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\Uri;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

/**
 * Class Api
 * @package CdekSDK2\Http
 */
class Api
{
    /**
     * Аккаунт сервиса интеграции
     * @var string
     */
    private $account;

    /**
     * Секретный пароль сервиса интеграции
     * @var string
     */
    private $secure;

    /**
     * Тестовые настройки интеграции
     * @var bool
     */
    private $test = false;

    /**
     * @var string
     */
    private $token = '';

    /**
     * @var int
     */
    private $expire = 0;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Api constructor.
     * @param ClientInterface $http
     * @param string|null $account
     * @param string|null $secure
     */
    public function __construct(ClientInterface $http, string $account = null, string $secure = null)
    {
        $this->account = $account ?? '';
        $this->secure = $secure ?? '';
        $this->client = $http;
    }

    /**
     *
     * @return string
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * @param string $account
     */
    public function setAccount(string $account): void
    {
        $this->account = $account;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getSecure(): string
    {
        return $this->secure;
    }

    /**
     * @param string $secure
     */
    public function setSecure(string $secure): void
    {
        $this->secure = $secure;
    }

    /**
     * @return bool
     */
    public function isTest(): bool
    {
        return $this->test;
    }

    /**
     * @param bool $test
     */
    public function setTest(bool $test): void
    {
        $this->test = $test;
        if ($test) {
            $this->account = Constants::TEST_ACCOUNT;
            $this->secure = Constants::TEST_SECURE;
        }
    }

    /**
     * Авторизация клиента в сервисе Интеграции
     * @return bool
     * @throws AuthException
     * @throws RequestException
     */
    public function authorize(): bool
    {
        $param = [
            Constants::AUTH_KEY_TYPE => Constants::AUTH_PARAM_CREDENTIAL,
            Constants::AUTH_KEY_CLIENT_ID => $this->account,
            Constants::AUTH_KEY_SECRET => $this->secure,
        ];
        $response = $this->post('/oauth/token', $param);
        if ($response->isOk()) {
            $token_info = $this->decodeBody($response->getBody());
            $this->token = $token_info['access_token'] ?? '';
            $this->expire = $token_info['expires_in'] ?? 0;
            $this->expire = time() + $this->expire - 10;
            return true;
        }
        throw new AuthException(Constants::AUTH_FAIL);
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->expire < time();
    }

    /**
     * @return int
     */
    public function getExpire(): int
    {
        return $this->expire;
    }

    /**
     * @param int $timestamp
     */
    public function setExpire(int $timestamp): void
    {
        $this->expire = $timestamp;
    }

    /**
     * @param string $url
     * @param array $params
     * @return ApiResponse
     * @throws RequestException
     */
    public function post(string $url, array $params = []): ApiResponse
    {
        return $this->request('POST', $url, $params);
    }

    /**
     * @param string $url
     * @return ApiResponse
     * @throws RequestException
     */
    public function get(string $url): ApiResponse
    {
        return $this->request('GET', $url);
    }

    /**
     * @param string $url
     * @return ApiResponse
     * @throws RequestException
     */
    public function delete(string $url): ApiResponse
    {
        return $this->request('DELETE', $url);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $params
     * @return ApiResponse
     * @throws RequestException
     */
    protected function request(string $method, string $url, array $params = []): ApiResponse
    {
        $url = ($this->test ? Constants::API_URL_TEST : Constants::API_URL) . $url;
        $uri = new Uri($url);
        try {
            $headers = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ];
            if ($this->isExpired() && strripos($url, 'oauth/token') === false) {
                $this->authorize();
            } elseif (strripos($url, 'oauth/token') !== false) {
                $headers['Content-Type'] = 'application/x-www-form-urlencoded';
            }

            $body = (strripos($url, 'oauth/token') === false)
                ? (string)json_encode($params) : http_build_query($params);
            if (!empty($this->token)) {
                $headers['Authorization'] = 'Bearer ' . $this->token;
            }
            $request = new Request($method, $uri, $headers, $body);
            $response = $this->client->sendRequest($request);
            return new ApiResponse($response);
        } catch (ClientExceptionInterface $e) {
            throw new RequestException($e->getMessage(), (int)$e->getCode());
        } catch (\Exception $e) {
            throw new RequestException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Преобразовываем json в массив
     * @param string $body
     * @return array
     */
    private function decodeBody(string $body): array
    {
        $decoded_body = json_decode($body, true);
        if ($decoded_body === null || !is_array($decoded_body)) {
            $decoded_body = [];
        }
        return $decoded_body;
    }
}
