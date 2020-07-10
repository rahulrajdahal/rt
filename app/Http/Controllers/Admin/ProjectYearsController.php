<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projectyear;
use Session;

class ProjectYearsController extends Controller
{
    public function index() {
        $projectYears = Projectyear::orderBy('year')->paginate(10);
        return view('admin.project-year.index', ['projectYears' => $projectYears]);
    }

    public function create() {
        return view('admin.project-year.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'year' => 'required|unique:projectyears|digits:4'
        ]);

        \DB::beginTransaction();
        try {
            Projectyear::create([
                'year' => $request->year,
            ]);
            \DB::commit();
            Session::flash('success', 'Project year added successfully!');
        } catch (Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function edit(Projectyear $year) {
        return view('admin.project-year.edit', ['year' => $year]);
    }

    public function update(Request $request, Projectyear $year) {
        $this->validate($request, [
            'year' => 'required|unique:projectyears|digits:4'
        ]);

        \DB::beginTransaction();
        try {
            $year->year = $request->year;
            $year->save();
            \DB::commit();
            Session::flash('success', 'Project year updated successfully!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function hide(Projectyear $year) {
        \DB::beginTransaction();
        try {
            $year->hidden = true;
            $year->save();
            \DB::commit();
            Session::flash('success', 'Project year hidden successfully!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function publish(Projectyear $year) {
        \DB::beginTransaction();
        try {
            $year->hidden = false;
            $year->save();
            \DB::commit();
            Session::flash('success', 'Project year published successfully!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }
}
