<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function general_error()
    {
        return view('alerts.general_error');
    }
}
