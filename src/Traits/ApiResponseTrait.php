<?php

namespace Csosc\ApiResponse\Traits;


trait ApiResponseTrait
{

    /**
     * @param array $data
     *
     * @param int   $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response(array $data, int $status = 200): \Illuminate\Http\JsonResponse
    {
        return \response()->json($data, $status);
    }


    /**
     * 失败的时候调用
     *
     * @param     $message
     * @param int $code
     *
     * @param int $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($message, int $code = 1, int $status = 200): \Illuminate\Http\JsonResponse
    {
        return $this->response(_error($message, $code), $status);
    }

    /**
     * 失败的时候调用
     *
     * @param     $message
     * @param int $code
     *
     * @param int $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function fail($message, int $code = 1, int $status = 200): \Illuminate\Http\JsonResponse
    {
        return $this->response(_error($message, $code), $status);
    }


    /**
     * 成功的时候调用
     *
     * @param array  $data
     * @param string $message
     * @param int    $status
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data = [], string $message = 'success', int $status = 200): \Illuminate\Http\JsonResponse
    {
        return $this->response(_success($data, $message), $status);
    }

}
