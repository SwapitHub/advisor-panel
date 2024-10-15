<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\SiteInfo;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        // if (Auth::guard('admin')->check()) {
        //     return redirect()->route('admin.dashboard');
        // }
        $data['info'] = SiteInfo::first();
        return view('login',$data);
    }

    public function authenticate(Request $request) {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'The Email field is required.',
            'password.required' => 'The Password field is required.',
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))) {
            session()->flash('success','Login successfull');
            return redirect()->route('index');
        } else {
            session()->flash('error','Try again, invalid login credentials');
            return back()->withInput($request->only('email'));
        }

    }

    public function logout() {
        Auth::guard('web')->logout();
        $isLoggedOut = !Auth::guard('web')->check();

        if ($isLoggedOut) {
            session()->flash('success','You are successfully logout');
            return redirect()->route('index');
        } else {
            session()->flash('error','Someting went wrong, try again');
            return redirect()->route('index');
        };
    }
}
