<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function tambah_guru_view()
    {
        return view("layouts.mainAdmin", [
            "title" => "tambah_guru"
        ]);
    }
}
