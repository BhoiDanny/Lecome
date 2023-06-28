<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.index');
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function adminLogin()
    {
        return view('admin.login');
    }

    public function adminProfile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    public function adminProfileUpdate(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'.$user->id,
            'phone' => 'required|max:255',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        if($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = date('Y_m_d_Hi').'_'.$photo->getClientOriginalName();
            if($user->photo != null) {
                Storage::disk('upload')->delete('admin_images/'.$user->photo);
            }
            Storage::disk('upload')->putFileAs('admin_images', $photo, $photoName);

            $validated['photo'] = $photoName;
        }

        $user->update($validated);
        return redirect()->back()->with('success', 'Profile updated successfully');


    }
}
