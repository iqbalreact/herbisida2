<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    //
    //
    protected $primaryKey = 'kode';
     /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "produk";
    protected $fillable = [
        'kode', 'nama', 'deskripsi',
    ];
}
