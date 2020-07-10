<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Session;

class CategoriesController extends Controller
{
    public function index() {
        $categories = Category::orderBy('name')->paginate(10);
        return view('admin.categories.index', ['categories' => $categories]);    
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:5',
        ]);
        
        \DB::beginTransaction();
        try {
            Category::create([
                'name' => $request->name,
            ]);
            \DB::commit();
            Session::flash('success', 'Category added successfully!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    public function edit(Category $category) {
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category) {
        $this->validate($request, [
            'name' => 'required',
        ]);
        \DB::beginTransaction();
        try {
            $category->name = $request->name;
            $category->save();
            \DB::commit();
            Session::flash('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }
}
