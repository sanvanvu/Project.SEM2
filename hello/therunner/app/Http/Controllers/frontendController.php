<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Room;
use \App\discount_code;
use \App\Book;
use App\Mail\Checkoutmail;
use Illuminate\Support\Facades\Mail;

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
        $check = false;
        foreach(Book::all() as $book){
            if($book->id == $id){
                $check = true;
                break;
            }
        }

        if($check == false){
            $request->session()->flash('danger', 'Mã phòng không hợp lệ. ');
            return redirect()->action('frontendController@welcome');
        }

        $book = Book::find($id);
        // dd($book);
        if($book == null){
            $request->session()->flash('success', 'Phòng đã được huỷ từ trước hoặc thông tin không hợp lệ. ');

            return redirect()->action('frontendController@welcome');
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
            // dd($room);
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
            return redirect()->action('frontendController@welcome');
        }

    }

    public function store(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $numbers = $request->numbers;
        $roomId = $request->room_id;
        $bookDate = $request->book_date;
        $bookTime = $request->book_time;
        $codeName = $request->code;
        $lsRoom = Room::all();
        $room = Room::find($roomId);

        $lsCode = discount_code::all();
        $price = 0;
        $check = false;
        foreach($lsCode as $code){
            if($codeName==$code->name && $code->status==0){
                $check = true;
                $codeId = $code->id;
                break;
            }
        }

        if($check == false){
            $price = $room->room_price*$numbers*1000;
        } else {
            $code = discount_code::find($codeId);
            if($code->type == 1){
                $price = $room->room_price*$numbers*(100-$code->value)/100*1000;
            } else if($code->type == 0){
                $price = ($room->room_price*$numbers - $code->value)*1000;
            }
        }

        $book = new Book();
        $book->customer_name = $name;
        $book->customer_email = $email;
        $book->phone_number = $phone;
        $book->number_of_customers = $numbers;
        $book->room_id = $roomId;
        $book->book_date = $bookDate;
        $book->book_time = $bookTime;

        $book->price = $price;
        $book->code_name = $codeName;

        $book -> save();
        if($check = false){
            $request->session()->flash('success', 'Đặt phòng thành công, mã giảm giá ko hợp lệ');
        } else{
            $request->session()->flash('success', 'Đặt phòng thành công');
        }
        $thisBook = Book::find($book->id);
        $bookSeri = serialize($thisBook->id);
        //dd($bookSeri);
        Mail::to($thisBook->customer_email)->send(new Checkoutmail($thisBook));
        // return redirect()->action('BookController@check_out', [$thisBook->id]);
        return redirect('checkout.html?id='.$bookSeri);
    }

    public function check_out(Request $request){
        $id = unserialize($request->id);
        $thisBook = Book::find($id);
        $room = Room::find($thisBook->room_id);
        $codes = discount_code::all();
        $thiscode = null;
        foreach($codes as $code){
            if($thisBook->code_name == $code->name){
                $thiscode = $code;
                break;
            }
        }
        //dd($thiscode->name);
        return view('checkout')->with(
            [
                'thisBook' => $thisBook,
                'room' => $room,
                'thiscode' => $thiscode
            ]
        );
    }

    public function destroy($id, Request $request)
    {
        $book = \App\Book::find($id);
        if ($book == null) {
            $book = \App\Book::withTrashed()->find($id);
            $room = \App\Room::find($book->room_id);
            $request->session()->flash('success', 'Phòng đã được huỷ từ trước!');

            return redirect()->action('frontendController@welcome');
        }
        $book->delete();
        $request->session()->flash('success', 'Huỷ đặt phòng thành công!');

        return redirect()->action('frontendController@welcome');
    }
}
