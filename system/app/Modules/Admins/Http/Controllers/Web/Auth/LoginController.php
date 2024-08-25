<?php

namespace Admins\Http\Controllers\Web\Auth;

use Admins\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Admins\Http\Mail\AdminLoginNotification;
use Illuminate\View\View;

class LoginController extends Controller
{
    protected string $namespace;
    protected string $module;

    public function __construct() {
        $this->namespace = basename(dirname(__DIR__, 4));
        $this->module = 'auth';
    }

    public function login(): View
    {
        $title = _trans($this->namespace, 'auth.signin');

        return view(_moduleName($this->namespace).'::' . $this->module.'.pages.login' , ['namespace' => $this->namespace, 'module' => $this->module] , compact(['title']));
    }

    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            session()->put('alert', ['type' => 'alert-danger', 'dismissible' => 'alert-dismissible', 'message' => $validator->errors()->all()]);
            goto End;
        }

        if (!$this->checkAdminrecord('email', $request->login)) {
            session()->put('alert', ['type' => 'alert-danger', 'dismissible' => 'alert-dismissible', 'message' => _trans($this->namespace, 'auth.message.email-notfound')]);
            goto End;
        }

        $remember = $request->remember == null ? false : true;

        if (Auth::guard('admin')->attempt(['email' => $request->login, 'password' => $request->password], $remember)) {
            if ($request->has('redirect')) {
                return redirect(url($request->redirect));
            }

            if($request->type == 'login'){
                Mail::to($request->login)->send(
                    new AdminLoginNotification(Auth::guard('admin')->user(), $this->namespace)
                );
            }

            return redirect(route('admin.panel'));
        } else {
            session()->put('alert', ['type' => 'alert-danger', 'dismissible' => 'alert-dismissible', 'message' => _trans($this->namespace, 'auth.message.failed')]);
        }

        End:
        return redirect(route('admin.login'));
    }

    public function lockAccount(Request $request): View
    {
        $title = _trans($this->namespace, 'auth.unlock');
        $userName = auth()->user()->name;
        $userEmail = auth()->user()->email;
        $profile = auth()->user()->profile_pic;
        $redirect= Str::replace(url('/').'/', '', url()->previous());

        $this->logout($request);

        return view(_moduleName($this->namespace).'::' . $this->module.'.pages.unlock',
            ['namespace' => $this->namespace, 'module' => $this->module],
            compact(['title', 'userName', 'userEmail', 'profile', 'redirect'])
        );
    }

    public function unlock(Request $request)
    {
        $this->signin($request);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        // $request->session()->invalidate();
        $request->session()->regenerateToken();

        // session()->put('locale', $locale, _settings('general', 'cache_remember_time'));

        return response(redirect(route('admin.login')));
    }

    public static function checkAdminrecord($field, $value): bool
    {
        try {
            return Admin::where($field, $value)->notinactive()->first() ? true : false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
