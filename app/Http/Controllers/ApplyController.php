<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\ApplyDetail;
use App\Models\PeopleStatus;
use App\Models\RegistJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return view('admin.apply.index', [
            'statusapplys'=> $statusapplys,
            'user'=> $user,
        ]);
    }

    public function applyjob(Apply $apply, RegistJob $registJob, $reg_code = null)
    {
        if (!Auth::check()) {
            // Jika belum login, tampilkan pesan dan redirect ke halaman login
            return back()->with('alert', [
                'type' => 'error',
                'title' => 'Anda Belum Login!',
                'message' => 'Silahkan masuk menggunakan akun E-Recruitment Mie Gacoan terlebih dahulu.',
            ]);
        }

        $user = Auth::user();

        // Ambil pekerjaan berdasarkan reg_code
        $jobs = RegistJob::where('reg_code', $reg_code)->first();

        if (!$jobs) {
            return redirect()->route('joblist')->with('error', 'Pekerjaan tidak ditemukan.');
        }

        // Cek apakah sudah melamar
        $applyExists = Apply::where('reg_id', $reg_code)
            ->where('email', $user->email)
            ->exists();

        // Kirim variabel $applyExists ke view
        if ($applyExists) {
            // Jika sudah melamar, tampilkan SweetAlert di frontend
            return view('job.detail', compact('jobs', 'applyExists'));
        }

        // Kirim variabel $applyExists ke view apply_job
        return view('crew.job.apply_job', [
            'jobs' => $jobs,
            'user' => $user,
            'applyExists' => $applyExists
        ]);
    }

    public function submitApply(Request $request)
    {
        $validated = $request->validate([
            // Validasi untuk Apply (row 1)
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'nik_ktp' => 'required|string',
            'wa_aktif' => 'required|string',
            'tempat_lahir' => 'required|string',
            'ttl' => 'required|date',
            'age' => 'required|numeric',
            'domisili' => 'required|string',
            'jk' => 'required|string|in:Laki-Laki,Perempuan',
            'bb' => 'required|numeric',
            'tb' => 'required|numeric',
            'status_nikah' => 'required|string|in:Belum Menikah,Menikah',
            'jml_anak' => 'required|numeric',
            'riwayat_kesehatan' => 'required|string',
            'last_pendidikan' => 'required|string',
            'asal_sekolah' => 'required|string',
            'jurusan' => 'required|string',
            'th_lulus' => 'required|date',
            'ipk' => 'required|numeric',
            'reg_code' => 'required|string',

            // Validasi untuk ApplyDetail (row 2)
            'quest_1' => 'required|string',
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'quest_3' => 'nullable|string',
            'quest_4' => 'nullable|string',
            'quest_5' => 'required|string',
            'experience_1' => 'required|string',
            'experience_2' => 'nullable|string',
            'cv' => 'required|file|mimes:pdf|max:2048', // File CV, format PDF
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // File Photo
        ]);

        // Insert ke tabel Apply
        $apply = new Apply();
        $apply->name = $validated['name'];
        $apply->email = $validated['email'];
        $apply->nik_ktp = $validated['nik_ktp'];
        $apply->wa_aktif = $validated['wa_aktif'];
        $apply->ttl = $validated['tempat_lahir'] . ', ' . $validated['ttl'];
        $apply->age = $validated['age'];
        $apply->domisili = $validated['domisili'];
        $apply->jk = $validated['jk'];
        $apply->bb = $validated['bb'];
        $apply->tb = $validated['tb'];
        $apply->status_nikah = $validated['status_nikah'];
        $apply->jml_anak = $validated['jml_anak'];
        $apply->riwayat_kesehatan = $validated['riwayat_kesehatan'];
        $apply->last_pendidikan = $validated['last_pendidikan'];
        $apply->asal_sekolah = $validated['asal_sekolah'];
        $apply->jurusan = $validated['jurusan'];
        $apply->th_lulus = $validated['th_lulus'];
        $apply->ipk = $validated['ipk'];
        $apply->reg_id = $validated['reg_code'];
    
        $regCode = $validated['reg_code'];
        $bulan = date('m'); 
        $tahun = date('Y');
    
        $applyCount = Apply::where('reg_id', $validated['reg_code'])->count() + 1; 
    
        // Format apply_id
        $apply_id = $regCode . $bulan . $tahun . str_pad($applyCount, 2, '0', STR_PAD_LEFT);
    
        $apply->apply_id = $apply_id;
        $apply->save();

        // Insert ke tabel ApplyDetail
        $applyDetail = new ApplyDetail();

        $applyDetail->apply_id = $apply_id;
        $applyDetail->quest_1 = $validated['quest_1'];
        $applyDetail->quest_2 = $validated['from'] . ' - ' . $validated['to'];
        $applyDetail->quest_3 = $validated['quest_3'] ?? null;
        $applyDetail->quest_4 = $validated['quest_4'] ?? null;
        $applyDetail->quest_5 = $validated['quest_5'];
        $applyDetail->experience_1 = $validated['experience_1'];
        $applyDetail->experience_2 = $validated['experience_2'] ?? null;
        
        $folderPath = public_path('images/' . $validated['reg_code']);
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        $cvFileName = 'cv_' . $apply_id . '.pdf';
        $request->file('cv')->move($folderPath, $cvFileName);

        $photo = $request->file('photo');
        $photoExtension = $photo->getClientOriginalExtension();
        $photoFileName = 'photo_' . $apply_id . '.' . $photoExtension;
        $photo->move($folderPath, $photoFileName);

        $applyDetail->cv = $cvFileName;
        $applyDetail->photo = $photoFileName;
        $applyDetail->save();

        $peopleStatus = new PeopleStatus();
        $peopleStatus->user_id = Auth::id();  
        $peopleStatus->apply_id = $apply_id; 
        $peopleStatus->status_admin = 'In Process';
        $peopleStatus->save();

        return redirect()->route('jobdetail', ['reg_code' => $validated['reg_code']])->with('success', 'Form berhasil disubmit!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Apply $apply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apply $apply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apply $apply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apply $apply)
    {
        //
    }
}
