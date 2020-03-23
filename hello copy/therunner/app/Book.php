<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends Model
{
    use SoftDeletes;
    protected $date = ['deleted_at'];

    public function room(){
        return $this->belongsTo('\App\Room');
    }
}
