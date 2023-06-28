<?php

namespace App\Http\Controllers;

class VendorController extends Controller
{
    public function vendorDashboard()
    {
        return view('vendor.dashboard');
    }
}
