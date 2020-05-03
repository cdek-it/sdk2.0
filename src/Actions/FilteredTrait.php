<?php

declare(strict_types=1);

namespace CdekSDK2\Actions;

use CdekSDK2\Constants;
use CdekSDK2\Http\ApiResponse;

trait FilteredTrait
{
    /**
     * @param array $filter
     * @return ApiResponse
     */
    public function getFiltered(array $filter = []): ApiResponse
    {
        $add_params = '';
        if (!empty($filter)) {
            $filtered = [];
            foreach ($filter as $k => $v) {
                if (array_key_exists($k, Constants::OFFICE_FILTER)) {
                    $filtered[$k] = $v;
                }
            }
            $filter = array_replace(Constants::OFFICE_FILTER, $filtered);
            $add_params = empty($filter) ? '' : http_build_query($filter);
        }
        return $this->get($add_params);
    }

    /**
     * Переиспользуем стандартный метод
     * @param string $filter
     * @return ApiResponse
     */
    public function get(string $filter = ''): ApiResponse
    {
        return $this->http_client->get(self::URL . '?' . $filter);
    }
}
