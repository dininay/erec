<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Answer extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'r_answer';
    protected $primaryKey = 'answer_id';

    protected $fillable = [
        'answer_id',
        'question_id',
        'answer_name',
        'is_correct',
        'created_at',
        'updated_at',
        'create_by',
        'modified_by'
    ];

    protected static function boot()
    {
        parent::boot();

        // Menghasilkan answer_id secara otomatis
        // Event ketika menambah data (creating)
        static::creating(function ($model) {
            $model->created_at = Carbon::now(); // Mengisi created_at dengan tanggal saat ini
            $model->create_by = Auth::user()->name ?? 'system'; // Mengisi create_by dengan name user yang login

            // Menghasilkan answer_id secara otomatis
            // $maxAnswerId = Answer::max('answer_id'); // Ambil nilai answer_id maksimum
            // $model->answer_id = $maxAnswerId ? $maxAnswerId + 1 : 1; // Set answer_id, mulai dari 1 jika tidak ada
        });

        // Event ketika mengupdate data (updating)
        static::updating(function ($model) {
            $model->updated_at = Carbon::now(); // Mengisi updated_at dengan tanggal saat ini
            $model->modified_by = Auth::user()->name ?? 'system'; // Mengisi modified_by dengan name user yang login
        });
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'question_id');
    }
    
}
