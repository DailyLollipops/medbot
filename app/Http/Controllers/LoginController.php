<?php

namespace App\Http\Controllers;

use Zxing\QrReader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private function decrypt($encrypted) {
        $password = "MedbotPRBPM";
        $decrypted=openssl_decrypt($encrypted,"AES-128-ECB",$password);
        return $decrypted;
    }

    // Authenticate for normal user account
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
                flash()->addInfo('Welcome back '.User::where('id',Auth::id())->first()->name.'!');
                return redirect()->intended('/');
            }
            else {
                flash()->addError('The provided credentials do not match our records.');
                return back();
            }
        }
        else {
            flash()->addError('Invalid QR Code');
            return back();
        }
    }

    // Authenticate for doctor type account
    public function authenticateDoctor(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            flash()->addInfo('Welcome back '.User::where('id',Auth::id())->first()->name.'!');
            return redirect()->intended('/');
        }
        flash()->addError('The provided credentials do not match our records.');
        return back()->onlyInput('email');
    }

    // Logout
    public function logout(Request $request){
        $user_id = Auth::id();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        flash()->addInfo('See you again '.User::where('id',$user_id)->first()->name.'!');
        return redirect('/');
    }
}
