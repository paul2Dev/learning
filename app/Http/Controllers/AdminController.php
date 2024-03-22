<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $profile = User::find($id);

        return view('admin.profile', compact('profile'));
    }

    public function profileStore(Request $request)
    {
        $id = Auth::user()->id;
        $profile = User::find($id);
        $profile->name = $request->name;
        $profile->username = $request->username;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->address = $request->address;

        if($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$profile->photo));
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $profile->photo = $filename;
        }

        $profile->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function changePassword()
    {
        $id = Auth::user()->id;
        $profile = User::find($id);
        return view('admin.change-password', compact('profile'));
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);


        if(!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password Does Not Match!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        User::find(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
