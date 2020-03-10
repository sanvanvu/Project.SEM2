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
        $search = $request->search_title;
        if (isset($search)) {
            $lsBook = \App\Book::where('name', 'like', "%$search%")->paginate(10);
        }
        else{
            $lsBook = \App\Book::paginate(10);
        }

        return view('admin.book_info.list')->with(
            [
                'lsBook' => $lsBook
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lsBook = \App\book::All();
        return view('admin.book_info.create')->with(
            [
                'lsBook' => $lsBook
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
        $roomId = $request->roomId;
        $bookDate = $request->book_date;
        $bookTime = $request->book_time;
        $codeName = $request->code_name;
        $price = $request->price;
        $status = $request->status;

        $book = new \App\Book();
        $book->customer_name = $name;
        $book->customer_email = $email;
        $book->phone_number = $phone;
        $book->number_of_customers = $numbers;
        $book->room_id = $roomId;
        $book->book_date = $bookDate;
        $book->book_time = $bookTime;
        $book->status = $status;
        $book->price = $price;
        $book->code_name = $codeName;

        $book -> save();
        $request->session()->flash('success', 'Room booked successfully');
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
