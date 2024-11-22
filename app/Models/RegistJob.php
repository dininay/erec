<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RegistJob extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'r_registjob';
    protected $primaryKey = 'reg_id';
    public $incrementing = false; 
    protected $keyType = 'string';
    
    protected $fillable = [
        'reg_id',
        'reg_name',
        'reg_code',
        'job_title',
        'reg_name',
        'div_id',
        'dept_id',
        'workloc_id',
        'job_respons',
        'type_id',
        'level_id',
        'vacancy_number',
        'job_desc',
        'qualification',
        'general_req',
        'status_job',
        'created_at',
        'updated_at',
        'create_by',
        'modified_by'
    ];

    protected static function boot()
    {
        parent::boot();

        // Event ketika menambah data (creating)
        static::creating(function ($model) {
            $model->created_at = Carbon::now(); // Mengisi created_at dengan tanggal saat ini
            $model->create_by = Auth::user()->name ?? 'system'; // Mengisi create_by dengan name user yang login

            // Menghasilkan reg_id secara otomatis
            $maxRegId = RegistJob::max('reg_id'); // Ambil nilai reg_id maksimum
            $model->reg_id = $maxRegId ? $maxRegId + 1 : 1; // Set reg_id, mulai dari 1 jika tidak ada
        });

        // Event ketika mengupdate data (updating)
        static::updating(function ($model) {
            $model->updated_at = Carbon::now(); // Mengisi updated_at dengan tanggal saat ini
            $model->modified_by = Auth::user()->name ?? 'system'; // Mengisi modified_by dengan name user yang login
        });
    }

    public function people(){
        return $this->belongsToMany(User::class, 'r_people', 'course_id', 'user_id');
    }

    public function division(){
        return $this->belongsTo(Division::class, 'div_id');
    }

    public function dept(){
        return $this->belongsTo(Dept::class, 'dept_id');
    }

    public function workloc(){
        return $this->belongsTo(WorkLoc::class, 'workloc_id');
    }

    public function jobtype(){
        return $this->belongsTo(JobType::class, 'type_id');
    }

    public function joblevel(){
        return $this->belongsTo(JobLevel::class, 'level_id');
    }
}
