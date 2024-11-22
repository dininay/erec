<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apply extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'r_apply';
    protected $primaryKey = 'apply_id';
    
    protected $fillable = [
        'apply_id',
        'apply_det_id',
        'email',
        'name',
        'bb',
        'tb',
        'jk',
        'ttl',
        'age',
        'domisili',
        'nik_ktp',
        'status_nikah',
        'jml_anak',
        'riwayat_kesehatan',
        'last_pendidikan',
        'asal_sekolah',
        'jurusan',
        'th_lulus',
        'ipk',
        'wa_aktif',
        'created_at',
        'updated_at',
        'create_by',
        'modified_by'
    ];

    public function registjob(){
        return $this->belongsTo(RegistJob::class, 'reg_id', 'reg_id');
    }

    public function applydet(){
        return $this->belongsTo(ApplyDetail::class, 'apply_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
