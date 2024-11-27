<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplyDetail extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $table = 'r_apply_detail';
    protected $primaryKey = 'apply_det_id';
    
    protected $fillable = [
        'apply_det_id',
        'apply_id',
        'quest_1',
        'quest_2',
        'quest_3',
        'quest_4',
        'quest_5',
        'experience_1',
        'experience_2',
        'cv',
        'photo',
        'info_vacancy'
    ];

    public function apply()
    {
        return $this->belongsTo(Apply::class, 'apply_id', 'apply_id');
    }

}
