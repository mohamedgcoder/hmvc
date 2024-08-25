<?php

namespace Languages\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Languages\Models\Language;
use App\Service\ApiResponseService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Languages\Http\Resources\LanguageResource;

class LanguagesController extends Controller
{
    protected ApiResponseService $api;
    protected string $module;
    protected string $namespace;

    public function __construct() {
        $this->namespace = basename(dirname(__DIR__, 3));
        $this->module = Str::lower($this->namespace);

        // initialize api response
        $this->api = new ApiResponseService();
    }

    public function systemLanguages(Request $request): \Illuminate\Http\JsonResponse
    {
        /**
         * this function to return languages of system
         */

        try {
            $data = Cache::remember('languages', 60*60*24, function () use($request) {
                return Language::where(function($query) use($request) {
                    if($request->has('status')){
                        if($request->status == 2)
                            return $query->active();

                        if($request->status == 3)
                            return $query->inactive();

                        if(!in_array($request->status, [2,3]))
                            return $query->allStatus();
                    }
                })
                ->with('nameTrans')
                ->with('statusTrans')
                ->arrangement()
                ->paginate(2);
                // ->get();
            });

            $this->api->setData(LanguageResource::collection($data));
        } catch (\Throwable $th) {
            $this->api->setException($th);
            $this->api->setEc(100);
        }

        // return json data
        return $this->api->apiResponse();
    }
}
