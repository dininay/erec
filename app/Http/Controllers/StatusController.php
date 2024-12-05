<?php

namespace App\Http\Controllers;

use App\Models\Status; // sesuaikan dengan model yang digunakan
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatusController extends Controller
{
    public function indexadmin()
    {
        $user = Auth::user();
        $statuss = Status::whereIn('status_admin', ['In Process', 'Passed', 'Not Passed', 'Not Passed'])->orderBy('people_status_id', 'DESC')->get();
        return view('admin.approval.administration.index', [
            'statuss'=> $statuss,
            'user'=> $user,
        ]);
    }
    
    public function indexinterview()
    {
        $user = Auth::user();
        $statuss = Status::whereIn('status_admin', ['Passed'])->orderBy('people_status_id', 'DESC')->get();

        $completedUsers = [];

        foreach ($statuss as $status) {
            $userId = $status->user_id;
    
            // Ambil semua course_id dari r_people berdasarkan user_id
            $courseIds = DB::table('r_people')
                ->where('user_id', $userId)
                ->pluck('course_id');
    
            // Asumsikan user telah menyelesaikan semua course
            $allCoursesCompleted = true;
    
            foreach ($courseIds as $courseId) {
                // Ambil semua question_id berdasarkan course_id dari tabel r_question
                $questionIds = DB::table('r_question')
                    ->where('course_id', $courseId)
                    ->pluck('question_id');
    
                // Ambil semua question_id yang dijawab user pada course ini
                $answeredQuestionIds = DB::table('r_people_answers')
                    ->where('user_id', $userId)
                    ->pluck('question_id');
    
                // Cek apakah semua question_id dalam course sudah dijawab
                if ($questionIds->diff($answeredQuestionIds)->isNotEmpty()) {
                    $allCoursesCompleted = false;
                    break;
                }
            }
    
            // Jika semua course selesai, tambahkan user_id ke daftar completedUsers
            if ($allCoursesCompleted) {
                $completedUsers[] = $userId;
            }
        }

        // Ambil data user yang telah menyelesaikan semua course
        $users = DB::table('r_people_status')
            ->whereIn('user_id', $completedUsers)
            ->get();

        return view('admin.approval.interview.index', [
            'statuss'=> $statuss,
            'user'=> $user,
            'users'=> $users,
        ]);
    }
    
    public function indexdocclear()
    {
        $user = Auth::user();
        $statuss = Status::whereIn('status_docclear', ['In Process', 'Passed', 'Not Passed'])->orderBy('people_status_id', 'DESC')->get();
        return view('admin.approval.docclear.index', [
            'statuss'=> $statuss,
            'user'=> $user,
        ]);
    }
    
    public function indexoje()
    {
        $user = Auth::user();
        $statuss = Status::whereIn('status_oje', ['In Process', 'Passed', 'Not Passed'])->orderBy('people_status_id', 'DESC')->get();
        return view('admin.approval.oje.index', [
            'statuss'=> $statuss,
            'user'=> $user,
        ]);
    }
    
    public function indexonboarding()
    {
        $user = Auth::user();
        $statuss = Status::whereIn('status_onboarding', ['In Process', 'Passed', 'Not Passed'])->orderBy('people_status_id', 'DESC')->get();
        return view('admin.approval.onboarding.index', [
            'statuss'=> $statuss,
            'user'=> $user,
        ]);
    }

    public function create($type)
    {
        return view('dashboard.approval.' . $type . '.create');
    }

    public function store(Request $request, $type)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'name' => 'required',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Simpan data berdasarkan tipe
        Status::create([
            'name' => $request->input('name'),
            'type' => $type, // Menyimpan tipe untuk memastikan data sesuai dengan resource
            // tambahkan field lainnya sesuai kebutuhan
        ]);

        return redirect()->route('dashboard.approval.' . $type . '.index');
    }

    public function show($type, $id)
    {
        $data = Status::where('type', $type)->findOrFail($id);
        return view('dashboard.approval.' . $type . '.show', compact('data'));
    }

    public function edit($type, $id)
    {
        $data = Status::where('type', $type)->findOrFail($id);
        return view('dashboard.approval.' . $type . '.edit', compact('data'));
    }

    public function update(Request $request, $type, $id)
    {
        $data = Status::where('type', $type)->findOrFail($id);

        // Validasi dan perbarui data
        $validated = $request->validate([
            'name' => 'required',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $data->update([
            'name' => $request->input('name'),
            'type' => $type, // Menyimpan tipe untuk memastikan data sesuai dengan resource
            // tambahkan field lainnya sesuai kebutuhan
        ]);

        return redirect()->route('dashboard.approval.' . $type . '.index');
    }

    public function editadmin(Status $people_status_id)
    {
        $user = Auth::user();
        return view('admin.approval.administration.edit', [
            'user' => $user,
            'status' => $people_status_id
        ]);
    }

    public function editinterview(Status $people_status_id)
    {
        $user = Auth::user();
        return view('admin.approval.interview.edit', [
            'user' => $user,
            'status' => $people_status_id
        ]);
    }

    public function editdocclear(Status $people_status_id)
    {
        $user = Auth::user();
        return view('admin.approval.docclear.edit', [
            'user' => $user,
            'status' => $people_status_id
        ]);
    }

    public function editoje(Status $people_status_id)
    {
        $user = Auth::user();
        return view('admin.approval.oje.edit', [
            'user' => $user,
            'status' => $people_status_id
        ]);
    }

    public function editonboarding(Status $people_status_id)
    {
        $user = Auth::user();
        return view('admin.approval.onboarding.edit', [
            'user' => $user,
            'status' => $people_status_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateadmin(Request $request, Status $people_status_id)
    {
        //
        $validated = $request->validate([
            'status_admin' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['reg_name'] = Str::slug($request->status_admin);
            $people_status_id->update($validated);
            $people_status_id->update([
                'admin_date' => Carbon::now()->toDateString(), 
            ]);

            $user_id = $people_status_id->user_id;
            $apply_id = $people_status_id->apply_id;
            // $people_id = $people_status_id->people_status_id;

            $reg_code = DB::table('r_apply')
            ->where('apply_id', $apply_id)
            ->value('reg_id');

            $jobtype_id = DB::table('r_registjob')
            ->where('reg_code', $reg_code)
            ->value('type_id');

            if (in_array($jobtype_id, [1, 2])) {
                $courses = DB::table('r_course')
                    ->where('course_type', $jobtype_id)
                    ->get(['course_id']);

                if ($courses->isEmpty()) {
                    throw new \Exception("No courses found with course_type = $jobtype_id");
                }
                $last_people_id = DB::table('r_people')
                ->max('people_id') ?? 0;
                foreach ($courses as $course) {
                    $last_people_id++; 
                    DB::table('r_people')->insert([
                        'people_id' => $last_people_id,
                        'user_id' => $user_id,
                        'apply_id' => $apply_id,
                        'course_id' => $course->course_id,
                    ]);
                }
            }

            $people_id = $people_status_id->people_status_id;
            DB::table('r_test')->insert([
                'test_id' => $people_id,
                'reg_code' => $reg_code,
                'apply_id' => $apply_id,
            ]);
            
            $people_status_id->update([
                'test_id' => $people_id, 
            ]);

            DB::commit();

            return redirect()->route('dashboard.approval.administration.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    public function updateinterview(Request $request, Status $people_status_id)
    {
        //
        $validated = $request->validate([
            'status_interview' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['reg_name'] = Str::slug($request->status_interview);
            $people_status_id->update($validated);
            $people_status_id->update([
                'interview_date' => Carbon::now()->toDateString(), 
                'status_docclear' => 'In Process',
            ]);

            DB::commit();

            return redirect()->route('dashboard.approval.interview.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
    
    public function updatedocclear(Request $request, Status $people_status_id)
    {
        //
        $validated = $request->validate([
            'status_docclear' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['reg_name'] = Str::slug($request->status_docclear);
            $people_status_id->update($validated);
            $people_status_id->update([
                'docclear_date' => Carbon::now()->toDateString(), 
                'status_oje' => 'In Process',
            ]);

            DB::commit();

            return redirect()->route('dashboard.approval.docclear.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
    
    public function updateoje(Request $request, Status $people_status_id)
    {
        //
        $validated = $request->validate([
            'status_oje' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['reg_name'] = Str::slug($request->status_oje);
            $people_status_id->update($validated);
            $people_status_id->update([
                'oje_date' => Carbon::now()->toDateString(), 
                'status_onboarding' => 'In Process',
            ]);

            DB::commit();

            return redirect()->route('dashboard.approval.oje.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
    
    public function updateonboarding(Request $request, Status $people_status_id)
    {
        //
        $validated = $request->validate([
            'status_onboarding' => 'required|string|max:255',
            'join_date' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $people_status_id->update([
                'onboarding_date' => Carbon::now()->toDateString(), 
                'join_date' => $request->join_date,
                'status_onboarding' => $request->status_onboarding,
            ]);

            DB::commit();

            return redirect()->route('dashboard.approval.interview.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    public function destroy($type, $id)
    {
        $data = Status::where('type', $type)->findOrFail($id);
        $data->delete();

        return redirect()->route('dashboard.approval.' . $type . '.index');
    }
}
