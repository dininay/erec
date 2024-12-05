<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Courses;
use App\Models\PeopleAnswer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PeopleAnswerController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Courses $course, $question)
    {
        //
        // $question_details = Question::where('question_id', $question)->first();

        $validated = $request->validate([
            'answer' => 'required|exists:r_answer,answer_id'
        ]);

        DB::beginTransaction();

        try {
            $answerValue = $validated['answer'];

            $existingAnswer = PeopleAnswer::where('user_id', Auth::id())
            ->where('question_id', $question)
            ->first();

            if ($existingAnswer) {
                // Update jika jawaban berbeda
                if ($existingAnswer->answer != $answerValue) {
                    $existingAnswer->update([
                        'answer' => $answerValue,
                    ]);
                }
            } else {
                // Buat jawaban baru
                $selectedAnswer = Answer::find($answerValue);
    
                if ($selectedAnswer->question_id != $question) {
                    throw ValidationException::withMessages([
                        'system_error' => ['Jawaban tidak sesuai dengan pertanyaan yang dipilih.'],
                    ]);
                }
    
                PeopleAnswer::create([
                    'user_id' => Auth::id(),
                    'question_id' => $question,
                    'answer' => $selectedAnswer->is_correct ? 'correct' : 'wrong',
                ]);
            }

            $nextQuestion = Question::where('course_id', $course->course_id)
            ->where('question_id', '>', $question)
            ->orderBy('question_id', 'asc')
            ->first();

            if (!$nextQuestion) {
                DB::commit();
    
                session()->flash('lastQuestion', true);

                return redirect()->route('dashboard.learning.course', [
                    'course' => $course->course_id,
                    'question' => $question
                ]);
            }

            $prevQuestion = Question::where('course_id', $course->course_id)
                ->where('question_id', '<', $question)
                ->orderBy('question_id', 'desc')
                ->first();
            
            DB::commit();

            if ($request->has('next')) {
                return redirect()->route('dashboard.learning.course', [
                    'course' => $course->course_id,
                    'question' => $nextQuestion ? $nextQuestion->question_id : $question,
                ]);
            }
    
            if ($request->has('previous')) {
                return redirect()->route('dashboard.learning.course', [
                    'course' => $course->course_id,
                    'question' => $prevQuestion ? $prevQuestion->question_id : $question,
                ]);
            }
    
            // Default redirect to the course dashboard
            return redirect()->route('dashboard.learning.index')
                ->with('success', 'All answers have been submitted.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error: ' . $e->getMessage()]);
        }
    }

        public function storeessay(Request $request, Courses $course, $question)
        {
            $question_details = Question::where('question_id', $question)->first();

            $validated = $request->validate([
                'answer' => 'required|string'  
            ]);

            DB::beginTransaction();

            try {
                $answerValue = $validated['answer'];

                $existingAnswer = PeopleAnswer::where('user_id', Auth::id())
                ->where('question_id', $question)
                ->first();

                if ($existingAnswer) {
                    if ($existingAnswer->answer != $answerValue) {
                        PeopleAnswer::where('user_id', Auth::id())
                        ->where('question_id', $question)
                        ->update([
                            'answer' => $answerValue,
                        ]);
                    }
                } else {
                    PeopleAnswer::create([
                        'user_id' => Auth::id(),
                        'question_id' => $question,
                        'answer' => $answerValue,
                    ]);
                }

            $nextQuestion = Question::where('course_id', $course->course_id)
            ->where('question_id', '>', $question)
            ->orderBy('question_id', 'asc')
            ->first();

            if (!$nextQuestion) {
                DB::commit();
    
                session()->flash('lastQuestion', true);

                return redirect()->route('dashboard.learning.course', [
                    'course' => $course->course_id,
                    'question' => $question
                ]);
            }

            $prevQuestion = Question::where('course_id', $course->course_id)
                ->where('question_id', '<', $question)
                ->orderBy('question_id', 'desc')
                ->first();
                
            DB::commit();

            if ($nextQuestion) {
                return redirect()->route('dashboard.learning.course', [
                    'course' => $course->course_id,
                    'question' => $nextQuestion->question_id,
                ]);
            } elseif ($prevQuestion) {
                return redirect()->route('dashboard.learning.course', [
                    'course' => $course->course_id,
                    'question' => $prevQuestion->question_id,
                ]);
            } else {
                // Semua jawaban sudah disubmit, arahkan ke halaman selesai
                return redirect()->route('dashboard.learning.index')->with('success', 'All answers have been submitted.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Cek apakah jawaban essay benar atau salah.
     * Anda bisa menyesuaikan logika ini berdasarkan bagaimana jawaban dikoreksi untuk soal essay.
     *
     * @param Question $question
     * @param string $answer
     * @return bool
     */
    private function checkEssayAnswer(Question $question, $answer)
    {
        $correctAnswer = $question->correct_answer;  

        return stripos($answer, $correctAnswer) !== false; 
    }

    /**
     * Display the specified resource.
     */
    public function show(PeopleAnswer $peopleAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PeopleAnswer $peopleAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PeopleAnswer $peopleAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PeopleAnswer $peopleAnswer)
    {
        //
    }
}
