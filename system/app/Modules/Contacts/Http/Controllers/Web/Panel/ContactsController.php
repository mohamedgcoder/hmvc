<?php

namespace Contacts\Http\Controllers\Web\Panel;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    protected string $namespace;
    protected string $module;

    public function __construct() {
        $this->namespace = basename(dirname(__DIR__, 4));
        $this->module = Str::lower($this->namespace);
    }

    /**
     * --
     */
    public function index()
    {
        $title = _trans($this->namespace, 'title');

        // if(!$this->checkPermission('view ' . $this->module, $title))
        //     return redirect(Route('panel'));

        _active_menu([_modulelowerSingularName($this->namespace)]);

        return view(_moduleName($this->namespace).'::panel.pages.index', ['namespace' => $this->namespace, 'module' => $this->module] , compact(['title']));
    }
}
