<?php

namespace App\Http\Controllers;

use App\PhysicalBook;
use App\Author;
use App\Category;
use App\Rack;
use App\User;
use Illuminate\Http\Request;
use Hashids\Hashids;

class PhysicalBookController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:book_list|book_create|book_edit|book_delete', ['only' => ['index','store']]);
         $this->middleware('permission:book_create', ['only' => ['create','store']]);
         $this->middleware('permission:book_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:book_delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $book_lists = PhysicalBook::list($request->all());

        $count = $book_lists->get()->count();

        $book_lists = $book_lists->orderBy('created_at','desc')->paginate(10);
        
        return view('backend.book.index',compact('book_lists','count'))->with('i', (request()->input('page', 1) - 1) * 10);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::where('status',1)->get();
        $racks = Rack::all();
        return view('backend.book.add',compact('authors','categories','racks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = PhysicalBook::store_data($request->all());
        if ($status == true) {
            return redirect()->route('physical_books.index')->with('success','Success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PhysicalBook  $physicalBook
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = PhysicalBook::show_data($id);

        return view('backend.book.view',compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PhysicalBook  $physicalBook
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = Author::all();
        $categories = Category::where('status',1)->get();
        $racks = Rack::all();
        $physical_book = PhysicalBook::find($id);
        return view('backend.book.edit',compact('authors','categories','racks','physical_book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PhysicalBook  $physicalBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->coverphoto);
        $status = PhysicalBook::update_data($request->all(),$id,$request->coverphoto);

        if ($status == true) {
            return redirect()->route('physical_books.index')->with('success','Success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PhysicalBook  $physicalBook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $physical_book = PhysicalBook::find($id)->delete();
        return redirect()->route('physical_books.index')->with('success','Success');
    }

    public function generate_book_code(Request $request)
    {
        // dd($request->all());
        $book_count = PhysicalBook::where('cat_id',$request->cat_id)->get()->count();
        
        $category_code = Category::find($request->cat_id)->code_no;
       
        $invID = str_pad(++$book_count, 5, '0', STR_PAD_LEFT);
        
        $book_code = $category_code.$invID;
    
        return response()->json($book_code);
    }

    public function get_member_data(Request $request)
    {
        // dd($request->all());
        $hashids = new Hashids('', 10); // pad to length 10
        $member_id = $hashids->decodeHex($request->member_id);
        
        $member = User::find($member_id);
        return response()->json($member);
    }

    public function get_book_data(Request $request)
    {
        $hashids = new Hashids('', 10); // pad to length 10
        $book_id = $hashids->decodeHex($request->book_id);

        $book = new PhysicalBook();
        $book = $book->leftjoin('categories','categories.id','=','physical_books.cat_id')->leftjoin('authors','authors.id','=','physical_books.author_id')->leftjoin('racks','racks.id','=','physical_books.rack_id')->select('physical_books.id','physical_books.name','categories.name AS cat_name','authors.name AS author_name','racks.name AS rack_name','categories.id AS cat_id','physical_books.id AS book_id','physical_books.read_day')->find($book_id);
        return response()->json($book);
    }
}
