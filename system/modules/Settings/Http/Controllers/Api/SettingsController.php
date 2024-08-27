<?php

namespace Module\Settings\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Service\ApiResponseService;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
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
    public function secretKey()
    {
        try {
            $data['secretKey'] = _settings('settings', 'secret_key');
            $this->api->setData( [$data]);
        } catch (\Throwable $th) {
            $this->api->setException($th);
            $this->api->setEc(100);
        }

        // return json data
        return $this->api->apiResponse();
    }
}
