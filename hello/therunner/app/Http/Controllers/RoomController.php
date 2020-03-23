<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $search = $request->search_title;
        if (isset($search)) {
            $lsRoom = \App\Room::where('name', 'like', "%$search%")->paginate(2);
        }
        else{
            $lsRoom = \App\Room::paginate(2);
        }

        return view('admin.room.list')->with(
            [
                'lsRoom' => $lsRoom
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
        return view('admin.room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $request->input('type');
        $name = $request->input('name');
        $image = $request->input('image');
        $description = $request->input('description');
        $level = $request->input('level');
        $price = $request->input('price');
        $address = $request->input('address');
        $hot = $request->input('hot');
        //dd('hello');
        $room = new \App\Room();
        $room->type = $type;
        $room->name = $name;
        $room->description = $description;
        $room->level = $level;
        $room->room_price = $price;
        $room->address = $address;
        dd($request->image);
        if ($request->hasFile('image')) {
            $imgName = time().".".$request->image->extension();
            dd($request->image->extension());
            $request->image->move(public_path('image_upload'), $imgName);
            $cover_path = "image_upload/".$imgName;
            $room->img = $cover_path;
        }
        $room->hot = $hot;

        $room->save();

        $request->session()->flash('success', 'Room added successfully');
        return redirect()->route('room.index');
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
        $room = \App\Room::find($id);
        return view('admin.room.update')->with(
            [
                'room' => $room
            ]
        );
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
        $room = \App\Room::find($id);
        $type = $request->input('type');
        $name = $request->input('name');
        $image = $request->input('image');
        $description = $request->input('description');
        $level = $request->input('level');
        $price = $request->input('price');
        $address = $request->input('address');
        $hot = $request->input('hot');

        $room->type = $type;
        $room->name = $name;
        $room->description = $description;
        $room->level = $level;
        $room->room_price = $price;
        $room->address = $address;
        if ($request->hasFile('image')) {
            $imgName = time().".".$request->image->extension();
            $request->image->move(public_path('image_upload'), $imgName);
            $cover_path = "image_upload/".$imgName;
            $room->img = $cover_path;
        }
        $room->hot = $hot;

        $room->save();

        $request->session()->flash('success', 'Room updated successfully');
        return redirect()->route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $room = \App\Room::find($id);
        $room->delete();
        $request->session()->flash('success', 'Deleted successfully!');
        return redirect()->route("room.index");
    }
}
