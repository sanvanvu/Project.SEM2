<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $search = $request->search_title;

        $lsBook =\App\Book::withTrashed()->orderBy('created_at', 'desc')->paginate(5);

        if(isset($filter) && $filter==0){
            //dd($lsBook);
            $lsBook = \App\Book::orderBy('created_at', 'desc');
            $lsBook = $lsBook->paginate($lsBook->count());
            // if(!isset($search)){
                
            // } else{
            //     $lsBook = $lsBook->orderBy('created_at', 'desc')->where('customer_name', 'like', "%$search%");
            //     $lsBook = $lsBook->paginate($lsBook->count());
            // }
        } elseif(isset($filter) && $filter==1){ 
            $lsBook = \App\Book::onlyTrashed()->orderBy('created_at', 'desc');
            $lsBook = $lsBook->paginate($lsBook->count());
            // if(!isset($search)){
                
            // } else{
            //     $lsBook = $lsBook->orderBy('created_at', 'desc')->where('customer_name', 'like', "%$search%");
            //     $lsBook = $lsBook->paginate($lsBook->count());
            // }
        } elseif(isset($filter) && $filter==2){
            $lsBook = \App\Book::withTrashed()->orderBy('created_at', 'desc');
            $lsBook = $lsBook->paginate(5);
            // if(!isset($search)){
                
            // } else{
            //     $lsBook = $lsBook->orderBy('created_at', 'desc')->where('customer_name', 'like', "%$search%");
            //     $lsBook = $lsBook->paginate($lsBook->count());
            // }
        } elseif(isset($search)){
            $lsBook = \App\Book::withTrashed()->orderBy('created_at', 'desc')->where('customer_name', 'like', "%$search%");
            $lsBook = $lsBook->paginate($lsBook->count());
        }
       
        $lsRoom = \App\Room::all();

        return view('admin.book_info.list')->with(
            [
                'lsBook' => $lsBook,
                'lsRoom' => $lsRoom,
                'search' => $search
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $mydate = $request->book_date;
        $lsRoom = \App\Room::all();
        $room = \App\Room::find($id);
        $lsBook = \App\Book::all();
        $lsTime = \App\Time_list::all();
        $check = 0;

        $lsCode = \App\discount_code::select('name')->get();

        return view('book')->with(
            [
                'lsBook' => $lsBook,
                'room' => $room,
                'lsRoom' => $lsRoom,
                'lsTime' => $lsTime,
                'mydate' => $mydate,
                'id' => $id,
                'lsCode' => $lsCode,
                'check' => $check
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $lsRoom = \App\Room::all();
        $room = \App\Room::find($roomId);

        $lsCode = \App\discount_code::all();
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
            $code = \App\discount_code::find($codeId);
            if($code->type == 1){
                $price = $room->room_price*$numbers*(100-$code->value)/100*1000;
            } else if($code->type == 0){
                $price = ($room->room_price*$numbers - $code->value)*1000;
            }
        }

        $book = new \App\Book();
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
        $thisBook = \App\Book::find($book->id);
        
        // return redirect()->action('BookController@check_out', [$thisBook->id]);
        return redirect('checkout.html?id='.$thisBook->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function check_out(Request $request){
        $id = $request->id;
        $thisBook = \App\Book::find($id);
        $room = \App\Room::find($thisBook->room_id);
        $codes = \App\discount_code::all();
        $thiscode = 0;
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

    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $book = \App\Book::find($id);
        if($book == null){
            $book = \App\Book::withTrashed()->find($id);
            $room = \App\Room::find($book->room_id);
            $request->session()->flash('success', 'Phòng đã được huỷ từ trước!');
        
            return redirect()->action('FrontendController@welcome');
        }
        $book->delete();
        $request->session()->flash('success', 'Huỷ đặt phòng thành công!');
        
        return redirect()->action('FrontendController@welcome');
           
    }

}
