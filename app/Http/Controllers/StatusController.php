<?php

namespace App\Http\Controllers;

use App\Models\Status; // sesuaikan dengan model yang digunakan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function indexadmin()
    {
        $user = Auth::user();
        $statuss = Status::orderBy('people_status_id', 'DESC')->get();
        return view('admin.approval.administration.index', [
            'statuss'=> $statuss,
            'user'=> $user,
        ]);
    }
    
    public function indexinterview()
    {
        $user = Auth::user();
        $statuss = Status::orderBy('people_status_id', 'DESC')->get();
        return view('admin.approval.interview.index', [
            'statuss'=> $statuss,
            'user'=> $user,
        ]);
    }
    
    public function indexdocclear()
    {
        $user = Auth::user();
        $statuss = Status::orderBy('people_status_id', 'DESC')->get();
        return view('admin.approval.docclear.index', [
            'statuss'=> $statuss,
            'user'=> $user,
        ]);
    }
    
    public function indexoje()
    {
        $user = Auth::user();
        $statuss = Status::orderBy('people_status_id', 'DESC')->get();
        return view('admin.approval.oje.index', [
            'statuss'=> $statuss,
            'user'=> $user,
        ]);
    }
    
    public function indexonboarding()
    {
        $user = Auth::user();
        $statuss = Status::orderBy('people_status_id', 'DESC')->get();
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

    public function destroy($type, $id)
    {
        $data = Status::where('type', $type)->findOrFail($id);
        $data->delete();

        return redirect()->route('dashboard.approval.' . $type . '.index');
    }
}
