<?php

namespace App\Http\Controllers;

use App\Models\JobLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $joblevels = JobLevel::orderBy('joblevel_id', 'DESC')->get();
        return view('admin.job-level.index', [
            'joblevels'=> $joblevels,
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
        return view('admin.job-level.create', [
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
            'joblevel_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->joblevel_name);
            $newJobLevel = JobLevel::create($validated);

            DB::commit();

            return redirect()->route('dashboard.joblevel.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobLevel $joblevel)
    {
        //
        $people = $joblevel->people()->orderBy('id', 'DESC')->get();

        return view('admin.job-level.manage', [
            'joblevel'=> $joblevel,
            'people'=> $people,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobLevel $joblevel)
    {
        //
        $user = Auth::user();
        // $course = Courses::findOrFail($joblevel);
        // $people = People::findOrFail($joblevel);
        // $joblevel = JobLevel::findOrFail($joblevel);
        // $joblevel = JobLevel::findOrFail($joblevel);
        // $workloc = WorkLoc::findOrFail($joblevel);
        return view('admin.job-level.edit', [
            'joblevel'=> $joblevel,
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
    public function update(Request $request, JobLevel $joblevel)
    {
        //
        $validated = $request->validate([
            'joblevel_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->joblevel_name);
            $joblevel->update($validated);

            DB::commit();

            return redirect()->route('dashboard.joblevel.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobLevel $joblevel)
    {
        //
        try{
            $joblevel->delete();
            return redirect()->route('dashboard.job-level.index');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
}
