<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google2FA;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Svg\Tag\Rect;

class TwoFactorController extends Controller
{
    public function get2fa(){

        $user = auth()->user();

        $google2fa_url = "";

        if($user->google2fa_secret != ''){

            $google2fa = app('pragmarx.google2fa');

            $google2fa_url = $google2fa->getQRCodeInline(
                $user->name.' 2FA',
                $user->email,
                $user->google2fa_secret
            );
        }

        $data = array(
            'user' => $user,
            'google2fa_url' => $google2fa_url
        );


        return view('auth.index',compact('data'));

    }

    public function generate2faSecret(Request $request){

        $google2fa = app('pragmarx.google2fa');

        auth()->user()->update([
            'google2fa_secret' => $google2fa->generateSecretKey(),
        ]);

        return back()->with('added','Secret Key is generated, Please verify Code to Enable 2FA!');
    }

    public function valid2FA(Request $request){


        $google2fa = app('pragmarx.google2fa');

        $user = auth()->user();

        if($google2fa->verifyKey($user->google2fa_secret, $request->one_time_password)){

            auth()->user()->update([
                'google2fa_enable' => '1'
            ]);

            Cookie::queue('two_fa',1);
         
            return back()->with('added','2FA is enabled on your account !');

        }else{
            
            
            return back()->with('deleted','Secret Key is invalid, Please verify Code again to Enable 2FA!');
        }

    }

    public function disable2FA(Request $request){

        $request->validate([
            'password' => 'required'
        ]);

        if(Hash::check($request->password,auth()->user()->password)){

            auth()->user()->update([
                'google2fa_enable' => '0',
                'google2fa_secret' => NULL
            ]);

            
            return back()->with('added','2FA is disabled in your account !');

        }else{
            return back()->withErrors(['password' => 'Invalid password !']);
        }

    }

    public function login(Request $request){

        $google2fa = app('pragmarx.google2fa');

        $user = auth()->user();

        if($google2fa->verifyKey($user->google2fa_secret, $request->password)){

            Cookie::queue('two_fa',1);

            return redirect()->intended('/');

        }else{
            return back()->withErrors(['password' => 'Invalid pin !']);
        }

    }
}
