<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Category;
use App\Models\Courses;
use App\Models\People;
use App\Models\PeopleAnswer;
use App\Models\Question;
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
        $applys = Apply::with('people')->orderBy('apply_id', 'DESC')->get();
        $courses = Courses::all();

        foreach ($applys as $apply) {
            $peopleAnswers = PeopleAnswer::where('user_id', $apply->user_id) // Filter answers by user_id
            ->whereNull('r_people_answers.deleted_at') // Only non-deleted answers
            ->get();

            $allCorrect = $peopleAnswers->every(function ($answer) {
                return $answer->answer === 'correct'; // Check if all answers are correct
            });
            $apply->passed = $allCorrect;
            $apply->status = $allCorrect ? 'Passed' : 'Not Passed';
        }
        
        
        return view('admin.people.index', [
            'applys'=> $applys,
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
    public function show($user_id)
    {
        $user = Auth::user();
        $peoples = People::orderBy('people_id', 'DESC')->get();

        foreach ($peoples as $people) {
            $course = $people->course; // Get the course for each person
            $peopleAnswers = PeopleAnswer::with('questions')
                ->whereHas('questions', function ($query) use ($course) {
                    $query->where('course_id', $course->course_id)
                        ->whereNull('r_question.deleted_at');
                })
                ->whereNull('r_people_answers.deleted_at')
                ->get();
            
            $totalQuestions = Question::where('course_id', $course->course_id)->count();
            $correctAnswersCount = $peopleAnswers->where('answer', 'correct')->count();
            $people->passed = ($correctAnswersCount == $totalQuestions); // Add passed status to each person
        }

        $applys = Apply::where('user_id', $user_id)->orderBy('apply_id', 'DESC')->get();
        $courses = Courses::all();

        return view('admin.people.detail', [
            'applys'=> $applys,
            'peoples'=> $peoples,
            'user'=> $user,
            'courses'=> $courses,
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
