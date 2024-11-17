<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $jobtypes = JobType::orderBy('jobtype_id', 'DESC')->get();
        return view('admin.job-type.index', [
            'jobtypes'=> $jobtypes,
            'user'=> $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user = Auth::user();
        return view('admin.job-type.create', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'jobtype_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->jobtype_name);
            $newJobType = JobType::create($validated);

            DB::commit();

            return redirect()->route('dashboard.jobtype.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobType $jobtype)
    {
        //
        $people = $jobtype->people()->orderBy('id', 'DESC')->get();

        return view('admin.job-type.manage', [
            'jobtype'=> $jobtype,
            'people'=> $people,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobType $jobtype)
    {
        //
        $user = Auth::user();
        // $course = Courses::findOrFail($jobtype);
        // $people = People::findOrFail($jobtype);
        // $jobtype = JobType::findOrFail($jobtype);
        // $joblevel = JobLevel::findOrFail($jobtype);
        // $workloc = WorkLoc::findOrFail($jobtype);
        return view('admin.job-type.edit', [
            'jobtype'=> $jobtype,
            'user'=> $user,
            // 'course'=> $course,
            // 'people'=> $people,
            // 'joblevel'=> $joblevel,
            // 'workloc'=> $workloc,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobType $jobtype)
    {
        //
        $validated = $request->validate([
            'jobtype_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->jobtype_name);
            $jobtype->update($validated);

            DB::commit();

            return redirect()->route('dashboard.jobtype.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobType $jobtype)
    {
        //
        try{
            $jobtype->delete();
            return redirect()->route('dashboard.job-type.index');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
}
