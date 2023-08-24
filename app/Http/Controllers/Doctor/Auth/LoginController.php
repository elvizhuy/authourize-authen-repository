<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
class LoginController extends Controller
{
    public function login()
    {
        if (Auth::guard('doctor')->check()){
            echo 'success';
            $doctorInfo = Auth::guard('doctor')->user();
            dd($doctorInfo);
        }
        return view('doctors.auth.login');
    }

    public function postLogin(Request $request)
    {
        $data = $request->except("_token");

        if (isActiveDoctor($data['email'])) {
            $checkLogin = Auth::guard('doctor')->attempt($data);
            if ($checkLogin){
               return redirect(RouteServiceProvider::DOCTOR);
            }
            return back()->with('msg','email or password invalid');
        }
        return back()->with('msg','account inactive');
    }
}
