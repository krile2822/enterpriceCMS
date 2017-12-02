<?php

namespace CMS\admin\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use CMS\admin\EmailVerification;
use CMS\admin\User;

class AuthController extends Controller
{
    use AuthenticatesUsers;

     public function login() {
        $confirmation_code = null;
        return view('admin::admin.login', compact(['confirmation_code']));
     }

    public function postLogin(Request $request) {
        // Login, validate the credentials
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request['email'];
        $password = $request['password'];

        $user = User::where('email', $email)->first();

        if ($user) {
          // email-on keresztul jott az oldalra, vagy nem
            if ($request['code'] != null) {
              if (auth()->attempt(['email' => $email, 'password' => $password])) {
                  $user->confirmed = 1;
                  $user->confirmation_code = null;
                  $user->save();
                  return redirect()->route('dashboard');
              } else {
                  return back()->withErrors(['message' => 'Wrong username or password']);
              }
            } else {
              if ($user->confirmed == 0){
                  return back()->withErrors(['message' => 'First login must to be via email']);
              }
              if (auth()->attempt(['email' => $email, 'password' => $password])) {
                return redirect()->route('dashboard');
              } else {
                return back()->withErrors(['message' => 'Wrong username or password']);
              }
            }
        }

        return back()->withErrors(['message' => 'Wrong username or password']);
    }

    public function destroy() {
        // Logout the user
        auth()->logout();
        return redirect()->route('login');
    }

    public function getRegister() {
        // Load the register blade
        return view('admin::admin.register');
    }

    public function store(Request $request) {
        // Create new user and store in DB (password hash, email sending)
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);

        $confirmation_code = str_random(30);

        $user = User::create([
           'name' => $request['username'],
           'email' => $request['email'],
           'confirmation_code' => $confirmation_code,
           'password' => bcrypt($request['password'])

        ]);

        \Mail::to($user)->send(new EmailVerification($user, $confirmation_code));

        return redirect()->back();
    }

    public function confirm($confirmation_code)
    {
        // confirmation
        if( ! $confirmation_code)
        {
            return "No confirmation code";
        }

        $user = User::where('confirmation_code', $confirmation_code)->first();

        if ( ! $user)
        {
           return "This user is not registrated!";
        }

        // Must replace at login function
        // $user->confirmed = 1;
        // $user->confirmation_code = null;
        // $user->save();

        //return redirect()->route('login')->with($confirmation_code);
        return view('admin::admin.login', compact(['confirmation_code']));
    }

    public function passChange(Request $request) {
        // Change the current password
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = auth()->user();

        if (! $user) {
            return redirect()->back();
        }
        $password = $user->password;
        if (! \Hash::check($request['old_password'], $password)) {
            return back()->with([
                'message' => 'Old password is wrong'
            ]);
        }
       $new_pass = bcrypt($request['password']);
       $user->update(['password' => $new_pass]);

       return back()->with([
           'message' => 'Password changed successfully!'
       ]);
    }

    public function usernameChange(Request $request) {
        // Change the current username
        $this->validate($request, [
            'new_username' => 'required'
        ]);

        $new_username = $request['new_username'];
        $user = auth()->user();

        if (! $user) {
            return redirect()->back();
        }

        $user->update(['name' => $new_username]);

        return back()->with(['message' => 'Username changed successfully!']);
    }

    /*
     * Preempts $redirectTo member variable (from RedirectsUsers trait)
     */
    public function redirectTo()
    {
        return route('dashboard');
    }
}
