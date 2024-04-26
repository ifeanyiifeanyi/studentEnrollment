<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageAdminController extends Controller
{
    public function index()
    {
        $admins = User::with('admin')->where('role', 'admin')->get();
        // dd($admins);
        return view('admin.manageAdmin.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.manageAdmin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'other_names' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'other_names' => $request->other_names,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'nameSlug' => $request->first_name. ''. $request->last_name,
            'email_verified_at' => now(),
        ]);
        $adminData = [
            'user_id' => $user->id,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    
        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $filename = time() . '.' . $photoFile->getClientOriginalExtension();
            $photoFile->move(public_path('admin/profile'), $filename);
            $adminData['photo'] = 'admin/profile/' . $filename;
        }


        Admin::create($adminData);
        $notification = [
            'message' => 'New Administrator Created!',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.manage.admin')->with($notification);
    }
    public function edit($slug){
        $admin = User::where('nameSlug', $slug)->first();
        return view('admin.manageAdmin.edit', compact('admin'));
    }

    public function update(){
        dd("here ..");
    }
}
