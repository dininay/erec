<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'r_category';
    protected $primaryKey = 'cat_id';
    
    protected $fillable = [
        'cat_id',
        'cat_name',
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

            // Menghasilkan cat_id secara otomatis
            $maxCategoryId = Category::max('cat_id'); // Ambil nilai cat_id maksimum
            $model->cat_id = $maxCategoryId ? $maxCategoryId + 1 : 1; // Set cat_id, mulai dari 1 jika tidak ada
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
