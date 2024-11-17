<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class JobLevel extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'm_joblevel';
    protected $primaryKey = 'joblevel_id';
    
    protected $fillable = [
        'joblevel_id',
        'joblevel_name',
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

            // Menghasilkan joblevel_id secara otomatis
            $maxJoblevelId = JobLevel::max('joblevel_id'); // Ambil nilai joblevel_id maksimum
            $model->joblevel_id = $maxJoblevelId ? $maxJoblevelId + 1 : 1; // Set joblevel_id, mulai dari 1 jika tidak ada
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
}
