<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelayan extends Model
{
    //
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

    protected $table = "pelayan";
    protected $fillable = [
        'nama', 'no_hp', 'talenta_id', 'tempat_lahir', 'tanggal_lahir', 'alamat'
        
    ];
}
