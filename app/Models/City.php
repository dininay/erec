<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    use HasFactory;
    protected $table = 'm_city';
    protected $primaryKey = 'city_id';
    
    protected $fillable = [
        'city_id',
        'provinsi',
        'city',
        'ct',
        'create_by',
        'modified_by'
    ];
}
