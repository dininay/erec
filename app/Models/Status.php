<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Status extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'r_people_status';
    protected $primaryKey = 'people_status_id';
    
    protected $fillable = [
        'people_status_id',
        'status_admin',
        'admin_date',
        'status_interview',
        'interview_date',
        'status_docclear',
        'docclear_date',
        'status_oje',
        'oje_date',
        'status_onboarding',
        'onboarding_date',
        'join_date',
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

            // Menghasilkan people_status_id secara otomatis
            $maxStatusId = Status::max('people_status_id'); // Ambil nilai people_status_id maksimum
            $model->people_status_id = $maxStatusId ? $maxStatusId + 1 : 1; // Set people_status_id, mulai dari 1 jika tidak ada
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

    public function apply()
    {
        return $this->belongsTo(Apply::class, 'apply_id', 'apply_id');
    }

}
