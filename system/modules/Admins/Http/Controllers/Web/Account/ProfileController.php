<?php

namespace Module\Admins\Http\Controllers\Web\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Module\General\Models\Gender;
use Module\General\Models\Title;
use Admins\Models\Admin;
use Admins\Http\Resources\AdminResource;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected string $namespace;
    protected string $module;

    public function __construct() {
        $this->namespace = basename(dirname(__DIR__, 4));
        $this->module = 'profile';
    }

    public function index(): View
    {
        _active_menu(['dashboard']);
        session()->flash('_sidebar_main_resized', 'sidebar-main-resized');
        $title = _trans($this->namespace, $this->module.'.title');

        $genders = Gender::with('name')->arrangement()->active()->get();
        $titles = Title::with('name')->arrangement()->active()->get();

        return view(_moduleName($this->namespace).'::account.'. $this->module , ['namespace' => $this->namespace, 'module' => $this->module] , compact(['title', 'genders', 'titles']));
    }
}
