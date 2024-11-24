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
        $question_details = Question::where('question_id', $question)->first();

        $validated = $request->validate([
            'answer' => 'required|exists:r_answer,answer_id'
        ]);

        DB::beginTransaction();

        try {
            $selectedAnswer = Answer::find($validated['answer']);

            if($selectedAnswer->question_id != $question){
                $error = ValidationException::withMessages([
                    'system_error' => ['System error!' . ('Jawaban Tidak Tersedia Pada Pertanyaan')],
                ]);
                throw $error;
            }

            $existingAnswer = PeopleAnswer::where('user_id', Auth::id())->where('question_id', $question)
            ->first();

            if($existingAnswer){
                $error = ValidationException::withMessages([
                    'system_error' => ['System error!' . ('Jawaban Tidak Tersedia Pada Pertanyaan')],
                ]);
                throw $error;
            }

            $answerValue = $selectedAnswer->is_correct ? 'correct' : 'wrong';

            PeopleAnswer::create([
                'user_id' => Auth::id(),
                'question_id' => $question,
                'answer' => $answerValue,
            ]);
            
            DB::commit();

            $nextQuestion = Question::where('course_id', $course->course_id)
            ->where('question_id', '>', $question)
            ->orderBy('question_id', 'asc')
            ->first();

            if($nextQuestion){
                return redirect()->route('dashboard.learning.course', ['course' => $course->course_id, 'question' => $nextQuestion->question_id]);
            }
            else{
                // return redirect()->route('dashboard.learning.finished.course', $course->course_id);
                return redirect()->route('dashboard.learning.index')->with('success', 'All answers have been submitted.');
            }

        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    public function storeessay(Request $request, Courses $course, $question)
    {
        // Ambil detail pertanyaan
        $question_details = Question::where('question_id', $question)->first();

        // Validasi data yang diterima
        $validated = $request->validate([
            'answer' => 'required|string'  // pastikan answer berupa string untuk soal essay
        ]);

        DB::beginTransaction();

        try {
            // Simpan jawaban essay ke dalam PeopleAnswer
            $answerValue = $validated['answer'];

            // Cek apakah sudah ada jawaban untuk pertanyaan ini oleh user
            $existingAnswer = PeopleAnswer::where('user_id', Auth::id())
                ->where('question_id', $question)
                ->first();

            if ($existingAnswer) {
                // Jika sudah ada jawaban sebelumnya, throw error
                $error = ValidationException::withMessages([
                    'system_error' => ['Jawaban untuk pertanyaan ini sudah disubmit sebelumnya.']
                ]);
                throw $error;
            }

            // Tentukan apakah jawaban benar atau salah
            $isCorrect = $this->checkEssayAnswer($question_details, $answerValue);

            // Masukkan jawaban dan status ke tabel PeopleAnswer
            PeopleAnswer::create([
                'user_id' => Auth::id(),
                'question_id' => $question,
                'answer' => $isCorrect ? 'correct' : 'wrong',  // Menyimpan status benar atau salah
            ]);
            
            DB::commit();

            // Cari pertanyaan berikutnya untuk ditampilkan
            $nextQuestion = Question::where('course_id', $course->course_id)
                ->where('question_id', '>', $question)
                ->orderBy('question_id', 'asc')
                ->first();

            if ($nextQuestion) {
                // Arahkan ke pertanyaan berikutnya
                return redirect()->route('dashboard.learning.course', [
                    'course' => $course->course_id, 
                    'question' => $nextQuestion->question_id
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
