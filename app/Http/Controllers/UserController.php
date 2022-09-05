<?php

namespace App\Http\Controllers;

require $_SERVER['DOCUMENT_ROOT'] . "\medbot\\vendor\autoload.php";

use Zxing\QrReader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private function encrypt($decrypted) {
        $password = "MedbotPRBPM";
        $encrypted=openssl_encrypt($decrypted,"AES-128-ECB",$password);
        return $encrypted;
    }

    private function decrypt($encrypted) {
        $password = "MedbotPRBPM";
        $decrypted=openssl_decrypt($encrypted,"AES-128-ECB",$password);
        return $decrypted;
    }

    public function authenticateUser(Request $request) {

        $qrdata = $request->validate([
            'qrcode' => ['required']
        ],
        [
            'qrcode.required' => 'Please select a QR Code'
        ]);
        $qrcode = new QrReader($request->file('qrcode'));

        $qrdata = $qrcode->text();
        $decrypted = $this->decrypt($qrdata);

        if(str_contains($decrypted,'Medbot')) {
            $temp = explode(':',$decrypted);

            $credentials = ([
                'id' => $temp[1],
                'password' => $temp[2],
            ]);

            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
 
                $userID = Auth::id();
    
                return redirect()->intended('/');
            }
            else {
                return back()->withErrors([
                    'qrcode' => 'The provided credentials do not match our records.',
                ]);
            }
        }
        else {
            return back()->withErrors([
                'qrcode' => 'Invalid QR Code',
            ]);
        }
    }

    public function authenticateDoctor(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            $userID = Auth::id();

            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function redirect() {
        if(Auth::check()) {
            if(Auth::user()->type == 'doctor') {
                return view('user.doctor');
            }
            else {
                return view('user.normal');
            }
        }
        else {
            return view('main.index');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
