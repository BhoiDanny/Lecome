<?php

namespace App\Http\Controllers;

class VendorController extends Controller
{
    public function adminDashboard()
    {
        return view('vendor.dashboard');
    }
}
