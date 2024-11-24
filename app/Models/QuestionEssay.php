<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class QuestionEssay extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'r_question';
    protected $primaryKey = 'question_id';
    
    protected $fillable = [
        'question_id',
        'course_id',
        'question_name',
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

            // // Menghasilkan question_id secara otomatis
            // $maxQuestionId = Question::max('question_id'); // Ambil nilai question_id maksimum
            // $model->question_id = $maxQuestionId ? $maxQuestionId + 1 : 1; // Set question_id, mulai dari 1 jika tidak ada
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

    public function answers(){
        return $this->hasMany(Answer::class, 'question_id', 'question_id');
    }
    
    public function people(){
        return $this->belongsToMany(User::class, 'r_people', 'course_id', 'user_id');
    }
    
    public function peopleAnswers()
    {
        return $this->hasMany(PeopleAnswer::class, 'question_id');
    }
}
