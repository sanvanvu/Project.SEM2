<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    //
    use SoftDeletes;
    protected $date = ['deleted_at'];

    public function book(){
        return $this->hasMany('\App\Book');
      }
}
