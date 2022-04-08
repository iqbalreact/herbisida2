<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prediksi extends Model
{
    //
    protected $primaryKey = 'id';
    /**
    * Indicates if the IDs are auto-incrementing.
    *
    * @var bool
    */
    public $incrementing = true;
    public $timestamps = false;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $table = "prediksi";
    
    protected $fillable = [
        'alpha', 'tanggal', 'prediksi',
    ];
   
}
