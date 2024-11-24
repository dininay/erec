<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\QuestionEssay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionEssayController extends Controller
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
    public function storeessay(Request $request, Courses $course, QuestionEssay $question)
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
    public function show(QuestionEssay $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuestionEssay $questionessay)
    {
        //
        $user = Auth::user();
        $people = $questionessay->people()->orderBy('id', 'DESC')->get();
        $course = Courses::with('category')->find($questionessay->course_id);
        return view('admin.question.editessay', [ 
            'questionessay' => $questionessay,
            'course' => $course,
            'people' => $people,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuestionEssay $questionessay)
    {
        //
        $validated = $request->validate([
            'question_name' => 'required|string|max:255',
            'answer_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $questionessay->update([
                'question_name' => $request->question_name,
            ]);

            $questionessay->answers()->delete();
            $questionessay->answers()->create([
                'answer_name' => $request->answer_name,
                'is_correct' => $request->answer_name,
                'question_id' => $questionessay->question_id
            ]);
    
            DB::commit();

            return redirect()->route('dashboard.course.show', $questionessay->course_id);
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionEssay $questionessay)
    {
        //
        try{
            $questionessay->delete();
            return redirect()->route('dashboard.course.show', $questionessay->course_id);
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
}
