<?php

namespace Module\General\Http\Controllers\Api;

use Module\General\Models\Gender;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Service\ApiResponseService;
use App\Http\Controllers\Controller;
use Module\General\Http\Resources\Gender\GenderResource;

class GendersController extends Controller
{
    protected $api;
    protected string $module;
    protected string $namespace;

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
         * this function to return genders of system
         */
        try {
            $this->api->setData(GenderResource::collection(
                Gender::where(function($query) use($request) {
                    // specific status
                    if($request->has('status')){
                        if($request->status == 2)
                            return $query->active();

                        if($request->status == 3)
                            return $query->inactive();

                        if(!in_array($request->status, [2,3]))
                            return $query->allStatus();
                    }

                    // specific
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
