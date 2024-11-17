<?php

namespace App\Http\Controllers;

use App\Models\WorkLoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorkLocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $worklocs = WorkLoc::orderBy('workloc_id', 'DESC')->get();
        return view('admin.workloc.index', [
            'worklocs'=> $worklocs,
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
        return view('admin.workloc.create', [
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
            'workloc_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->workloc_name);
            $newWorkLoc = WorkLoc::create($validated);

            DB::commit();

            return redirect()->route('dashboard.workloc.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkLoc $workloc)
    {
        //
        $people = $workloc->people()->orderBy('id', 'DESC')->get();

        return view('admin.workloc.manage', [
            'workloc'=> $workloc,
            'people'=> $people,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkLoc $workloc)
    {
        //
        $user = Auth::user();
        // $course = Courses::findOrFail($workloc);
        // $people = People::findOrFail($workloc);
        // $workloc = WorkLoc::findOrFail($workloc);
        // $workloc = WorkLoc::findOrFail($workloc);
        // $workloc = WorkLoc::findOrFail($workloc);
        return view('admin.workloc.edit', [
            'workloc'=> $workloc,
            'user'=> $user,
            // 'course'=> $course,
            // 'people'=> $people,
            // 'workloc'=> $workloc,
            // 'workloc'=> $workloc,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkLoc $workloc)
    {
        //
        $validated = $request->validate([
            'workloc_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->workloc_name);
            $workloc->update($validated);

            DB::commit();

            return redirect()->route('dashboard.workloc.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkLoc $workloc)
    {
        //
        try{
            $workloc->delete();
            return redirect()->route('dashboard.workloc.index');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
}
