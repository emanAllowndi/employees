<?php

namespace App\Http\Controllers\Admin;
use App\Model\user;
use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminAuthenticated extends Controller {

	public function login_page() {
		return view('admin.login', ['title' => trans('admin.login_page')]);
	}

	public function login_post() {

		$rememberme = request('rememberme') == 1?true:false;
		if (auth()->guard('admin')->attempt(['email' => request('email'), 'password' =>request('password')], $rememberme)) {
            session_start();
            if($_POST['year']==""){
                session()->put('year',date('Y'));
            }
            else{
		    session()->put('year',$_POST['year']);}
            //dd(session()->get('year'));

            return redirect(aurl(''));
		} else {
			session()->flash('error', trans('admin.error_loggedin'));
			return redirect(aurl('login'));
		}
	}

	public function logout() {
		admin()->logout();
		return redirect(aurl(''));
	}

	public function reset_password_change($token) {
		$this->validate(request(),
			[
				'password'              => 'required|min:6|confirmed',
				'password_confirmation' => 'required',
				'email'                 => 'required|email',
			], [], [
				'password'              => trans('admin.password'),
				'password_confirmation' => trans('admin.password_confirmation'),
			]);
		$token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();

		if (!empty($token)) {
			$admin = user::where('email', $token->email)->update(['password' => bcrypt(request('password'))]);
			session()->flash('success', trans('admin.password_is_changed'));
			if (request()->has('andlogin')) {
				auth()->guard('admin')->attempt(['email' => $token->email, 'password' => request('password')]);
				return redirect(aurl('/'));
			}
			DB::table('password_resets')->where('token', $token)->delete();
			return redirect(aurl('login'));
		} else {
			session()->flash('error', trans('admin.time_token_ended'));
			return redirect(aurl('login'));
		}
	}

	public function reset_password_final($token) {
		$token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHours(2))->first();

		empty($token)?session()->flash('error', trans('admin.time_token_ended')):'';

		return !empty($token)?view('admin.reset_password', ['token' => $token]):
		redirect(aurl('login'));

	}
	public function reset_password() {
		$user = user::where('email', request('email'))->first();
		if (!empty($user)) {
			$token = app('auth.password.broker')->createToken($user);
			$data  = DB::table('password_resets')->insert([
					'email'      => request('email'),
					'token'      => $token,
					'created_at' => Carbon::now(),
				]);
			$sendmail = Mail::to(request('email'))->send(new AdminResetPassword([
						'url'  => aurl('password/reset/'.$token),
						'data' => $user,
					]));
			session()->flash('success', trans('admin.reset_link_sent'));
			return redirect(aurl('login'));
		} else {
			session()->flash('error', trans('admin.email_not_found'));
			return redirect(aurl('login'));
		}
	}

	public function account() {
		return view('admin.account', ['title' => trans('admin.account')]);
	}

	public function account_post() {

		$rules = [
			'first_name'                  => '',
            'middel_name'                  => '',
            'last_name'                  => '',
			'email'                 => 'required|email|unique:admins,email,'.admin()->user()->id,
			'password'              => 'sometimes|nullable|confirmed',
			'password_confirmation' => '',
			'photo_profile'         => 'sometimes|nullable|'.it()->image(),
		];
		$data = $this->validate(request(), $rules, [], [
				'first_name'                  => trans('admin.first_name'),
            'middel_name'                  => trans('admin.middel_name'),
            'last_name'                  => trans('admin.last_name'),


            'email'                 => trans('admin.email'),
				'password'              => trans('admin.password'),
				'password_confirmation' => '',
			]);
		///// Check the Already Password ///////
//		if (!empty(request('password')) && \Hash::check(request('password'), admin()->user()->password)) {
//			session()->flash('error', trans('admin.the_password_is_old'));
//			return back();
//		}
//		///// Check the Already Password ///////
//		unset($data['password_confirmation']);
		if (!empty(request('password'))) {
			$data['password'] = bcrypt(request('password'));
		} else {
			unset($data['password']);
		}
		if (request()->hasFile('photo_profile')) {

			it()->delete(auth()->guard('admin')->user()->photo_profile);
			$data['photo_profile'] =  it()->upload('photo_profile','users');
		}
		admin()->user()->update($data);
		session()->flash('success', !empty(request('password'))?trans('admin.updated_account_and_password'):trans('admin.updated'));
		return back();
	}

}
