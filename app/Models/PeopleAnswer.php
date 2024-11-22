<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeopleAnswer extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'r_people_answers';
    protected $primaryKey = 'people_answer_id';
    
    protected $fillable = [
        'people_status_id',
        'user_id',
        'question_id',
        'answer',
        'created_at',
        'updated_at',
        'create_by',
        'modified_by'
    ];
    
    public function course(){
        return $this->belongsToMany(Courses::class);
    }

    public function question()
    {
        return $this->belongsToMany(Question::class, 'r_people_answers', 'people_answer_id', 'question_id');
    }

    public function questions()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

}
