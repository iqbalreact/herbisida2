<?php
use App\Talenta;


function Talenta($id){

    if ($id == NULL) {
        # code...
        return "-";
    } else {
        $talenta = Talenta::where('id', $id)->first();
        return $talenta->nama_talenta;    

    }


}