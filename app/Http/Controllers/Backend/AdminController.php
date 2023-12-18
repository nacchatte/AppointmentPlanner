<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('Backend.dashboard');
    }

    public function appview()
    {
        return view('Backend.app-view');
    }

    public function appadd()
    {
        return view('Backend.app-add');
    }

    public function custview()
    {
        return view('Backend.cust-view');
    }

    public function custadd()
    {
        return view('Backend.cust-add');
    }

    public function staffview()
    {
        return view('Backend.staff-view');
    }

    public function staffadd()
    {
        return view('Backend.staff-add');
    }
}
