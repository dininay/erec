<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;

class DataExportController extends Controller
{
    public function downloadExcel()
    {
        $data = Apply::all();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID Apply');
        $sheet->setCellValue('B1', 'ID Register');
        $sheet->setCellValue('C1', 'ID User');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Nama Lengkap');
        $sheet->setCellValue('F1', 'BB');
        $sheet->setCellValue('G1', 'TB');
        $sheet->setCellValue('H1', 'JK');
        $sheet->setCellValue('I1', 'Tempat, Tanggal Lahir');
        $sheet->setCellValue('J1', 'Usia');
        $sheet->setCellValue('K1', 'Alamat Domisili');
        $sheet->setCellValue('L1', 'NIK KTP');
        $sheet->setCellValue('M1', 'Status Nikah');
        $sheet->setCellValue('N1', 'Jumlah Anak');
        $sheet->setCellValue('O1', 'Riwayat Kesehatan');
        $sheet->setCellValue('P1', 'Pendiidkan Terakhir');
        $sheet->setCellValue('Q1', 'Asal Sekolah');
        $sheet->setCellValue('R1', 'Jurusan');
        $sheet->setCellValue('S1', 'Tahun Lulus');
        $sheet->setCellValue('T1', 'IPK / Nilai Rata-Rata');
        $sheet->setCellValue('U1', 'No Whatsapp Aktif');
        $sheet->setCellValue('V1', 'Tanggal Dibuat');
        $sheet->setCellValue('W1', 'Quest 1');
        $sheet->setCellValue('X1', 'Quest 2');
        $sheet->setCellValue('Y1', 'Quest 3');
        $sheet->setCellValue('Z1', 'Quest 4');
        $sheet->setCellValue('AA1', 'Quest 5');
        $sheet->setCellValue('AB1', 'Experience 1');
        $sheet->setCellValue('AC1', 'Experience 2');
        $sheet->setCellValue('AD1', 'Info Vacancy');

        $row = 2;
        foreach ($data as $apply) {
            $sheet->setCellValue('A' . $row, $apply->apply_id);
            $sheet->setCellValue('B' . $row, $apply->reg_id);
            $sheet->setCellValue('C' . $row, $apply->user_id);
            $sheet->setCellValue('D' . $row, $apply->email);
            $sheet->setCellValue('E' . $row, $apply->name);
            $sheet->setCellValue('F' . $row, $apply->bb);
            $sheet->setCellValue('G' . $row, $apply->tb);
            $sheet->setCellValue('H' . $row, $apply->jk);
            $sheet->setCellValue('I' . $row, $apply->ttl);
            $sheet->setCellValue('J' . $row, $apply->age);
            $sheet->setCellValue('K' . $row, $apply->domisili);
            $sheet->setCellValue('L' . $row, $apply->nik_ktp);
            $sheet->setCellValue('M' . $row, $apply->status_nikah);
            $sheet->setCellValue('N' . $row, $apply->jml_anak);
            $sheet->setCellValue('O' . $row, $apply->riwayat_kesehatan);
            $sheet->setCellValue('P' . $row, $apply->last_pendidikan);
            $sheet->setCellValue('Q' . $row, $apply->asal_sekolah);
            $sheet->setCellValue('R' . $row, $apply->jurusan);
            $sheet->setCellValue('S' . $row, $apply->th_lulus);
            $sheet->setCellValue('T' . $row, $apply->ipk);
            $sheet->setCellValue('U' . $row, $apply->wa_aktif);
            $sheet->setCellValue('V' . $row, $apply->created_at);
            $sheet->setCellValue('W' . $row, $apply->details->quest_1);
            $sheet->setCellValue('X' . $row, $apply->details->quest_2);
            $sheet->setCellValue('Y' . $row, $apply->details->quest_3);
            $sheet->setCellValue('Z' . $row, $apply->details->quest_4);
            $sheet->setCellValue('AA' . $row, $apply->details->quest_5);
            $sheet->setCellValue('AB' . $row, $apply->details->experience_1);
            $sheet->setCellValue('AC' . $row, $apply->details->experience_2);
            $sheet->setCellValue('AD' . $row, $apply->details->info_vacancy);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'data-applicant.xlsx';

        return response()->stream(function() use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="data-query.xlsx"',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
