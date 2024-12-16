<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //this methode will show dashboard page for customer
    public function index(){
        return view('dashboard');
    }
}
