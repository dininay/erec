<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Dept;
use App\Models\Division;
use App\Models\JobLevel;
use App\Models\JobType;
use App\Models\RegistJob;
use App\Models\WorkLoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $jobs = RegistJob::orderBy('reg_id', 'DESC')->get();
        $latestJobs = $jobs->take(4); 
        return view('welcome', [
            'jobs'=> $latestJobs,
            'user'=> $user,
        ]);
    }
    
    public function indexjob()
    {
        //
        $user = Auth::user();
        $jobs = RegistJob::orderBy('reg_id', 'DESC')->get();
        $headOfficeJobs = RegistJob::where('reg_code', 'like', 'HOF%')
        ->where('status_job', 'Aktif')
            ->orderBy('created_at', 'DESC')
            ->take(3)
            ->get();

        $manufactureJobs = RegistJob::where('reg_code', 'like', 'MAN%')
        ->where('status_job', 'Aktif')
            ->orderBy('created_at', 'DESC')
            ->take(3)
            ->get();

        $restoJobs = RegistJob::where('reg_code', 'like', 'OPS%')
        ->where('status_job', 'Aktif')
            ->orderBy('created_at', 'DESC')
            ->take(3)
            ->get();
        $latestJobs = $jobs->take(4); 
        return view('job', [
            'jobs'=> $latestJobs,
            'headOfficeJobs' => $headOfficeJobs,
            'manufactureJobs' => $manufactureJobs,
            'restoJobs' => $restoJobs,
            'user'=> $user,
        ]);
    }
    
    public function indexjobdetail($reg_code = null)
    {
        // if (!Auth::check()) {
        //     // Jika belum login, tampilkan pesan dan redirect ke halaman login
        //     return back()->with('alert', [
        //         'type' => 'error',
        //         'title' => 'Anda Belum Login!',
        //         'message' => 'Silahkan masuk menggunakan akun E-Recruitment Mie Gacoan terlebih dahulu.',
        //     ]);
        // }
        
        // $user = Auth::user();

        $user = Auth::check() ? Auth::user() : null;
        // Jika treg_code disediakan, filter data berdasarkan treg_code
        if ($reg_code) {
            $jobs = RegistJob::where('reg_code', $reg_code)->first();
        } else {
            // Jika tidak, ambil semua data
            $jobs = RegistJob::all();
        }

        $jobrelated = RegistJob::where('reg_code', 'like', 'HOF%')
        ->where('status_job', 'Aktif')
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();

        // Cek apakah sudah melamar
        $applyExists = false;
        if ($user) {
            $applyExists = Apply::where('reg_id', $reg_code)
                ->where('email', $user->email)
                ->exists();
        }

        return view('crew.job.job_detail', compact('jobs', 'jobrelated', 'applyExists'));
    }

    public function indexprofil()
    {
        //
        $user = Auth::check() ? Auth::user() : null;

        $jobs = RegistJob::leftJoin('r_apply', 'r_registjob.reg_code', '=', 'r_apply.reg_id')
        ->leftjoin('r_people_status', 'r_apply.apply_id', '=', 'r_people_status.apply_id')
        ->select(
            'r_apply.*',
            'r_people_status.*',
            'r_registjob.*'
        )
        ->orderBy('r_registjob.reg_id', 'DESC')
        ->get();

        $applys = $user
        ? $jobs->filter(fn($job) => $job->user_id === $user->id)->values()
        : collect();

        $latestJobs = $jobs->take(4);
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
    
        // Return the profile view
        return view('profile', [
            'user' => $user,
            'jobs' => $jobs,
            'applys' => $applys,
            'jobDetails' => $jobDetails, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = Auth::user();
        $divisions = Division::all();
        $depts = Dept::all();
        $worklocs = WorkLoc::all();
        $jobtypes = JobType::all();
        $joblevels = JobLevel::all();
        return view('admin.job.create', [
            'user' => $user,
            'divisions' => $divisions,
            'depts' => $depts,
            'worklocs' => $worklocs,
            'jobtypes' => $jobtypes,
            'joblevels' => $joblevels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_desc' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'div_id' => 'required|string|max:255',
            'dept_id' => 'required|string|max:255',
            'workloc_id' => 'required|string|max:255',
            'type_id' => 'required|string|max:255',
            'level_id' => 'required|string|max:255',
            'job_respons' => 'required|string|max:255',
            'general_req' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['reg_name'] = Str::slug($request->job_title);
            $newRegistJob = RegistJob::create($validated);

            DB::commit();

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
    public function show(RegistJob $job)
    {
        //
        $people = $job->people()->orderBy('id', 'DESC')->get();
        $user = Auth::user();
        return view('admin.job.manage', [
            'job'=> $job,
            'user'=> $user,
            'people'=> $people,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegistJob $job)
    {
        //
        $user = Auth::user();
        $divisions = Division::all();
        $depts = Dept::all();
        $worklocs = WorkLoc::all();
        $jobtypes = JobType::all();
        $joblevels = JobLevel::all();
        return view('admin.job.edit', [
            'job'=> $job,
            'user'=> $user,
            'divisions'=> $divisions,
            'depts'=> $depts,
            'worklocs'=> $worklocs,
            'jobtypes'=> $jobtypes,
            'joblevels'=> $joblevels,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegistJob $job)
    {
        //
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_desc' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'div_id' => 'required|string|max:255',
            'dept_id' => 'required|string|max:255',
            'workloc_id' => 'required|string|max:255',
            'type_id' => 'required|string|max:255',
            'level_id' => 'required|string|max:255',
            'job_respons' => 'required|string|max:255',
            'general_req' => 'required|string|max:255',
            'status_job' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['reg_name'] = Str::slug($request->job_title);
            $job->update($validated);

            DB::commit();

            return redirect()->route('dashboard.job.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistJob $job)
    {
        //
        try{
            $job->delete();
            return redirect()->route('dashboard.job.index');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
}
