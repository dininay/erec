<?php

namespace App\Http\Controllers;

use App\Models\City;
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

class RegistJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $jobs = RegistJob::all();
        return view('admin.job.index', [
            'jobs' => $jobs,
            'user' => $user,
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
        $specworks = City::all();
        $jobtypes = JobType::all();
        $joblevels = JobLevel::all();
        return view('admin.job.create', [
            'user' => $user,
            'divisions' => $divisions,
            'depts' => $depts,
            'worklocs' => $worklocs,
            'jobtypes' => $jobtypes,
            'joblevels' => $joblevels,
            'specworks' => $specworks,
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
            // 'job_desc' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'div_id' => 'required|string|max:255',
            'dept_id' => 'required|string|max:255',
            'workloc_id' => 'required|string|max:255',
            'specwork_id' => 'required|string|max:255',
            'type_id' => 'required|string|max:255',
            'level_id' => 'required|string|max:255',
            'job_respons' => 'required|string|max:255',
            'general_req' => 'required|string|max:255',
            'vacancy_number' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $worklocName = WorkLoc::find($request->workloc_id)->workloc_name ?? null;
            $prefix = '';

            switch ($worklocName) {
                case 'Head Office':
                    $prefix = 'HOF';
                    break;
                case 'Resto':
                    $prefix = 'OPS';
                    break;
                case 'Manufacture':
                    $prefix = 'MAN';
                    break;
                default:
                    throw new \Exception('Work location name not recognized.');
            }

            $date = now();

            $entryCount = RegistJob::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $entryNumber = str_pad($entryCount + 1, 2, '0', STR_PAD_LEFT);

            $date = now();
            $regId = sprintf(
                '%s%s%s%s',
                $prefix,
                $date->format('m'),
                $date->format('Y'),
                $entryNumber
            );

            $validated['reg_code'] = $regId;
            $validated['reg_name'] = Str::slug($request->job_title);
            $validated['status_job'] = 'Aktif';

            RegistJob::create($validated);

            DB::commit();

            return redirect()->route('dashboard.job.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !' . $e->getMessage()]);
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
            'job' => $job,
            'user' => $user,
            'people' => $people,
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
        $specworks = City::all();
        $jobtypes = JobType::all();
        $joblevels = JobLevel::all();
        return view('admin.job.edit', [
            'job' => $job,
            'user' => $user,
            'divisions' => $divisions,
            'depts' => $depts,
            'worklocs' => $worklocs,
            'specworks' => $specworks,
            'jobtypes' => $jobtypes,
            'joblevels' => $joblevels,
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
            'specwork_id' => 'required|string|max:255',
            'type_id' => 'required|string|max:255',
            'level_id' => 'required|string|max:255',
            'job_respons' => 'required|string|max:255',
            'general_req' => 'required|string|max:255',
            'status_job' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $validated['reg_name'] = Str::slug($request->job_title);
            $job->update($validated);

            DB::commit();

            return redirect()->route('dashboard.job.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistJob $job)
    {
        //
        try {
            $job->delete();
            return redirect()->route('dashboard.job.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['system_error' => 'System Error !' . $e->getMessage()]);
        }
    }

    public function searchJobs(Request $request)
    {
        $request->validate([
            'searchKeyword' => 'nullable|string|max:255',
        ]);

        $keyword = $request->searchKeyword;

        $jobs = DB::table('r_registjob')
            ->where('status_job', 'Aktif')
            ->when($keyword, function ($query, $keyword) {
                $query->where('job_title', 'LIKE', "%{$keyword}%");
            })
            ->get();

        if ($keyword && $jobs->isEmpty()) {
            return response()->json(['message' => 'No jobs found matching your search.']);
        }

        return response()->json($jobs);
    }


}
