<?php

namespace General\Http\Controllers\Api;

use General\Models\Status;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Service\ApiResponseService;
use App\Http\Controllers\Controller;
use General\Http\Resources\Status\StatusResource;

class StatusController extends Controller
{
    protected $api;
    protected string $namespace;
    protected string $module;

    public function __construct() {
        $this->namespace = basename(dirname(__DIR__, 3));
        $this->module = Str::lower($this->namespace);

        // initialize api response
        $this->api = new ApiResponseService();
    }

    /**
     * --
     */
    public function index(Request $request)
    {
        /**
         * this function to return status of system
         */
        try {
            $this->api->setData(StatusResource::collection(
                Status::where(function($query) use($request) {
                    if($request->has('module')){
                        return $query->where('module', $request->module);
                    }
                })
                ->arrangement()
                ->get()
            ));
        } catch (\Throwable $th) {
            $this->api->setException($th);
            $this->api->setEc(100);
        }

        // return json data
        return $this->api->apiResponse();
    }
}
