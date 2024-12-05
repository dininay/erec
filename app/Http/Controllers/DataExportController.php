<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Courses;
use App\Models\PeopleAnswer;
use App\Models\Question;
use App\Models\RegistJob;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DataExportController extends Controller
{
    public function index()
    {
        //
        $user = Auth::check() ? Auth::user() : null;

        $statusapplys = RegistJob::join('r_apply', 'r_registjob.reg_code', '=', 'r_apply.reg_id')
        ->join('r_people_status', 'r_apply.apply_id', '=', 'r_people_status.apply_id')
        ->select(
            'r_apply.*',
            'r_people_status.*',
            'r_registjob.*'
        )
        ->orderBy('r_registjob.reg_id', 'DESC')
        ->get();

        $applys = $user
        ? $statusapplys->filter(fn($job) => $job->user_id === $user->id)->values()
        : collect();
        // Ambil data user terkait pekerjaan
        if ($user) {
            // Mengambil data pekerjaan yang terhubung dengan user berdasarkan email
            $jobDetails = Apply::where('email', $user->email)
                ->leftJoin('r_registjob', 'r_registjob.reg_code', '=', 'r_apply.reg_id')
                ->leftJoin('r_people_status', 'r_apply.apply_id', '=', 'r_people_status.apply_id')
                ->select(
                    'r_apply.*',
                    'r_people_status.*',
                    'r_registjob.*'
                )
                ->orderBy('r_registjob.reg_id', 'DESC')
                ->first(); // Mengambil data pekerjaan pertama yang ditemukan
        } else {
            $jobDetails = null;
        }

        foreach ($statusapplys as $statusapply) {
            $peopleAnswers = PeopleAnswer::where('user_id', $statusapply->user_id) // Filter answers by user_id
            ->whereNull('r_people_answers.deleted_at') // Only non-deleted answers
            ->get();

            $allCorrect = $peopleAnswers->every(function ($answer) {
                return $answer->answer === 'correct'; // Check if all answers are correct
            });
            $statusapply->passed = $allCorrect;
            $statusapply->status = $allCorrect ? 'Passed' : 'Not Passed';
        }

        return view('admin.report.index', [
            'statusapplys'=> $statusapplys,         
            'user'=> $user,
        ]);
    }

    public function show(Apply $apply)
    {
        $statusapplys = Apply::with('status', 'registjob')
        ->find($apply->apply_id);

        if (!$statusapplys) {
            abort(404, 'Data Apply tidak ditemukan');
        }
        
        $user = Auth::user();
        
        $peopleAnswers = PeopleAnswer::where('user_id', $statusapplys->user_id) 
            ->whereNull('r_people_answers.deleted_at') 
            ->get();

        $allCorrect = $peopleAnswers->every(function ($answer) {
                return $answer->answer === 'correct'; 
            });

        $statusapplys->passed = $allCorrect;
        $statusapplys->status = $allCorrect ? 'Passed' : 'Not Passed';

        // Return data ke view
        return view('admin.report.manage', [
            'statusapplys' => $statusapplys,
            'statusapply' => $apply,
            'user' => $user,
            // 'people' => $people,
        ]);
    }

    public function downloadExcel()
    {
        $data = Apply::all();

        foreach ($data as $apply) {
            $peopleAnswers = PeopleAnswer::where('user_id', $apply->user_id)
                ->whereNull('r_people_answers.deleted_at')
                ->get();

            $allCorrect = $peopleAnswers->every(function ($answer) {
                return $answer->answer === 'correct';
            });

            $apply->calculated_status = $allCorrect ? 'Passed' : 'Not Passed';
        }

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Nomor Telepon');
        $sheet->setCellValue('D1', 'Berat Badan');
        $sheet->setCellValue('E1', 'Tinggi Badan');
        $sheet->setCellValue('F1', 'Jenis Kelamin');
        $sheet->setCellValue('G1', 'Tempat, Tanggal Lahir');
        $sheet->setCellValue('H1', 'Usia');
        $sheet->setCellValue('I1', 'Alamat LengkapDomisili');
        $sheet->setCellValue('J1', 'NIK KTP');
        $sheet->setCellValue('K1', 'Status Pernikahan');
        $sheet->setCellValue('L1', 'Jumlah Anak');
        $sheet->setCellValue('M1', 'Riwayat Penyakit');
        $sheet->setCellValue('N1', 'Pendiidkan Terakhir');
        $sheet->setCellValue('O1', 'Nama Sekolah / Perguruan Tinggi');
        $sheet->setCellValue('P1', 'Jurusan');
        $sheet->setCellValue('Q1', 'Tahun Lulus');
        $sheet->setCellValue('R1', 'IPK / Nilai Rata-Rata');
        $sheet->setCellValue('S1', 'Applied Division');
        $sheet->setCellValue('T1', 'Applied Department');
        $sheet->setCellValue('U1', 'Applied Job Title');
        $sheet->setCellValue('V1', 'Job Expertise Level');
        $sheet->setCellValue('W1', 'Applied Work Location');
        $sheet->setCellValue('X1', 'Specified Work Area');
        $sheet->setCellValue('Y1', 'Application Date');
        $sheet->setCellValue('Z1', 'Administration Screening Status');
        $sheet->setCellValue('AA1', 'Psychotest Status');
        $sheet->setCellValue('AB1', 'Interview Status');
        $sheet->setCellValue('AC1', 'Document Clearance Status');
        $sheet->setCellValue('AD1', 'OJE Status');
        $sheet->setCellValue('AE1', 'Onboarding Status');
        $sheet->setCellValue('AF1', 'Join Date');
        $sheet->setCellValue('AG1', 'Quest 1');
        $sheet->setCellValue('AH1', 'Quest 5');
        $sheet->setCellValue('AI1', 'Experience 1');
        $sheet->setCellValue('AJ1', 'Experience 2');
        $sheet->setCellValue('AK1', 'Info Vacancy');

        $row = 2;
        foreach ($data as $apply) {
            $sheet->setCellValue('A' . $row, $apply->name);
            $sheet->setCellValue('B' . $row, $apply->email);
            $sheet->setCellValue('C' . $row, $apply->wa_aktif);
            $sheet->setCellValue('D' . $row, $apply->bb);
            $sheet->setCellValue('E' . $row, $apply->tb);
            $sheet->setCellValue('F' . $row, $apply->jk);
            $sheet->setCellValue('G' . $row, $apply->ttl);
            $sheet->setCellValue('H' . $row, $apply->age);
            $sheet->setCellValue('I' . $row, $apply->domisili);
            $sheet->setCellValue('J' . $row, $apply->nik_ktp);
            $sheet->setCellValue('K' . $row, $apply->status_nikah);
            $sheet->setCellValue('L' . $row, $apply->jml_anak);
            $sheet->setCellValue('M' . $row, $apply->riwayat_kesehatan);
            $sheet->setCellValue('N' . $row, $apply->last_pendidikan);
            $sheet->setCellValue('O' . $row, $apply->asal_sekolah);
            $sheet->setCellValue('P' . $row, $apply->jurusan);
            $sheet->setCellValue('Q' . $row, $apply->th_lulus);
            $sheet->setCellValue('R' . $row, $apply->ipk);
            $sheet->setCellValue('S' . $row, $apply->registjob->division->div_name);
            $sheet->setCellValue('T' . $row, $apply->registjob->dept->dept_name);
            $sheet->setCellValue('U' . $row, $apply->registjob->job_title);
            $sheet->setCellValue('V' . $row, $apply->registjob->job_level);
            $sheet->setCellValue('W' . $row, $apply->registjob->workloc->workloc_name);
            $sheet->setCellValue('X' . $row, $apply->registjob->specwork_id ? $apply->registjob->specwork->city : 'City not available');
            $sheet->setCellValue('Y' . $row, $apply->created_at);
            $sheet->setCellValue('Z' . $row, $apply->status->status_admin);
            $sheet->setCellValue('AA' . $row, $apply->calculated_status);
            $sheet->setCellValue('AB' . $row, $apply->status->status_interview);
            $sheet->setCellValue('AC' . $row, $apply->status->status_docclear);
            $sheet->setCellValue('AD' . $row, $apply->status->status_oje);
            $sheet->setCellValue('AE' . $row, $apply->status->status_onboarding);
            $sheet->setCellValue('AF' . $row, $apply->status->join_date);
            $sheet->setCellValue('AG' . $row, $apply->details->quest_1);
            $sheet->setCellValue('AH' . $row, $apply->details->quest_5);
            $sheet->setCellValue('AI' . $row, $apply->details->experience_1);
            $sheet->setCellValue('AJ' . $row, $apply->details->experience_2);
            $sheet->setCellValue('AK' . $row, $apply->details->info_vacancy);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'data-applicant.xlsx';

        return response()->stream(function() use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="data-applicant.xlsx"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    public function uploadExcel(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        // Mendapatkan file dan course
        $file = $request->file('file');
        $course = Courses::find(1); // Misalnya mengambil course dengan ID 1
        $cat_id = $course->cat_id;

        // Mulai transaksi
        DB::beginTransaction();

        try {
            // Proses file Excel
            $data = Excel::toArray([], $file)[0]; // Ambil hanya sheet pertama
            foreach ($data as $index => $row) {
                // Abaikan header di baris pertama (index 0)
                if ($index == 0) continue;

                $questionText = $row[0]; // Kolom A
                $answers = [$row[1], $row[2], $row[3], $row[4]]; // Kolom B-E
                $corrects = [$row[5], $row[6], $row[7], $row[8]]; // Kolom F-I

                // Simpan pertanyaan ke tabel `r_question`
                $question = Question::create([
                    'question_name' => $row['question'],
                ]);

                // Pemrosesan berdasarkan `cat_id`
                $question = Question::create([
                    'question_name' => $questionText,
                ]);

                if ($cat_id == 1) {
                    foreach ($answers as $index => $answer) {
                        DB::table('r_answer')->insert([
                            'question_id' => $question->id,
                            'answer_id' => $index + 1,
                            'answer_name' => $answer,
                            'is_correct' => $corrects[$index], // Pastikan `1` untuk benar, `0` untuk salah
                        ]);
                    }
                } elseif ($cat_id == 2) {
                    DB::table('r_answer')->insert([
                        'question_id' => $question->id,
                        'answer_id' => 1,
                        'answer_name' => $answers[0],
                        'is_correct' => $corrects[0], // Asumsi jawaban pertama adalah satu-satunya
                    ]);
                }
            }

            // Commit transaksi
            DB::commit();
            return redirect()->route('dashboard.course.index', $course->id)
                ->with('success', 'Data berhasil diupload!');
        } catch (\Exception $e) {
            // Rollback jika terjadi kesalahan
            DB::rollBack();
            return redirect()->route('dashboard.course.index', $course->id)
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function unduhExcel()
    {
        $data = Apply::all();

        // Hitung status untuk setiap apply
        foreach ($data as $apply) {
            $peopleAnswers = PeopleAnswer::where('user_id', $apply->user_id)
                ->whereNull('r_people_answers.deleted_at')
                ->get();

            $allCorrect = $peopleAnswers->every(function ($answer) {
                return $answer->answer === 'correct';
            });

            $apply->calculated_status = $allCorrect ? 'Passed' : 'Not Passed';
        }

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Phone Number');
        $sheet->setCellValue('D1', 'Applied Department');
        $sheet->setCellValue('E1', 'Applied Job Title');
        $sheet->setCellValue('F1', 'Job Expertise');
        $sheet->setCellValue('G1', 'Applied Work Location');
        $sheet->setCellValue('H1', 'Specified Work Area');
        $sheet->setCellValue('I1', 'Application Date ');
        $sheet->setCellValue('J1', 'Administration Screening Status');
        $sheet->setCellValue('K1', 'Psychotest Status');
        $sheet->setCellValue('L1', 'Interview Status');
        $sheet->setCellValue('M1', 'Document Clearance Status');
        $sheet->setCellValue('N1', 'OJE Status');
        $sheet->setCellValue('O1', 'Onboarding Status');
        $sheet->setCellValue('P1', 'Join Date');
        $sheet->setCellValue('Q1', 'Last Modified By');
        $sheet->setCellValue('R1', 'Modified date');

        $row = 2;
        foreach ($data as $apply) {
            $sheet->setCellValue('A' . $row, $apply->name);
            $sheet->setCellValue('B' . $row, $apply->email);
            $sheet->setCellValue('C' . $row, $apply->wa_aktif);
            $sheet->setCellValue('D' . $row, $apply->registjob->dept->dept_name);
            $sheet->setCellValue('E' . $row, $apply->registjob->job_title);
            $sheet->setCellValue('F' . $row, $apply->registjob->job_desc);
            $sheet->setCellValue('G' . $row, $apply->registjob->workloc->workloc_name);
            $sheet->setCellValue('H' . $row, $apply->registjob->workloc->workloc_name);
            $sheet->setCellValue('I' . $row, $apply->created_at);
            $sheet->setCellValue('J' . $row, $apply->status->status_admin);
            $sheet->setCellValue('K' . $row, $apply->calculated_status);
            $sheet->setCellValue('L' . $row, $apply->status->status_interview);
            $sheet->setCellValue('M' . $row, $apply->status->status_docclear);
            $sheet->setCellValue('N' . $row, $apply->status->status_oje);
            $sheet->setCellValue('O' . $row, $apply->status->status_onboarding);
            $sheet->setCellValue('P' . $row, $apply->status->join_date);
            $sheet->setCellValue('Q' . $row, $apply->status->modified_by);
            $sheet->setCellValue('R' . $row, $apply->status->updated_at);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'data-detail-status-applicant.xlsx';

        return response()->stream(function() use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="data-detail-status-applicant.xlsx"',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
