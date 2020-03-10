<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Room;
use \App\discount_code;
use \App\Book;

class frontendController extends Controller
{
    public function welcome(){
        $lsLogical = Room::where('type', '0')->orderBy('created_at', 'desc')->take(3)->get();
        $lsHorror = Room::where('type', '1')->orderBy('created_at', 'desc')->take(2)->get();
        return view('welcome')->with(
            [
                'lsLogical' => $lsLogical,
                'lsHorror' => $lsHorror
            ]
        );
    }
}
