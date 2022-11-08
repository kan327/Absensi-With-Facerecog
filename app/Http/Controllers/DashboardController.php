<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("layouts.main", [
            "title"=>"dashboard"
        ]);
    }

    public function index_admin()
    {
        return view('layouts.mainAdmin', [
            "title"=>"dashboard"
        ]);
    }
}
