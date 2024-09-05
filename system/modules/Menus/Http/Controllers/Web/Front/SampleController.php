<?php

namespace Samples\Http\Controllers\Front;

use Image;
use Carbon\Carbon;
use Samples\Models\Sample;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SampleController extends Controller
{
    private $moduleName = 'Samples';

    public function index(){
        return __(_moduleSingular($this->moduleName).'::index.welcome');
    }
}
