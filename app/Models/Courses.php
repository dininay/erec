<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Courses extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'r_course';
    protected $primaryKey = 'course_id';
    
    protected $fillable = [
        'course_id',
        'course_name',
        'course_time',
        'cat_id',
        // 'course_type',
        'access_type',
        // 'publish_date',
        'cover',
        'slug',
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

            // Menghasilkan course_id secara otomatis
            $maxCourseId = Courses::max('course_id'); // Ambil nilai course_id maksimum
            $model->course_id = $maxCourseId ? $maxCourseId + 1 : 1; // Set course_id, mulai dari 1 jika tidak ada
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

    public function questions(){
        return $this->hasMany(Question::class, 'course_id', 'course_id');
    }
    
    public function people(){
        return $this->belongsToMany(User::class, 'r_people', 'course_id', 'user_id');
    }
    
    public function peopleAnswers()
    {
        return $this->hasMany(PeopleAnswer::class, 'question_id');
    }

    public function apply()
    {
        return $this->belongsTo(Apply::class, 'apply_id');
    }
}
