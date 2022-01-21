<?php

namespace Csosc\ApiResponse\Http\Middleware;

use Closure;
use Csosc\ApiResponse\Exceptions\ApiSignException;
use Illuminate\Http\Request;

class ApiSecret
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws \Csosc\ApiResponse\Exceptions\ApiSignException
     */
    public function handle(Request $request, Closure $next)
    {
        $params = $request->all();
        if (empty(config('apiresponse.api_sign_salt'))) {
            throw new ApiSignException('Please set the signing salt');

        }
        $exclude = config('apiresponse.exclude');

        if (in_array($request->route()->getName(), $exclude)) {
            return $next($request);
        }
        $ds = $request->header('DS', ',,');

        [$timeStamp, $number, $signStr] = explode(',', $ds);

        if (abs(time() - $timeStamp) > 30) {
            throw new ApiSignException('Invalid request');
        }

        $sign = $this->sign($timeStamp, $number, $params);

        if ($sign != $signStr) {
            throw new ApiSignException('Illegal request');
        }


        return $next($request);
    }

    /**
     * @param $timeStamp
     * @param $number
     * @param $data
     *
     * @return string
     */
    protected function sign($timeStamp, $number, $data): string
    {
        $signPars = "";
        ksort($data);
        foreach ($data as $k => $v) {
            if ("sign" !== $k && "" !== $v && $v !== null) {
                $signPars .= $k . "=" . rawurlencode($v) . "&";
            }
        }
        $salt     = config('apiresponse.api_sign_salt');
        $signPars .= "salt={$salt}&{$timeStamp}&{$number}";

        return strtoupper(hash('sha256', $signPars));
    }
}
