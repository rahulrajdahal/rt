<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Session;

class SettingsController extends Controller
{
    public function index() {
        $settings = Setting::first();
        return view('admin.settings.index', ['settings' => $settings]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'logo' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:10000',
            'location' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'tag-line' => 'nullable',
            'about-us' => 'required',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'youtube' => 'nullable',
            'twitter' => 'nullable',
        ]);

        try{
            $settings = Setting::first();

            $base_path = 'public/uploads/';
            if($request->logo != null) {
                $new_file_path = $request->logo->store($base_path);
            } else {
                $new_file_path = $settings->logo ?? null;
            }
            
            if( $settings == null ) {
                Setting::create([
                    'name' => $request->name,
                    'logo' => $new_file_path,
                    'location' => $request->location,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'tagline' => $request['tag-line'],
                    'about' => $request['about-us'],
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'twitter' => $request->twitter,
                ]);
            } else {
                $settings->update([
                    'name' => $request->name,
                    'logo' => $new_file_path,
                    'location' => $request->location,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'tagline' => $request['tag-line'],
                    'about' => $request['about-us'],
                    'facebook' => $request->facebook,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'twitter' => $request->twitter,
                ]);
            }
            \DB::commit();
            Session::flash('success', 'Settings updated!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }

        return redirect()->back();
    }
}
