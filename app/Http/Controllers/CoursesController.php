<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Courses;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $courses = Courses::orderBy('course_id', 'DESC')->get();
        return view('admin.course.index', [
            'courses'=> $courses,
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
        $categories = Category::all();
        return view('admin.course.create', [
            'categories' => $categories,
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
            'course_name' => 'required|string|max:255',
            'course_time' => 'required|string|max:255',
            'cat_id' => 'required|string|max:255',
            'cover' => 'required|image|mimes:png,jpg,svg',
            // 'course_type' => 'required|string|max:255',
            'access_type' => 'required|string|max:255',
            // 'publish_date' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            if($request->hasFile('cover')){
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                $validated['cover'] = $coverPath;
            }
            $validated['slug'] = Str::slug($request->course_name);
            $newCourse = Courses::create($validated);

            DB::commit();

            return redirect()->route('dashboard.course.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Courses $course)
    {
        //
        $user = Auth::user();
        $people = $course->people()->orderBy('id', 'DESC')->get();
        $questions = $course->questions()->orderBy('question_id', 'DESC')->get();

        return view('admin.course.manage', [
            'course'=> $course,
            'people'=> $people,
            'questions'=> $questions,
            'user'=> $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courses $course)
    {
        //
        $user = Auth::user();
        $categories = Category::all();
        return view('admin.course.edit', [
            'course'=> $course,
            'user'=> $user,
            'categories'=> $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Courses $course)
    {
        //
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_time' => 'required|string|max:255',
            'cat_id' => 'required|string|max:255',
            'cover' => 'sometimes|image|mimes:png,jpg,svg',
            // 'course_type' => 'required|string|max:255',
            'access_type' => 'required|string|max:255',
            // 'publish_date' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            if($request->hasFile('cover')){
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                $validated['cover'] = $coverPath;
            }
            $validated['slug'] = Str::slug($request->course_name);
            $course->update($validated);

            DB::commit();

            return redirect()->route('dashboard.course.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courses $course)
    {
        //
        try{
            $course->delete();
            return redirect()->route('dashboard.course.index');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
}
