<?php

namespace Module\Admins\Http\Controllers\Web\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected string $namespace;
    protected string $module;

    public function __construct() {
        $this->namespace = basename(dirname(__DIR__, 4));
        $this->module = 'dashboard';
    }

    public function index(): View
    {
        $title = _trans($this->namespace, $this->module.'.title');

        session()->flash('_sidebar_main_resized', '');
        _active_menu([$this->namespace.'-panel']);

        return view(_moduleName($this->namespace).'::account.'. $this->module , ['namespace' => $this->namespace, 'module' => $this->module] , compact(['title']));
    }
}
