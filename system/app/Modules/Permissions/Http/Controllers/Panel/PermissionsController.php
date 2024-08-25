<?php

namespace Permissions\Http\Controllers\Panel;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    protected string $namespace;
    protected string $module;

    public function __construct() {
        $this->namespace = basename(dirname(__DIR__, 3));
        $this->module = Str::lower(basename(dirname(__DIR__, 3)));
    }

    /**
     * --
     */
    public function index()
    {
        $title = _trans($this->namespace, 'title');

        if(!$this->checkPermission('view ' . $this->module, $title))
            return redirect(Route('panel'));

        _active_menu([$this->module]);

        return view(_moduleName($this->namespace).'::index', ['module' => $this->module] , compact(['title']));
    }
}
