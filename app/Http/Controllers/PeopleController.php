<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Courses;
use App\Models\People;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $peoples = People::orderBy('people_id', 'DESC')->get();
        $courses = Courses::all();
        
        return view('admin.people.index', [
            'peoples'=> $peoples,
            'user'=> $user,
            'courses'=> $courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Courses $course)
    {
        //
        $user = Auth::user();
        $people = $course->people()->orderBy('id', 'DESC')->get();
        return view('admin.people.add_people', [
            'course' => $course,
            'user' => $user,
            'people' => $people
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Courses $course)
    {
        //
        $request->validate([
            'email' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if($user){
            $error = ValidationException::withMessages([
                'system_error' => ('Email people not found'),
            ]);
            throw $error;
        }

        $isEnrolled = $course->peoples()->where('user_id', $user->id)->exists();

        if ($isEnrolled){
            $error = ValidationException::withMessages([
                'system_error' => ('Email people not found'),
            ]);
            throw $error;
        }

        DB::beginTransaction();

        try{
            $course->people()->attach($user->id);
            
            return redirect()->route('dashboard.job.index');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(People $people)
    {
        $peoples = People::find($apply->id);
        
        $user = Auth::user();

        // Return data ke view
        return view('admin.apply.manage', [
            'peoples' => $peoples,
            'people' => $apply,
            'user' => $user,
            // 'people' => $people,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(People $people)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, People $people)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(People $people)
    {
        //
    }
}
