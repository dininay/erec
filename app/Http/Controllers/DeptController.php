<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DeptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $depts = Dept::orderBy('dept_id', 'DESC')->get();
        return view('admin.dept.index', [
            'depts'=> $depts,
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
        return view('admin.dept.create', [
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
            'dept_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->dept_name);
            $newDept = Dept::create($validated);

            DB::commit();

            return redirect()->route('dashboard.dept.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Dept $dept)
    {
        //
        $people = $dept->people()->orderBy('id', 'DESC')->get();

        return view('admin.dept.manage', [
            'dept'=> $dept,
            'people'=> $people,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dept $dept)
    {
        //
        $user = Auth::user();
        // $course = Courses::findOrFail($dept);
        // $people = People::findOrFail($dept);
        // $dept = Dept::findOrFail($dept);
        // $dept = Dept::findOrFail($dept);
        // $dept = Dept::findOrFail($dept);
        return view('admin.dept.edit', [
            'dept'=> $dept,
            'user'=> $user,
            // 'course'=> $course,
            // 'people'=> $people,
            // 'dept'=> $dept,
            // 'dept'=> $dept,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dept $dept)
    {
        //
        $validated = $request->validate([
            'dept_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->dept_name);
            $dept->update($validated);

            DB::commit();

            return redirect()->route('dashboard.dept.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dept $dept)
    {
        //
        try{
            $dept->delete();
            return redirect()->route('dashboard.dept.index');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
}
