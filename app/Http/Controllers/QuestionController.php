<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Courses $course)
    {
        //
        $user = Auth::user();
        $people = $course->people()->orderBy('id', 'DESC')->get();
        return view('admin.question.create', [
            'course' => $course,
            'people' => $people,
            'user' => $user,
        ]);
    }

    public function createessay(Courses $course)
    {
        //
        $user = Auth::user();
        $people = $course->people()->orderBy('id', 'DESC')->get();
        return view('admin.question.createessay', [
            'course' => $course,
            'people' => $people,
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Courses $course, Question $question)
    {
        //
        $validated = $request->validate([
            'question_name' => 'required|string|max:255',
            'answer_name' => 'required|array',
            'answer_name.*' => 'required|string|max:255',
            'correct_answer.*' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $question = $course->questions()->create([
                'question_name' => $request->question_name,
            ]);
            $course->questions()->save($question);

            foreach($request->answer_name as $index => $answerText){
                $isCorrect = ($request->correct_answer == $index);
                $question->answers()->create([
                    'answer_name' => $answerText,
                    'is_correct' => $isCorrect,
                    'question_id' => $question->question_id
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.course.show', $course->course_id);
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
    
    public function storeessay(Request $request, Courses $course, Question $question)
    {
        //
        $validated = $request->validate([
            'question_name' => 'required|string|max:255',
            'answer_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $question = $course->questions()->create([
                'question_name' => $request->question_name,
            ]);
            $course->questions()->save($question);

            $question->answers()->create([
                'answer_name' => $request->answer_name,
                'is_correct' => $request->answer_name,
                'question_id' => $question->question_id
            ]);
    
            DB::commit();

            return redirect()->route('dashboard.course.show', $course->course_id);
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
        $user = Auth::user();
        $people = $question->people()->orderBy('id', 'DESC')->get();
        $course = $question->course;
        return view('admin.question.edit', [ 
            'question' => $question,
            'course' => $course,
            'people' => $people,
            'user' => $user,
        ]);
    }
    
    public function editessay(Question $question)
    {
        //
        $user = Auth::user();
        $people = $question->people()->orderBy('id', 'DESC')->get();
        $course = $question->course;
        return view('admin.question.editessay', [ 
            'question' => $question,
            'course' => $course,
            'people' => $people,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
        $validated = $request->validate([
            'question_name' => 'required|string|max:255',
            'answer_name' => 'required|array',
            'answer_name.*' => 'required|string|max:255',
            'correct_answer.*' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $question->update([
                'question_name' => $request->question_name,
            ]);

            $question->answers()->delete();

            foreach($request->answer_name as $index=> $answerText){
                $isCorrect = ($request->correct_answer == $index);
                $question->answers()->create([
                    'answer_name' => $answerText,
                    'is_correct' => $isCorrect,
                    'question_id' => $question->question_id
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.course.show', $question->course_id);
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
        // $validated = $request->validate([
        //     'question_name' => 'required|string|max:255',
        //     'answer_name' => 'required|array',
        //     'answer_name.*' => 'required|string|max:255',
        //     'correct_answer.*' => 'required|string|max:255',
        // ]);

        // DB::beginTransaction();

        // try{
        //     $question = $course->questions()->update([
        //         'question_name' => $request->question_name,
        //     ])

        //     $questions = $question->answers()->delete();

        //     foreach($request->answers as $index=> $answerText){
        //         $isCorrect = ($request->correct_answer == $index);
        //         $question->answers()->create([
        //             'answer_name' => $answerText,
        //             'is_correct' => $isCorrect
        //         ]);
        //     }

        //     DB::commit();

        //     return redirect()->route('dashboard.course.show', $question->course_id);
        // }
        
        // catch (\Exception $e){
        //     DB::rollBack();
        //     return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        // }
    }
    
    public function updateessay(Request $request, Question $question)
    {
        //
        $validated = $request->validate([
            'question_name' => 'required|string|max:255',
            'answer_name' => 'required|array',
            'answer_name.*' => 'required|string|max:255',
            'correct_answer.*' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $question->update([
                'question_name' => $request->question_name,
            ]);

            $question->answers()->delete();

            foreach($request->answer_name as $index=> $answerText){
                $isCorrect = ($request->correct_answer == $index);
                $question->answers()->create([
                    'answer_name' => $answerText,
                    'is_correct' => $isCorrect,
                    'question_id' => $question->question_id
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard.course.show', $question->course_id);
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
        try{
            $question->delete();
            return redirect()->route('dashboard.course.show', $question->course_id);
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
    
    public function destroyessay(Question $question)
    {
        //
        try{
            $question->delete();
            return redirect()->route('dashboard.course.show', $question->course_id);
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
}
