<?php

namespace Admins\Http\Controllers\Web\Panel;

use Admins\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Admins\DataTables\AdminsDataTable;
use Admins\Http\Resources\AdminResource;
use Admins\Http\Resources\AdminCollection;

class AdminsController extends Controller
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
    public function index(AdminsDataTable $dataTable)
    {
        $title = _trans($this->namespace, 'title');
        _active_menu([$this->module, 'all-'.$this->module]);

        return $dataTable->render(_moduleSingular($this->namespace).'::panel.pages.index', ['namespace' => $this->namespace, 'module' => $this->module] , compact(['title']));

        // if(!$this->checkPermission('view ' . $this->module, $title))
        //     return redirect(Route('panel'));

        // return view(_moduleName($this->namespace).'::panel.pages.index', ['namespace' => $this->namespace, 'module' => $this->module] , compact(['title']));
    }

    /**
     * --
     */
    public function show(Admin $admin)
    {
        dd($admin);
        $title = _trans($this->namespace, 'view');

        if(!$this->checkPermission('view ' . Str::singular($this->module), $title))
            return redirect(Route('panel'));

        _active_menu([$this->module]);

        return view(_moduleName($this->namespace).'::panel.pages.show', ['namespace' => $this->namespace, 'module' => $this->module] , compact(['title']));
    }

    /**
     * --
     */
    public function create()
    {
        $title = _trans($this->namespace, 'add.new');
        _active_menu([$this->module, 'add-new-'._moduleSingular($this->module)]);

        // if(!$this->checkPermission('add ' . Str::singular($this->module), $title))
        //     return redirect(Route('panel'));

        return view(_moduleName($this->namespace).'::panel.pages.create', ['namespace' => $this->namespace, 'module' => $this->module] , compact(['title']));
    }

    /**
     * --
     */
    public function store(Request $request)
    {

        // forget admins cache
        // _forget_cache($this->module);

        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required|confirmed',
        //     'password_confirmation' => 'required'
        // ], [], [
        //     'email' => __('auth.email.email'),
        //     'password' => __('auth.password.password'),
        //     'password_confirmation' => __('auth.password.confirmation_password'),
        // ]);

        // if($this->sameOldPassword($request->email, $request->password)){
        //     session()->put('error', ['type' => 'alert-danger', 'message' => __('auth.password.same_password')]);
        //     return back();
        // }
    }

    /**
     * --
     */
    public function edit(Admin $admin)
    {
        dd($admin);
        $title = _trans($this->namespace, 'edit');

        if(!$this->checkPermission('edit ' . Str::singular($this->module), $title))
            return redirect(Route('panel'));

        _active_menu([$this->module]);

        return view(_moduleName($this->namespace).'::panel.pages.edit', ['namespace' => $this->namespace, 'module' => $this->module] , compact(['title']));
    }

    /**
     * --
     */
    public function update(Request $request)
    {
        //

        // forget admins cache
        // _forget_cache($this->module);
    }

    /**
     * --
     */
    public function delete(Request $request)
    {
        if(is_numeric($request->id)){
            // delete admin
            Admin::where('id', $request->id)->delete();

            // forget admins cache
            //_forget_cache($this->module);

            // put success alert
            session()->put('alert', ['type' => 'alert-success', 'dismissible' => 'alert-dismissible', 'message' => _trans($this->namespace, 'deleted-success-message')]);
            Goto End;
        }

        session()->put('alert', ['type' => 'alert-danger', 'dismissible' => 'alert-dismissible', 'message' => _trans($this->namespace, 'deleted-error-message')]);

        End:
        return back();
    }

    /**
     * --
     */
    public function restore($id)
    {
        //

        // forget admins cache
        // _forget_cache($this->module);
    }

    /**
     * --
     */
    public function destroy(Request $request)
    {
        //

        // forget admins cache
        // _forget_cache($this->module);
    }

    /**
     * return datatable admins ajax
     */
    // public function getAllAjax()
    // {
    //     // if(request()->ajax()){
    //         // return cache()->remember(_get_cache_name($this->module), _settings('general', 'cache_remember_time'), function(){
    //             $query = Admin::with('adminStatus')
    //                 ->with('adminTitle')
    //                 ->with('adminGender')
    //                 // ->whereNot('id', auth()->user()->id)
    //                 ->get();

    //             $collection = AdminResource::collection($query);

    //             return DataTables::of($collection)
    //                 ->addIndexColumn()
    //                 // ->addColumn('avatar', function($row) {
    //                 //     return (!empty($row->profile_pic))? $row->profile_pic : url('public/images/placeholders/admin_'. $row['gender']['code'] .'.png') ;
    //                 // })
    //                 // ->addColumn('status', function($row) {
    //                 //     return '<span class="badge badge-'.$row['status']['color'].'">'.$row['status']['name'].'</span>';
    //                 // })
    //                 ->addColumn('action', function($row) {
    //                     return $action = '
    //                         <div class="list-icons">
    //                             <div class="dropdown">
    //                                 <a href="#" class="list-icons-item" data-toggle="dropdown">
    //                                     <i class="icon-menu9"></i>
    //                                 </a>

    //                                 <div class="dropdown-menu dropdown-menu-right">
    //                                     <a href="'. Route($this->module.'.show', $row['id']) .'" class="dropdown-item text-capitalize"><i class="icon-file-pdf"></i> '. _trans($this->namespace, 'view-button') .'</a>
    //                                     <a href="'. Route($this->module.'.edit', $row['id']) .'" class="dropdown-item text-capitalize"><i class="icon-file-pdf"></i> '. _trans($this->namespace, 'edit-button') .'</a>
    //                                     <a data-id="'.$row['id'].'" id="deleteBtn" class="dropdown-item text-capitalize" data-toggle="modal" data-target="#deletemodal"><i class="icon-trash-alt"></i> '. _trans($this->namespace, 'delete-button') .'</a>
    //                                     <a data-id="'.$row['id'].'" id="distroyBtn" class="dropdown-item text-capitalize" data-toggle="modal" data-target="#distroymodal"><i class="icon-cancel-circle2"></i> '. _trans($this->namespace, 'distroy-button') .'</a>
    //                                     <a data-id="'.$row['id'].'" id="restoreBtn" class="dropdown-item text-capitalize" data-toggle="modal" data-target="#restoremodal"><i class="icon-reset"></i> '. _trans($this->namespace, 'restore-button') .'</a>
    //                                 </div>
    //                             </div>
    //                         </div>';
    //                 })
    //                 ->addColumn('group', function() {
    //                     return '';
    //                 })
    //                 ->rawColumns([
    //                     // 'avatar',
    //                     // 'status',
    //                     'action',
    //                     'group'
    //                 ])
    //                 ->make(true);
    //         // });

    //     // }else{
    //     //     abort(404);
    //     // }
    // }

    /**
     * return datatable admins ajax
     */
    public static function generateAdminCode($name = '', $type = null)
    {
        $type = ($type == null)? ((DB::connection()->getName() == 'landlord')? 'LAND' : 'ADMI') : Str::replace('.', '', Str::limit(Str::upper($type), 4)) ;

        generate:
        $name = Str::replace('.', '', '-'.Str::limit(Str::upper($name), 4));
        $code = str($type.'-'. mt_rand(111111, 999999))->append($name);

        if(Admin::where('code', $code)->first()){
            goto generate;
        }

        return $code;
    }

    /**
     * check if current admin is cahced admin or not
     * to det specific cached data for this admin
     * and return with @admin data
     */
    // static function forgetAdminCache($cacheName)
    // {
    //     $admin = auth()->user()->code;

    //     if(cache()->has('panel-current-admin-'.$admin->code)){
    //         $currentAdmin = cache('panel-current-admin-'.$admin->code);
    //         if($currentAdmin['code'] != $admin->code){
    //             _forget_cache($cacheName);
    //             _forget_cache('panel-current-admin-'.$admin->code);
    //         }
    //     }

    //     return cache()->remember('panel-current-admin-'.$admin->code, 60*60*24, function() use($admin){return $admin;});
    // }
}
