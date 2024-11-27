<?php
namespace App\Exports;

use App\Models\Apply; // Make sure this is your correct model
use Maatwebsite\Excel\Concerns\FromView; // Correct import
use Illuminate\Contracts\View\View;

class DataExport implements FromView
{
    public function view(): View
    {
        return view('export.data-applicant', [
            'data' => Apply::all() // Query all data
        ]);
    }
}
