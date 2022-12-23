<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // dd($request->all());
        // $ratings = Rating::orderby('created_at', 'desc')->paginate(10);
        $from_date = $request->from_date ? date('Y-m-d',strtotime($request->from_date)).' 00:00:00' : date('Y-m-d').' 00:00:00';
        $to_date = $request->to_date ? date('Y-m-d',strtotime($request->to_date)).' 23:59:59' : date('Y-m-d').' 23:59:59';

        $ratings = new Rating();
        if ($request->rating != null) {
            $ratings = $ratings->where('rating_count',$request->rating);
        }

        if ($from_date != null && $to_date != null) {
            $ratings = $ratings->whereBetween('created_at',[$from_date,$to_date]);
        }

        $ratings = $ratings->orderBy('created_at','desc')->paginate(10);

        return view('rating.list',compact('ratings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rating = Rating::find($id)->delete();
        return redirect()->back()->with('success','Success!');
    }
}
