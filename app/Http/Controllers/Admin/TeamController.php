<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Storage;
use App\Models\Team;

class TeamController extends Controller
{
    public function index() {
        $team = Team::all();
        return view('admin.team.index', ['team' => $team]);
    }

    public function create() {
        return view('admin.team.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'photo' => 'required|mimes:jpeg,jpg,png,gif,svg|max:10000',
            'name' => 'required|string',
            'phone' => 'nullable',
            'email' => 'required|email',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'youtube' => 'nullable',
            'twitter' => 'nullable',
            'bio' => 'required',
        ]);

        $upload_path = 'public/uploads';

        \DB::beginTransaction();
        try {
            $temp_path = $request->photo->store($upload_path);
            $file_path = str_replace('public/uploads', 'uploads', Storage::url($temp_path));;
            Team::create([
                'name' => $request->name,
                'photo' => $file_path,
                'number' => $request->phone,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
                'twitter' => $request->twitter,
                'bio' => $request->bio,
            ]);
            \DB::commit();
            Session::flash('success', 'Team member added!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function edit(Team $member) {
        return view('admin.team.edit', ['member' => $member]);
    }

    public function update(Request $request, Team $member) {
        $this->validate($request, [
            'photo' => 'required|mimes:jpeg,jpg,png,gif,svg|max:10000',
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'youtube' => 'nullable',
            'twitter' => 'nullable',
            'bio' => 'required',
        ]);

        $upload_path = 'public/uploads';

        \DB::beginTransaction();
        try {
            if($request->photo != null) {
                $temp_path = $request->photo->store($upload_path);
                $file_path = str_replace('public/uploads', 'uploads', Storage::url($temp_path));
            } else {
                $file_path = $member->photo;
            }

            $member->update([
                'name' => $request->name,
                'photo' => $file_path,
                'number' => $request->phone,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube,
                'twitter' => $request->twitter,
                'bio' => $request->bio,
            ]);
            $member->save();
            \DB::commit();
            Session::flash('success', 'Updated successfully!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function hide(Team $member) {
        \DB::beginTransaction();
        try {
            $member->hidden = true;
            $member->save();
            \DB::commit();
            Session::flash('success', 'Member hidden!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function publish(Team $member) {
        \DB::beginTransaction();
        try {
            $member->hidden = false;
            $member->save();
            \DB::commit();
            Session::flash('success', 'Member published!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }
}
