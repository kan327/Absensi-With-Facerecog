<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('layouts.main', [
            "title"=>"absensi",
        ]);
    }
}
