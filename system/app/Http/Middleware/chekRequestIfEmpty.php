<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Service\ApiResponseService;
use Symfony\Component\HttpFoundation\Response;

class chekRequestIfEmpty
{
    protected $api;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // initialize api response
        $this->api = new ApiResponseService();

        // if request not have any parameters
        if(count(request()->all()) == 0){
            $this->api->setCode(201);
            $this->api->setMessages(['thhis method require parameters']);

            return $this->api->apiResponse();
        }

        return $next($request);
    }
}
