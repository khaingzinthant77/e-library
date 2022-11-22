<?php

namespace App\Http\Controllers;

use App\RequestBook;
use Illuminate\Http\Request;

class RequestBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request_books = RequestBook::list($request->all());
        $count = $request_books->get()->count();
        $request_books = $request_books->orderBy('request_books.created_at','desc')->paginate(10);
        return view('backend.request_book.index',compact('request_books'))->with('i',(request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
     * @param  \App\RequestBook  $requestBook
     * @return \Illuminate\Http\Response
     */
    public function show(RequestBook $requestBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestBook  $requestBook
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestBook $requestBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestBook  $requestBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestBook $requestBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestBook  $requestBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestBook $requestBook)
    {
        //
    }
}
