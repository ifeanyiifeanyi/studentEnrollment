<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class ManageAdminController extends Controller
{
    public function index(){
        $admins = User::with('admin')->where('role', 'admin')->get();
        // dd($admins);
        return view('admin.manageAdmin.index', compact('admins'));
    }

    public function create(){
        return view('admin.manageAdmin.create');
    }
}
