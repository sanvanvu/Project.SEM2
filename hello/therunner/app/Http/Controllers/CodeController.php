<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodeController extends Controller
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
            $lsCode = \App\discount_code::where('name', 'like', "%$search%")->paginate(2);
        }
        else{
            $lsCode = \App\discount_code::paginate(2);
        }

        return view('admin.discount_code.list')->with(
            [
                'lsCode' => $lsCode
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
        return view('admin.discount_code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $type = $request->input('type');
        $value = $request->input('value');
        $status = $request->input('status');

        $code = new \App\discount_code();
        $code->name = $name;
        $code->type = $type;
        $code->value = $value;
        $code->status = $status;

        $code->save();
        $request->session()->flash('success', 'Discount-code added successfully');
        return redirect()->route('discount_code.index');
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
        $code = \App\discount_code::find($id);
        return view('admin.discount_code.update')->with(
            [
                'code' => $code
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
        $name = $request->input('name');
        $type = $request->input('type');
        $value = $request->input('value');
        $status = $request->input('status');

        $code = \App\discount_code::find($id);
        $code->name = $name;
        $code->type = $type;
        $code->value = $value;
        $code->status = $status;

        $code->save();
        $request->session()->flash('success', 'Discount-code updated successfully');
        return redirect()->route('discount_code.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $code = \App\discount_code::find($id);
        $code->delete();
        $request->session()->flash('success', 'Deleted successfully!');
        return redirect()->route("discount_code.index");
    }
}
