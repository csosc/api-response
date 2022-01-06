<?php

use App\Models\Setting;
use App\Utils\CryptoCurrencyPHP\Signature;
use App\Utils\Ip2Region;
use IEXBase\TronAPI\Tron;
use kornrunner\Keccak;

if (!function_exists('_success')) {
    /**
     * 正确返回
     *
     * @param array  $data
     * @param string $message
     *
     * @return array
     */
    function _success($data = [], string $message = 'success'): array
    {
        return [
            'code'      => 0,
            'message'   => $message,
            'data'      => $data,
            'timeStamp' => time(),
        ];
    }
}
if (!function_exists('_error')) {
    /**
     * 错误返回
     *
     * @param string $message
     * @param int    $code
     *
     * @return array
     */
    function _error(string $message = 'error', int $code = 1): array
    {
        return [
            'code'      => $code,
            'message'   => $message,
            'data'      => [],
            'timeStamp' => time(),
        ];

    }
}

