<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Checkoutmail;
use Illuminate\Support\Facades\Mail;

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
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $today = date('Y/m/d');
            $lsBook = \App\Book::orderBy('created_at', 'desc')->where('book_date', '>=', "$today");
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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     

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
