<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function siteSettings(){
        return view('admin.siteSetting.index');
    }

    public function siteSettingStore(Request $request){
        $request->validate([
            'site_title' => 'nullable|string',
            'site_color' => 'nullable|string',
            'form_price' => 'nullable|numeric',
            'site_description' => 'nullable|string',
            'google_analytics_code' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'about' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:10000',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:10000',
        ]);

        $site = new SiteSetting();

        if ($request->hasFile('site_logo')) {
            $thumb = $request->file('site_logo');
            $extension = $thumb->getClientOriginalExtension();
            $profilePhoto = time() . "." . $extension;
            $thumb->move('site/', $profilePhoto);
            $site->site_logo = 'site/' . $profilePhoto;
        }

        if ($request->hasFile('site_favicon')) {
            $thumb = $request->file('site_favicon');
            $extension = $thumb->getClientOriginalExtension();
            $profilePhoto = time() . "." . $extension;
            $thumb->move('site/', $profilePhoto);
            $site->site_favicon = 'site/' . $profilePhoto;
        }

        $site->site_title = $request->site_title;
        $site->site_color = $request->site_color;
        $site->site_description = $request->site_description;
        $site->form_price = $request->form_price;
        $site->phone = $request->phone;
        $site->email = $request->email;
        $site->address = $request->address;
        $site->about = $request->about;
        $site->google_analytics_code = $request->google_analytics_code;
        $site->save();

        $notification = [
            'message' => 'Site Settings Created!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);

    }
}
