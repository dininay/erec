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
        $latestJobs = $jobs->take(4); 
        return view('job', [
            'jobs'=> $latestJobs,
            'user'=> $user,
        ]);
    }
    
    public function indexprofil()
    {
        //
        $user = Auth::check() ? Auth::user() : null;

        $applys = $user 
            ? Apply::with('registjob')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'DESC')
                ->get()
            : collect();
    
        $jobs = RegistJob::orderBy('reg_id', 'DESC')->get();
        $latestJobs = $jobs->take(4);
    
        // Return the profile view
        return view('profile', [
            'jobs' => $latestJobs,
            'user' => $user,
            'applys' => $applys,
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
