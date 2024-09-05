<?php

namespace Module\Admins\Http\Controllers\Web\Auth;

use Carbon\Carbon;
use Module\Admins\Models\Admin;
use Illuminate\Http\Request;
use Module\Admins\Http\Mail\AdminResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ResetPasswordController extends Controller implements ShouldQueue
{
    protected string $namespace;
    protected string $module;

    public function __construct() {
        $this->namespace = basename(dirname(__DIR__, 4));
        $this->module = 'auth';
    }

    public function forgetPassword(): View
    {
        $title = _trans($this->namespace, 'auth.forgot_password');

        return view(_moduleName($this->namespace).'::' . $this->module.'.pages.password_forget' , ['namespace' => $this->namespace, 'module' => $this->module] , compact(['title']));
    }

    public function recoverPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            session()->put('alert', ['type' => 'alert-danger', 'dismissible' => 'alert-dismissible', 'message' => $validator->errors()->all()]);
            Goto End;
        }

        $admin = Admin::where('email', $request->email)->first();

        if(! empty($admin)){
            if(! in_array($admin->status, [2])){
                session()->put('alert', ['type' => 'alert-danger', 'dismissible' => 'alert-dismissible', 'message' =>  _trans($this->namespace, 'auth.email.failed_mail_sent')]);
                Goto End;
            }

            // generate password reset token
            $token = app('auth.password.broker')->createToken($admin);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            $mail = Mail::later(now()->addSeconds(_settings('mail', 'queue_delay')), new AdminResetPassword(['data' => $admin, 'namespace' => $this->namespace, 'token' => $token]));

            session()->put('alert', ['type' => 'alert-success', 'dismissible' => 'alert-dismissible', 'message' => _trans($this->namespace, 'auth.message.reset_mail_sent')]);
            return redirect(route('admins.login'));
        }

        session()->put('alert', ['type' => 'alert-danger', 'dismissible' => 'alert-dismissible', 'message' =>  _trans($this->namespace, 'auth.message.email-notfound')]);

        End:
        return back();
    }

    public function resetPassword(Request $request)
    {
        if(!$request->has('token') && $request->token == null)
            return redirect(route('admins.login'));

        try {
            $check_token = $this->getLastResetToken($request->token);

            if(! empty($check_token)){
                $title = _trans($this->namespace, 'auth.message.set_password');
                $email = $check_token->email;
                $token = $request->token;
                return view(_moduleName($this->namespace).'::' . $this->module.'.pages.password_reset' , ['namespace' => $this->namespace, 'module' => $this->module] , compact(['title', 'token', 'email']));
            }else{
                session()->put('alert', ['type' => 'alert-danger', 'dismissible' => 'alert-dismissible', 'message' =>  _trans($this->namespace, 'auth.message.session_reset_password_expired')]);
                return redirect(route('admins.forgetPassword'));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function setNewPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ], [], [
            'email' => __('auth.email.email'),
            'password' => __('auth.password.password'),
            'password_confirmation' => __('auth.password.confirmation_password'),
        ]);

        if($this->sameOldPassword($request->email, $request->password)){
            session()->put('error', ['type' => 'alert-danger', 'dismissible' => 'alert-dismissible', 'message' => __('auth.password.same_password')]);
            return back();
        }

        $check_token = DB::table('password_resets')
            ->where('token', $request->token)
            ->where('created_at', '>', Carbon::now()->subHours(2))->first();

        if(! empty($check_token)){
            if(Admin::where('email', $check_token->email)
                ->update(['password' => Hash::make($request->password)])){
                DB::table('password_resets')->where('email', $request->email)->delete();
                return redirect(route('admins.login'));
            }
        }

        session()->put('alert', ['type' => 'alert-danger', 'dismissible' => 'alert-dismissible', 'message' => __('auth.password.session_reset_password_expired')]);
        return redirect(route('forgetPassword-admin'));
    }

    protected function sameOldPassword($email, $password) : bool
    {
        if(Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], false)){
            Auth::logout();
            return true;
        }else{
            return false;
        }
    }

    public function checkIfEmailExistAjax(Request $request)
    {
        if(request()->ajax()){
            // check if request has email and email is not null
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->all(),
                ]);
            }

            $admin = Admin::where('email', $request->email)->first();
            if($admin){
                return response()->json([
                    'status' => true,
                    'message' => '',
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => _trans($this->namespace, 'auth.message.email-notfound'),
                ]);
            }
        }else{
            abort(404);
        }

    }

    public function checkIfOldPasswordAjax(Request $request)
    {
        if(request()->ajax()){
            // check if request has password and password is not null
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->all(),
                ]);
            }

            $admin = Admin::where('email', $request->email)->first();
            if($admin){
                if(Hash::check($request->password, $admin->password)){
                    return response()->json([
                        'status' => false,
                        'message' => _trans($this->namespace, 'auth.message.same_password'),
                    ]);
                }else{
                    return response()->json([
                        'status' => true,
                        'message' => '',
                    ]);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'message' => _trans($this->namespace, 'auth.message.email-notfound'),
                ]);
            }
        }else{
            abort(404);
        }

    }

    public function getLastResetToken($token)
    {
        try {
            $exist = [];
            $requestedToken = DB::table('password_resets')->where('token', $token)->first();
            if(!$requestedToken)
                return $exist;

            $exist = DB::table('password_resets')
                ->where('email', $requestedToken->email)
                ->where('created_at', '>', Carbon::now()->subMinutes(_settings('settings', 'expiration_reset_password')))
                ->latest('created_at')->first();

                if($exist != null)
                    return ($exist->token == $token) ? $exist : [] ;

                return $exist;

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
