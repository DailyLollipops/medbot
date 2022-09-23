<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    // Redirects to About page
    public function redirectToAboutPage(){
        return view('main.about');
    }
    // Redirects to User Login page
    public function redirectToUserLoginPage(){
        return view('main.loginuser');
    }

    // Redirects to Doctor Login page
    public function redirectToDoctorLoginPage(){
        return view('main.logindoctor');
    }

    // Redirects to Upload QRCode Page
    public function redirectToUploadQRCodePage(){
        return view('main.upload');
    }

    // Redirect to Index Page
    public function redirect() {
        if(Auth::check()) {
            if(Auth::user()->type == 'doctor') {
                return redirect('/dashboard/doctor');
            }
            else {
                return redirect('/dashboard/user');
            }
        }
        else {
            return view('main.index');
        }
    }
}