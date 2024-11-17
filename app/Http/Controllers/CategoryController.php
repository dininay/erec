<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $categorys = Category::orderBy('cat_id', 'DESC')->get();
        return view('admin.category.index', [
            'categorys'=> $categorys,
            'user'=> $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = Auth::user();
        return view('admin.category.create', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'cat_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->cat_name);
            $newCategory = Category::create($validated);

            DB::commit();

            return redirect()->route('dashboard.category.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        $people = $category->people()->orderBy('id', 'DESC')->get();

        return view('admin.category.manage', [
            'category'=> $category,
            'people'=> $people,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        $user = Auth::user();
        // $course = Courses::findOrFail($category);
        // $people = People::findOrFail($category);
        // $category = Category::findOrFail($category);
        // $joblevel = JobLevel::findOrFail($category);
        // $workloc = WorkLoc::findOrFail($category);
        return view('admin.category.edit', [
            'category'=> $category,
            'user'=> $user,
            // 'course'=> $course,
            // 'people'=> $people,
            // 'joblevel'=> $joblevel,
            // 'workloc'=> $workloc,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $validated = $request->validate([
            'cat_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->cat_name);
            $category->update($validated);

            DB::commit();

            return redirect()->route('dashboard.category.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        try{
            $category->delete();
            return redirect()->route('dashboard.category.index');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
}
