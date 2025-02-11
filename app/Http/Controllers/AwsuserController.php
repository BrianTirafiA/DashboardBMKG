<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AwsuserController extends Controller
{
    public function index()
    {
        return view('awsqcuser.dashboard');
    }
}
