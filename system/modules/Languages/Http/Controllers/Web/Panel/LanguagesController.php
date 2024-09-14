<?php

namespace Module\Languages\Http\Controllers\Web\Panel;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Geographic\Models\Country;
use Module\Admins\Models\Admin;

use Yajra\Datatables\Datatables;
use Module\General\Models\Status;
use Module\Settings\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Module\Languages\Models\Language;
use Illuminate\Support\Facades\Validator;
use Module\Languages\Models\Translations;
use Stevebauman\Location\Facades\Location;
use Geographic\Http\Resources\CountryResource;
use Module\Languages\Http\Resources\LanguageResource;

use Module\General\Http\Resources\Status\StatusResource;

class LanguagesController extends Controller
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
        $this->module = 'locales';
        $title = _trans($this->namespace, $this->module);

        // if(!$this->checkPermission('view ' . $this->module, $title))
        //     return redirect(Route('panel'));

        _active_menu([$this->namespace, 'locales']);
        return view(_moduleName($this->namespace).'::panel.pages.'.$this->module.'.index' , ['namespace' => $this->namespace, 'title' => $title] , compact([]));
    }

    public function create()
    {
        $title =_trans($this->namespace, 'add');
        $ip = request()->ip();
        // $location = Location::get('45.241.19.45');

    //   {
    //     +ip: "45.241.19.45"
    //     +driver: "Stevebauman\Location\Drivers\IpApi"
    //     +countryName: "Egypt"
    //     +currencyCode: "EGP"
    //     +countryCode: "EG"
    //     +regionCode: "C"
    //     +regionName: "Cairo Governorate"
    //     +cityName: "Cairo"
    //     +zipCode: ""
    //     +isoCode: null
    //     +postalCode: null
    //     +latitude: "30.0588"
    //     +longitude: "31.2268"
    //     +metroCode: null
    //     +areaCode: "C"
    //     +timezone: "Africa/Cairo"
    //   }
        // dd($location);

        // $this->checkPermission('view ' . $this->module, $title);

        // if (!auth()->user()->can('view ' . $this->module)) {
        //     session()->put('message', ['type' => 'alert-danger', 'messages' => [__('auth.message.no_permissions') . $title]]);
        //     return back();
        // }

        _active_menu([$this->namespace, 'add-new-'._modulelowerSingularName($this->namespace)]);

        return view(_moduleName($this->namespace).'::panel.pages.create' , ['namespace' => $this->namespace] , compact(['title']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'flag' => 'required',
            'direction' => 'required',
        ], [], [
            'code' => __('code'),
            'flag' => __('flag'),
            'direction' => __('direction'),
        ]);

        if ($validator->fails()) {
            session()->put('error', ['message' => _trans($this->namespace,'something went wrong')]);
            goto End;
        }

        if(in_array($request->code, explode(',', _settings('language', 'available_locales')))){
            session()->put('error', ['message' => _trans($this->namespace, 'found')]);
            goto End;
        }

        $language = new Language;
        $language->code = Str::lower($request->code);
        $language->flag = $request->flag;
        $language->direction = $request->direction;
        $language->status = isset($request->status)? $request->status : 3;
        $language->created_by = Auth::user()->id;
        $language->arrangement = Language::max('arrangement') + 1;
        $language->save();

        $allLanguages = _get_languages();
        $trans = _get_all_languages($request->code);
        foreach ($allLanguages as $key => $lang) {
            Translations::create([
                'key' => $lang['id'],
                'value' => $trans[$key],
                'lang' => $request->code,
                'module' => 'languages',
                'created_by' => Auth::user()->id
            ]);
        }

        // add language to languages dropdown menu
        $newAvailableLocales = _settings('language', 'available_locales'). ((!in_array($request->code, explode(',', _settings('language', 'available_locales'))))? ','.$request->code : '');
        Setting::where([
            'module' => 'language', 'setting' => 'available_locales'
            ])->update([
                'value' => $newAvailableLocales
            ]);

        $arrLanguages = explode(',', $newAvailableLocales);
        foreach($arrLanguages as $co){
            $trans = _get_all_languages($co);
            Translations::create([
                'key' => $language->id,
                'value' => $trans[$request->code],
                'lang' => $co,
                'module' => 'languages',
                'created_by' => Auth::user()->id
            ]);
        }

        // create folder to lang value
        $path = _RD().'system/resources/lang/'.$request->code;
        if(!File::exists($path)) {
            mkdir($path, 0777, true);
            session()->put('success', ['message' => _trans($this->namespace,'language added')]);

            goto End;
        }

        End:
        _forget_cache('languages');
        return back();
    }

    public function edit($languageId)
    {
        $language = Language::find($languageId);
        $title = _trans($this->namespace, 'edit');

        $this->checkPermission('edit ' . Str::singular($this->module), $title);

        if ($this->checkIfLanguageFound($language)) {
            return back();
        }

        $data = (new LanguageResource(
            Language::where('id', $language->id)->with(['translations' => function($query) {
                $query->CurrentAndDefaultLanguage();
            }])
            ->first()
        ))->resolve();

        $status = StatusResource::collection(
            Status::with('statusTrans')->whereIn('id', [2, 3])->get()
        )->resolve();

        // $country_flags = CountryResource::collection(
        //     Country::with(['translations' => function($query) {
        //         $query->CurrentAndDefaultLanguage();
        //     }])
        //     ->allStatus()
        //     ->get()
        // )->resolve();

        $langPath = 'lang/' . ((File::exists(resource_path('lang/'.$data['code'])))? $data['code'] : _default_lang()) ;

        // if (File::exists(resource_path($langPath))) {
        // }
        $translate_files = $this->getTranslationFiles($langPath);

        _active_menu([$this->module]);
        _forget_cache('languages');

        return view(_moduleName($this->namespace).'::edit',
        ['namespace' => $this->namespace,'module' => $this->module],
        compact(['title', 'data', 'country_flags', 'translate_files', 'status']));
    }

    public function update(Request $request, $id)
    {
        _forget_cache('languages');
        dd($request->all());
    }

    public function delete(Request $request)
    {
        $language = Language::find($request->id);

        if ($this->checkIfLanguageFound($language)) {
            goto End;
        }

        if ($this->checkIfLanguageInUse($language)) {
            goto End;
        }

        if (Language::where('id', $request->id)->delete()) {
            session()->put('alert', ['type' => 'alert-success', 'dismissible' => 'alert-dismissible', 'message' => _trans($this->namespace, 'deleted_success_message')]);
            // _forget_cache('panel-all-languages-'.auth()->user()->code);
            return redirect(Route('languages.index'));
        }

        session()->put('alert', ['type' => 'alert-danger', 'dismissible' => 'alert-dismissible', 'message' => _trans($this->namespace, 'deleted_error_message')]);

        End:
        _forget_cache('languages');
        return back();
    }

    public function restore($id)
    {
        _forget_cache('languages');
        //
    }

    public function destroy(Request $request)
    {
        //
    }

    public function changeStatus($status, $languageId)
    {
        $this->checkPermission('edit ' . $this->module, __('control_panel.' . $this->module . '.edit'));

        $language = Language::find($languageId);
        if ($this->checkIfNotInStatus($status)) {
            goto End;
        }

        if ($this->checkIfLanguageFound($language)) {
            goto End;
        }

        if ($this->checkIfLanguageInUse($language)) {
            goto End;
        }

        if (!$language->update(['status' => $status])) {
            session()->put('message', ['type' => 'alert-danger', 'messages' => [_trans($this->namespace, 'change_status_error_message')]]);
            goto End;
        }

        session()->put('message', ['type' => 'alert-success', 'messages' => [_trans($this->namespace, 'change_status_success_message')]]);

        End:
        _forget_cache('languages');
        return back();
    }

    public function Translations()
    {
        $this->module = 'translations';
        $title = _trans($this->namespace, $this->module);

        // if(!$this->checkPermission('view ' . $this->module, $title))
        //     return redirect(Route('panel'));

        _active_menu([$this->namespace, $this->module]);
        return view(_moduleName($this->namespace).'::panel.pages.'.$this->module.'.index' , ['namespace' => $this->namespace] , compact(['title']));
    }

    public function updateTranslationsString(Language $language, Request $request)
    {
        $languageCode = $language->code;
        foreach ($request->trans as $K => $trans) {
            $file = fopen(resource_path('lang/' . $languageCode . '/' . $K . '.php'), 'w');
            fwrite($file, $trans);
            fclose($file);
        }

        _forget_cache('languages');
        return back();
    }

    protected function getTranslationFiles($langPath)
    {
        $translate_files = [];
        foreach (File::allFiles(resource_path($langPath)) as $path) {
            $file = pathinfo($path);
            $file_name = $file['filename'];
            if (!in_array($file_name, ['installer_messages', 'datatable', 'system'])) {
                $translate_files[][$file_name] = File::getRequire(resource_path($langPath . '/' . $file_name . '.php'));
            }
        }

        return $translate_files;
    }

    public function checkIfNotInStatus($state)
    {
        if (!in_array($state, [2, 3])) {
            session()->put('message', ['type' => 'alert-danger', 'messages' => [_trans($this->namespace, 'status_error_message')]]);
            return true;
        }

        return false;
    }

    public function checkIfLanguageFound($language)
    {
        if (empty($language)) {
            session()->put('message', ['type' => 'alert-danger', 'messages' => [_trans($this->namespace, 'no_language_error_message')]]);
            return true;
        }

        return false;
    }

    public function checkIfLanguageInUse($language)
    {
        if (in_array($language->code, [_current_Language(), _default_lang()])) {
            session()->put('message', ['type' => 'alert-danger', 'messages' => [_trans($this->namespace, 'language_in_use_message'), _trans($this->namespace, 'language_in_use_message')]]);
            return true;
        }

        return false;
    }

    /**
     * return datatable languages ajax
     */
    public function getAllAjax()
    {
        if(request()->ajax()){
            $cacheName = _get_cache_name('languages');
            return cache()->remember($cacheName, _settings('general', 'cache_remember_time'), function(){
                $query = Language::
                // with(['translations' => function($query) {
                //     $query->CurrentAndDefaultLanguage();
                // }])->with(['allTransStatus' => function($query) {
                //     $query->CurrentAndDefaultLanguage();
                // }])
                // ->when(function($query) {
                //     $admin = Admin::where('id', Auth::user()->id)->first();
                //     if($admin->hasAnyPermission(['restore language', 'trash language'])){
                //         return $query->withTrashed();
                //     }
                // })
                orderBy('arrangement')
                ->with('statusTrans')
                ->get();

                $data = LanguageResource::collection($query)->resolve();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('select', function () {
                        return '';
                    })
                    ->addColumn('flag', function ($row) {
                        return url('assets/global/flags/' . $row['flag'] . '.png');
                    })
                    ->addColumn('code', function ($row) {
                        $cu = ($row['code'] == _current_Language()) ? '<span class="d-block font-weight-normal opacity-50" style="font-size: 10px;">'.__('index.current').'</span>' : '';
                        $depanel = ($row['code'] == _default_lang('panel')) ? '<span class="d-block font-weight-normal opacity-50" style="font-size: 10px;">'.__('index.default panel').'</span>' : '';
                        $defront = ($row['code'] == _default_lang('front')) ? '<span class="d-block font-weight-normal opacity-50" style="font-size: 10px;">'.__('index.default front').'</span>' : '';
                        return $row['code'] . $cu . $depanel . $defront;
                    })
                    ->addColumn('status', function ($row) {
                        $status = '<span class="badge badge-' . $row['status']['color'] . '">' . $row['status']['name'] . '</span> ';
                        $status .= ($row['actions']['deletedAt'] != null)? '<span class="badge badge-flat border-danger text-danger">'.__('index.was deleted').'</span>':'';
                        $status .=  ($row['actions']['lastUpdatedBy'] != null)? '<span class="badge badge-flat border-warning text-warning ml-1">'.__('index.last action by').' '.$row['actions']['lastUpdatedBy'].'</span>':'';

                        return $status;
                    })
                    ->addColumn('action', function ($row){
                        $action = '
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">';
                            $action .=  '<a href="#" class="dropdown-item text-capitalize"><i class="icon-pencil7"></i> ' . __('index.edit') . '</a>';
                            $action .=  '<a data-id="' . $row['id'] . '" id="deleteBtn" class="dropdown-item text-capitalize" data-toggle="modal" data-target="#deletemodal"><i class="icon-trash-alt"></i> ' . __('index.delete') . '</a>';
                            if($row['actions']['deletedAt'] != null){
                                $action .=  '<a data-id="' . $row['id'] . '" id="restoreBtn" class="dropdown-item text-capitalize" data-toggle="modal" data-target="#restoremodal"><i class="icon-spinner11"></i> ' . __('index.restore') . '</a>';
                                $action .=  '<a data-id="' . $row['id'] . '" id="distroyBtn" class="dropdown-item text-capitalize" data-toggle="modal" data-target="#distroymodal"><i class="icon-blocked"></i> ' . __('index.distroy') . '</a>';
                            }
                            $action .=  '</div>
                                </div>
                            </div>';

                            return $action;
                    })
                    ->addColumn('group', function () {
                        return '';
                    })
                    ->rawColumns(['select', 'flag', 'code', 'status', 'action', 'group'])
                    ->make(true);
            });
        }else{
            abort(404);
        }
    }
}
