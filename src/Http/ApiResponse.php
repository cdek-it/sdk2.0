<?php

declare(strict_types=1);

namespace CdekSDK2\Http;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiResponse
 * @package CdekSDK2\Http
 */
class ApiResponse
{
    /**
     * Тело ответа
     * @var string
     */
    private $body;

    /**
     * Массив ошибок
     * @var array
     */
    private $errors = [];

    /**
     * HTTP-статус ответа
     * @var int
     */
    private $status;

    /**
     * ApiResponse constructor.
     * @param ResponseInterface|null $response
     */
    public function __construct(ResponseInterface $response = null)
    {
        if ($response === null) {
            $this->status = 500;
            $this->body = '';

            $this->errors[] = [
                'code' => 'internal_error',
                'message' => 'Internal Server Error'
            ];
        } else {
            $this->status = $response->getStatusCode();
            if (
                $response->hasHeader('Content-type') &&
                strpos(implode(',', $response->getHeader('Content-type')), 'json') !== false
            ) {
                $this->body = $response->getBody()->getContents();
            } else {
                $this->body = (string)$response->getBody();
            }


            $decode_body = json_decode($this->body, true);
            $this->addErrorsFromArrayIfExists($decode_body);
            if (isset($decode_body['requests']) && is_array($decode_body['requests'])) {
                foreach ($decode_body['requests'] as $request) {
                    $this->addErrorsFromArrayIfExists($request);
                }
            }
        }
    }

    private function addErrorsFromArrayIfExists(?array $array): void
    {
        if (isset($array['error'])) {
            $this->errors[] = [
                'code' => $array['error'],
                'message' => $array['error_description'] ?? $array['message'] ?? 'unknown_error'
            ];
        } elseif (isset($array['errors'])) {
            $this->errors = array_merge($this->errors, $array['errors']);
        }
    }

    /**
     * Проверка корректности выполненного запроса
     * @return bool
     */
    public function isOk(): bool
    {
        return $this->status >= 200 && $this->status <= 299;
    }

    /**
     * Проверка наличия ошибок в запросе
     * @return bool
     */
    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}
