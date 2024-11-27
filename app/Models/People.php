<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class People extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'r_people';
    protected $primaryKey = 'people_id';
    
    protected $fillable = [
        'people_id',
        'people_name',
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

            // Menghasilkan people_id secara otomatis
            $maxpeopleId = People::max('people_id'); // Ambil nilai people_id maksimum
            $model->people_id = $maxpeopleId ? $maxpeopleId + 1 : 1; // Set people_id, mulai dari 1 jika tidak ada
        });

        // Event ketika mengupdate data (updating)
        static::updating(function ($model) {
            $model->updated_at = Carbon::now(); // Mengisi updated_at dengan tanggal saat ini
            $model->modified_by = Auth::user()->name ?? 'system'; // Mengisi modified_by dengan name user yang login
        });
    }

    public function category(){
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function course(){
        return $this->belongsTo(Courses::class, 'course_id');
    }

    public function apply(){
        return $this->belongsTo(Apply::class, 'apply_id');
    }

    public function registjob(){
        return $this->belongsToThrough(RegistJob::class, Apply::class, 'apply_id', 'reg_code', 'reg_id');
    }
}
