<?php

namespace App\Http\Controllers;

use App\EbookRent;
use Illuminate\Http\Request;

class EbookRentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ebook_rents = EbookRent::list($request->all());
        $count = $ebook_rents->get()->count();

        $ebook_rents = $ebook_rents->orderBy('ebook_rents.created_at','desc')->paginate(10);
        
        return view('backend.ebook_rent.index',compact('ebook_rents','count'))->with('i', (request()->input('page', 1) - 1) * 10);

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
     * @param  \App\EbookRent  $ebookRent
     * @return \Illuminate\Http\Response
     */
    public function show(EbookRent $ebookRent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EbookRent  $ebookRent
     * @return \Illuminate\Http\Response
     */
    public function edit(EbookRent $ebookRent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EbookRent  $ebookRent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EbookRent $ebookRent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EbookRent  $ebookRent
     * @return \Illuminate\Http\Response
     */
    public function destroy(EbookRent $ebookRent)
    {
        //
    }
}
