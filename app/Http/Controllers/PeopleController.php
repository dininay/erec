<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Courses;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(People $people)
    {
        //
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
