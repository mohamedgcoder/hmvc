<?php

namespace General\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class GendersController extends Controller
{
    protected string $namespace;
    protected string $module;

    public function __construct() {
        $this->namespace = basename(dirname(__DIR__, 3));
        $this->module = Str::lower($this->namespace);
    }

    /**
     * --
     */
    public function index()
    {
        $title = _trans($this->namespace, 'title');

        if (!$this->checkPermission('view ' . $this->module, $title)) {
            return redirect(Route('panel'));
        }

        _active_menu([Str::lower(Str::singular($this->namespace)), $this->module]);

        return view(_moduleName($this->namespace) . '::index', ['namespace' => $this->namespace, 'module' => $this->module], compact(['title']));
    }
}
