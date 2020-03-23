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

    public function logical_rooms(Request $request){
        $radio = $request->input('filter');
        if(isset($radio) && $radio!=0) {
            $lsLogical = Room::where([
                ['type', '=', '0'],
                ["level", '=', "$radio"]
            ])->get();
        } else if(isset($radio) && $radio==0){
            $lsLogical = Room::where('type', '0')->get();
        } else{
            $lsLogical = Room::where('type', '0')->get();
        }

        $room_name = 'logic';
        $room_tag = 'Logical thinking';
        
        return view('all_logic_rooms')->with(
            [
                'lsLogical' => $lsLogical,
                'room_name' => $room_name,
                'room_tag' => $room_tag
            ]
        );
    }

    public function horror_rooms(Request $request){
        $radio = $request->input('filter');
        if(isset($radio) && $radio!=0) {
            $lsHorror = Room::where([
                ['type', '=', '1'],
                ["level", '=', "$radio"]
            ])->get();
        } else if(isset($radio) && $radio==0){
            $lsHorror = Room::where('type', '1')->get();
        } else{
            $lsHorror = Room::where('type', '1')->get();
        }
        $room_name = 'horror';
        $room_tag = 'Courage & team work';
        
        return view('all_horror_rooms')->with(
            [
                'lsHorror' => $lsHorror,
                'room_name' => $room_name,
                'room_tag' => $room_tag
            ]
        );
    }

    public function all_rooms(Request $request){
        $radio = $request->input('filter');
        if(isset($radio) && $radio!=0) {
            $ls = Room::where([
                ["level", '=', "$radio"]
            ])->get();
        } else if(isset($radio) && $radio==0){
            $ls = Room::all();
        } else{
            $ls = Room::all();
        }
        $room_name = '';
        $room_tag = 'Can you escape?';

        return view('all_rooms')->with(
            [
                'ls' => $ls,
                'room_name' => $room_name,
                'room_tag' => $room_tag
            ]
        );
    }

    public function room(Request $request){
        $id = $request->id;
        $today = date("Y-m-d");
        $choose_date = $request->input('book_date');
        // if(isset($choose_date)){
        //     $id = $tmp;
        // } else{
        //     $id = $request->id;
        // }
        $room = Room::find($id);
        return view('room')->with(
            [
                'room' => $room,
                'today' => $today,
                'choose_date' => $choose_date,
                'id' => $id
            ]
        );
    }

    public function cancel(Request $request){
        $bookId = $request->input('id');
        return view('cancel')->with(
            [
                'bookId' => $bookId
            ]
        );
    }

    public function cancel_form(Request $request){
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $book = Book::find($id);
        if($book == null){
            $book = Book::withTrashed()->find($id);
            $room = Room::find($book->room_id);
            $request->session()->flash('success', 'Phòng đã được huỷ từ trước!');
        
            return redirect()->action('FrontendController@welcome');
        } elseif($book->customer_name == $name && $book->customer_email == $email){
            $codes = discount_code::all();
            $thiscode = 0;
            foreach($codes as $code){
                if($book->code_name == $code->name){
                    $thiscode = $code;
                    break;
                }
            }
            $room = Room::find($book->room_id);
            //dd($room);
            return view('cancel_form')->with(
                [
                    'id' => $id,
                    'room' => $room,
                    'book' => $book,
                    'thiscode' => $thiscode
                ]
            );
        } else{
            $request->session()->flash('danger', 'Thông tin đặt phòng không chính xác. Vui lòng kiểm tra lại!');
            return redirect()->action('FrontendController@welcome');
        }
        
    }
}
