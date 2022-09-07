<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //Redirects to User Login page
    public function redirectToUserLoginPage(){
        return view('main.loginuser');
    }

    //Redirects to Doctor Login page
    public function redirectToDoctorLoginPage(){
        return view('main.logindoctor');
    }

    //Redirects to Upload QRCode Page
    public function redirectToUploadQRCodePage(){
        return view('main.upload');
    }

    public function redirectToIndexPage(){
        return view('main.index');
    }
}