<?php

namespace Module\General\Http\Controllers\Web\Panel;

use Module\General\Models\Status;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Module\General\Http\Resources\Status\StatusCollection;

class StatusController extends Controller
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

    // public function getAllAjax()
    // {
    //     $status = StatusResource::collection(
    //         Status::with('statusTrans')->get()
    //     );

    //     return Datatables::of($status)
    //         ->addIndexColumn()
    //         ->addColumn('status', function ($row) {
    //             return $status = '<span class="badge badge-' . $row['status']['color'] . '">' . $row['status']['name'] . '</span>';
    //         })
    //         ->addColumn('action', function ($row) {
    //             return $action = '
    //                 <div class="list-icons">
    //                     <div class="dropdown">
    //                         <a href="#" class="list-icons-item" data-toggle="dropdown">
    //                             <i class="icon-menu9"></i>
    //                         </a>

    //                         <div class="dropdown-menu dropdown-menu-right">
    //                             <!-- <a href="' . Route('languages.show', $row['id']) . '" class="dropdown-item"><i class="icon-eye4"></i> ' . Str::title(__('control_panel.global.view')) . '</a> --!>
    //                             <a href="' . Route('languages.edit', $row['id']) . '" class="dropdown-item"><i class="icon-pencil7"></i> ' . Str::title(__('control_panel.global.edit')) . '</a>
    //                             <a data-id="' . $row['id'] . '" id="deleteBtn" class="dropdown-item" data-toggle="modal" data-target="#deletemodal"><i class="icon-trash-alt"></i> ' . Str::title(__('control_panel.global.delete')) . '</a>
    //                             <a data-id="' . $row['id'] . '" id="restoreBtn" class="dropdown-item" data-toggle="modal" data-target="#restoremodal"><i class="icon-spinner11"></i> ' . Str::title(__('control_panel.global.restore')) . '</a>
    //                             <a data-id="' . $row['id'] . '" id="distroyBtn" class="dropdown-item" data-toggle="modal" data-target="#distroymodal"><i class="icon-blocked"></i> ' . Str::title(__('control_panel.global.distroy')) . '</a>
    //                         </div>
    //                     </div>
    //                 </div>';
    //         })
    //         ->addColumn('group', function () {
    //             return '';
    //         })
    //         ->rawColumns(['status', 'action', 'group'])
    //         ->make(true);
    // }
}
