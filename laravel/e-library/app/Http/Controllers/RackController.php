<?php

namespace App\Http\Controllers;

use App\Rack;
use Illuminate\Http\Request;

class RackController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:rack_list|rack_create|rack_edit|rack_delete', ['only' => ['index','store']]);
         $this->middleware('permission:rack_create', ['only' => ['create','store']]);
         $this->middleware('permission:rack_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:rack_delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Rack::list($request->all());

        $count = $list->get()->count();
        
        $list = $list->orderBy('created_at','desc')->paginate(10);
        
        return view('backend.rack.index',compact('list','count'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.rack.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = Rack::store($request->all());

        if ($status == true) {
            return redirect()->route('rack.index')->with('success','Success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rack  $rack
     * @return \Illuminate\Http\Response
     */
    public function show(Rack $rack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rack  $rack
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rack = Rack::find($id);
        return view('backend.rack.edit',compact('rack'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rack  $rack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = Rack::update_data($request->all(),$id);

        if ($status == true) {
            return redirect()->route('rack.index')->with('success','Success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rack  $rack
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rack = Rack::find($id)->delete();
        return redirect()->route('rack.index')->with('success','Success');
    }
}
