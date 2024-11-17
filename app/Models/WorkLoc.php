<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class WorkLoc extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'm_workloc';
    protected $primaryKey = 'workloc_id';
    
    protected $fillable = [
        'workloc_id',
        'workloc_name',
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

            // Menghasilkan workloc_id secara otomatis
            $maxWorkLocId = WorkLoc::max('workloc_id'); // Ambil nilai workloc_id maksimum
            $model->workloc_id = $maxWorkLocId ? $maxWorkLocId + 1 : 1; // Set workloc_id, mulai dari 1 jika tidak ada
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
