<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $divisions = Division::orderBy('div_id', 'DESC')->get();
        return view('admin.division.index', [
            'divisions'=> $divisions,
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
        return view('admin.division.create', [
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
            'div_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->div_name);
            $newDivision = Division::create($validated);

            DB::commit();

            return redirect()->route('dashboard.division.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division)
    {
        //
        $people = $division->people()->orderBy('id', 'DESC')->get();

        return view('admin.division.manage', [
            'division'=> $division,
            'people'=> $people,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        //
        $user = Auth::user();
        // $course = Courses::findOrFail($division);
        // $people = People::findOrFail($division);
        // $division = Division::findOrFail($division);
        // $division = Division::findOrFail($division);
        // $division = Division::findOrFail($division);
        return view('admin.division.edit', [
            'division'=> $division,
            'user'=> $user,
            // 'course'=> $course,
            // 'people'=> $people,
            // 'division'=> $division,
            // 'division'=> $division,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division)
    {
        //
        $validated = $request->validate([
            'div_name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $validated['slug'] = Str::slug($request->div_name);
            $division->update($validated);

            DB::commit();

            return redirect()->route('dashboard.division.index');
        }
        
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        //
        try{
            $division->delete();
            return redirect()->route('dashboard.division.index');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !'. $e->getMessage()]);
        }
    }
}
