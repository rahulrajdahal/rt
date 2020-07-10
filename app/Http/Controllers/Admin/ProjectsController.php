<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Projectyear;
use App\Models\Event;
use Storage;
use Session;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('project_date', 'desc')->paginate(10);
        return view('admin.projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        $galleryID = Str::uuid();
        $categories = Category::orderBy('name')->get();
        $years = Projectyear::orderBy('year')->get();

        return view('admin.projects.create')
            ->with('galleryID', $galleryID)
            ->with('categories', $categories)
            ->with('years', $years);
    }

    public function store(Request $request, $uuid)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'date|nullable',
            'location' => 'string|nullable',
            'category' => 'nullable',
            'project-year' => 'nullable',
            'event' => 'nullable',
            'news' => 'required',
            'event-photo' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:10000',
            'event-location' => 'nullable',
            'event-start-date' => 'nullable',
            'event-end-date' => 'nullable',
            'event-start-time' => 'nullable',
            'event-end-time' => 'nullable',
            'event-entry-fee' => 'nullable',
            'featured' => 'required|mimes:jpeg,jpg,png,gif,svg|max:10000',
            'blog' => 'required',
        ]);

        $name = $request->name;
        $project_date = $request->date;
        $location = $request->location;
        $category = $request->category;
        $project_year = $request['project-year'];
        $event = $request->event == 'yes' ? true : false;
        $news = $request->news == 'true' ? true : false;
        $event_location = $request['event-location'];
        $event_start_date = $request['event-start-date'];
        $event_end_date = $request['event-end-date'];
        $event_start_time = $request['event-start-time'];
        $event_end_time = $request['event-end-time'];
        $event_entry_fee = $request['event-entry-fee'];
        $featured = $request->featured;
        $blog = $request->blog;
        $event_photo = $request['event-photo'];

        $upload_path = 'public/uploads';

        \DB::beginTransaction();
        try {
            $file = $featured->store($upload_path);
            $file_path = $file_path = str_replace('public/uploads', 'uploads', Storage::url($file));
            $project = Project::create([
                'name' => $name,
                'project_date' => $project_date,
                'location' => $location,
                'event' => $event,
                'news' => $news,
                'featured' => $file_path,
                'body' => $blog,
                'hidden' => false,
                'category_id' => $category,
                'projectyear_id' => $project_year,
                'uuid' => $uuid,
            ]);
            if ($event) {
                $event_photo_file = $event_photo->store($upload_path);
                $event_photo_path = str_replace('public/uploads', 'uploads', Storage::url($event_photo_file));
                $project->events()->create([
                    'photo' => $event_photo_path,
                    'location' => $event_location,
                    'start_date' => $event_start_date,
                    'end_date' => $event_end_date,
                    'start_time' => $event_start_time,
                    'end_time' => $event_end_time,
                    'entry_fee' => $event_entry_fee,
                ]);
            }
            if ($news) {
                $news_photo_file = $featured->store($upload_path);
                $news_photo_path = str_replace('public/uploads', 'uploads', Storage::url($news_photo_file));

                $project->news()->create([
                    'featured' => $news_photo_path,
                    'name' => $name,
                    'project_date' => $project_date,
                    'location' => $location,
                    'body' => $blog,
                    'hidden' => false,
                    'uuid' => $uuid,
                ]);
            }
            \DB::commit();
            Session::flash('success', 'Project Saved!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function edit(Project $project)
    {
        $galleryID = $project->uuid;
        $categories = Category::orderBy('name')->get();
        $years = Projectyear::orderBy('year')->get();

        return view('admin.projects.edit')
            ->with('project', $project)
            ->with('galleryID', $galleryID)
            ->with('categories', $categories)
            ->with('years', $years);
    }

    public function update(Request $request, Project $project)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'date|nullable',
            'location' => 'string|nullable',
            'category' => 'nullable',
            'project-year' => 'nullable',
            'news' => 'required',
            'event' => 'nullable',
            'event-photo' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:10000',
            'event-location' => 'nullable',
            'event-start-date' => 'nullable',
            'event-end-date' => 'nullable',
            'event-start-time' => 'nullable',
            'event-end-time' => 'nullable',
            'event-entry-fee' => 'nullable',
            'featured' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:10000',
            'blog' => 'required',
        ]);

        $name = $request->name;
        $project_date = $request->date;
        $location = $request->location;
        $category = $request->category;
        $project_year = $request['project-year'];
        $news = $request->news == 'true' ? true : false;
        $event = $request->event == 'yes' ? true : false;
        $event_location = $request['event-location'];
        $event_start_date = $request['event-start-date'];
        $event_end_date = $request['event-end-date'];
        $event_start_time = $request['event-start-time'];
        $event_end_time = $request['event-end-time'];
        $event_entry_fee = $request['event-entry-fee'];
        $featured = $request->featured;
        $blog = $request->blog;
        $event_photo = $request['event-photo'];

        $upload_path = 'public/uploads';

        \DB::beginTransaction();
        try {
            $file_path = $project->featured;
            if ($featured != null) {
                $file = $featured->store($upload_path);
                $file_path = str_replace('public/uploads', 'uploads', Storage::url($file));
            }
            $project->update([
                'name' => $name,
                'project_date' => $project_date,
                'location' => $location,
                'news' => $news,
                'event' => $event,
                'featured' => $file_path,
                'body' => $blog,
                'hidden' => false,
                'category_id' => $category,
                'projectyear_id' => $project_year,
            ]);
            if ($event) {
                $event = $project->events;
                if ($event == null) {
                    $event_photo_file = $event_photo->store($upload_path);
                    $event_photo_path = str_replace('public/uploads', 'uploads', Storage::url($event_photo_file));
                    Event::create([
                        'photo' => $event_photo_path,
                        'project_id' => $project->id,
                        'location' => $event_location,
                        'start_date' => $event_start_date,
                        'end_date' => $event_end_date,
                        'start_time' => $event_start_time,
                        'end_time' => $event_end_time,
                        'entry_fee' => $event_entry_fee,
                    ]);
                } else {
                    if ($event_photo != null) {
                        $event_photo_file = $event_photo->store($upload_path);
                        $event_photo_path = str_replace('public/uploads', 'uploads', Storage::url($event_photo_file));
                    } else {
                        $event_photo_path = $project->events->photo;
                    }
                    $project->events()->update([
                        'photo' => $event_photo_path,
                        'location' => $event_location,
                        'start_date' => $event_start_date,
                        'end_date' => $event_end_date,
                        'start_time' => $event_start_time,
                        'end_time' => $event_end_time,
                        'entry_fee' => $event_entry_fee,
                    ]);
                }
            }

            if ($news) {
                $new = $project->news;
                if ($new == null) {
                    $new_photo_file = $featured->store($upload_path);
                    $new_photo_path = str_replace('public/uploads', 'uploads', Storage::url($new_photo_file));
                    NewsMedia::create([
                        'featured' => $new_photo_path,
                        'name' => $name,
                        'project_id' => $project->id,
                        'location' => $location,
                        'body' => $blog,
                        'hidden' => false,
                    ]);
                } else {
                    if ($featured != null) {
                        $new_photo_file = $featured->store($upload_path);
                        $new_photo_path = str_replace('public/uploads', 'uploads', Storage::url($new_photo_file));
                    } else {
                        $new_photo_path = $project->featured;
                    }
                    $project->news()->update([
                        'featured' => $new_photo_path,
                        'name' => $name,
                        'location' => $location,
                        'body' => $blog,
                        'hidden' => false,
                    ]);
                }
            }

            $project->save();
            \DB::commit();
            Session::flash('success', 'Project Saved!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function hide(Project $project)
    {
        \DB::beginTransaction();
        try {
            $project->hidden = true;
            $project->save();
            \DB::commit();
            Session::flash('success', 'Project Saved!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function unhide(Project $project)
    {
        \DB::beginTransaction();
        try {
            $project->hidden = false;
            $project->save();
            \DB::commit();
            Session::flash('success', 'Project Saved!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }
}
