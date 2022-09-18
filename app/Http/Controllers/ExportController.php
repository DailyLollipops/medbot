<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    // Export CSV Data
    public function export(Request $request){
        dd($request->all());
    }
}
