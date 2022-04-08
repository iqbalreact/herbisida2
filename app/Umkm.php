<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
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

    protected $table = "umkm";
    protected $fillable = [
        'nama', 'pemilik', 'alamat', 'deskripsi',
    ];
}
