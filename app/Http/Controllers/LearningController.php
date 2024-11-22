<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\People;
use App\Models\PeopleAnswer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LearningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $user = Auth::user();
        $courses = Courses::orderBy('course_id', 'DESC')->get();
        $my_course = Courses::leftjoin('r_people', 'r_people.course_id', '=', 'r_course.course_id') 
        ->leftjoin('r_apply', 'r_people.apply_id', '=', 'r_apply.apply_id') 
        ->leftjoin('users', 'r_people.user_id', '=', 'users.id') 
        ->where('r_people.user_id', '=', $user->id) 
        // ->where('r_apply.user_id', '=', $user->id) 
        // ->where('r_people.email', '=', $user->email) 
        ->select('r_course.*') 
        ->orderBy('r_course.course_id', 'DESC') 
        ->get();
    
        foreach ($my_course as $course) {
            $totalQuestionCount = $course->questions()->count();
    
            // cek pertanyaan yang sudah dijawab
            $answeredQuestionCount = PeopleAnswer::where('user_id', $user->id)
            ->whereIn('question_id', function ($query) use ($course) {
                $query->select('question_id')->from('r_question')
                    ->where('course_id', $course->course_id);
            })
            ->count();
    
                if ($answeredQuestionCount == 0) {
                    $firstUnansweredQuestion = Question::where('course_id', $course->course_id)
                        ->orderBy('question_id', 'ASC')
                        ->first();
                    $course->nextQuestionId = $firstUnansweredQuestion ? $firstUnansweredQuestion->course_id : null;
                } else {
                    // Jika sudah ada yang dijawab, cari pertanyaan yang belum dijawab
                    if ($answeredQuestionCount < $totalQuestionCount) {
                        $firstUnansweredQuestion = Question::where('course_id', $course->course_id)
                            ->whereNotIn('question_id', function ($query) use ($user) {
                                $query->select('question_id')->from('r_people_answers')
                                    ->where('user_id', $user->id);
                            })->orderBy('question_id', 'ASC')->first();
                        $course->nextQuestionId = $firstUnansweredQuestion ? $firstUnansweredQuestion->id : null;
                    } else {
                        $course->nextQuestionId = null;
                    }
                }
            }
    
        return view('crew.course.learning', [
            'courses' => $courses,
            'my_course' => $my_course,
            'user' => $user,
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = Auth::user();
        $categories = Courses::all();
        return view('admin.course.create', [
            'categories' => $categories,
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function learning(Courses $course, $question = null)
    {
        $user = Auth::user();

        $isEnrolled = DB::table('r_people')
        ->where('user_id', $user->id)
        ->where('course_id', $course->course_id)
        ->exists();

        if(!$isEnrolled){
            abort(404);
        }

        $currentQuestion = Question::where('course_id', $course->course_id)->where('question_id', $question)->firstOrFail();
        
        return view('crew.course.learning_test', [
            'course' => $course,
            'question' => $currentQuestion,
            'user' => $user,
        ]);
    }

    public function learning_rapport(Courses $course)
    {
        $user = Auth::user();

        $peopleAnswers = PeopleAnswer::with('question')
        ->whereHas('question', function ($query) use ($course){
            $query->where('course_id', $course->course_id);
        })->where('user_id', $user->id)->get();

        $totalQuestions = Question::where('course_id', $course->course_id)->count();
        
        $correctAnswersCount = $peopleAnswers->where('answer', 'correct')->count();
        $passed = $correctAnswersCount == $totalQuestions;

        return view('crew.course.learning_rapport', [
            'course' => $course,
            'user' => $user,
            'totalQuestions' => $totalQuestions,
            'correctAnswersCount' => $correctAnswersCount,
            'peopleAnswers' => $peopleAnswers,
            'passed' => $passed,
        ]);
    }

    public function learning_finished(Courses $course)
    {
        $user = Auth::user();
        return view('crew.course.learning_finished', [
            'course' => $course,
            'user' => $user,
        ]);
    }

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
        $categories = Courses::all();
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
