<?php

namespace App\Http\Controllers;

use App\BookIssue;
use App\User;
use App\PhysicalBook;
use App\Category;
use Illuminate\Http\Request;
use Hashids\Hashids;
use File;
use QrCode;
class BookIssueController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:book_issue_list|book_issue_create|book_issue_edit|book_issue_delete', ['only' => ['index','store']]);
         $this->middleware('permission:book_issue_create', ['only' => ['create','store']]);
         $this->middleware('permission:book_issue_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:book_issue_delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $book_issues = BookIssue::list($request->all());
        $count = $book_issues->get()->count();

        $book_issues = $book_issues->orderBy('created_at','desc')->paginate(10);
        
        return view('backend.bookissue.index',compact('book_issues','count'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = User::where('status',1)->get();
        $books = PhysicalBook::all();
        $categories = Category::where('status',1)->get();
        return view('backend.bookissue.add',compact('members','books','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd("Here");
        $status = BookIssue::store_data($request->all(),$request->return_date);
        if ($status == true) {
            return redirect()->route('bookissue.index')->with('success','Success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookIssue  $bookIssue
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = BookIssue::show_data($id);
        return view('backend.bookissue.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookIssue  $bookIssue
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $members = User::where('status',1)->get();
        $books = PhysicalBook::all();
        $categories = Category::where('status',1)->get();

        $data = BookIssue::show_data($id);
        return view('backend.bookissue.edit',compact('data','members','books','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookIssue  $bookIssue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = BookIssue::update_data($request->all(),$id,$request->return_date);
        if ($status == true) {
            return redirect()->route('bookissue.index')->with('success','Success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookIssue  $bookIssue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book_issues = BookIssue::find($id)->delete();
        return redirect()->route('bookissue.index')->with('success','Success');
    }

    public function renew()
    {
        // code...
    }

    public function qr_generate($id)
    {
        // dd($id);
        $book = PhysicalBook::find($id);
        // dd($book);
        $path = 'qrcode'.$book->code_no.'.png';
        // dd($path);
        $p_book = PhysicalBook::find($id)->update([
            'qr_photo'=>$path
        ]);
        $hashids = new Hashids('', 10); // pad to length 10
        $hashids = $hashids->encodeHex($book->code_no);

        $destinationPath = public_path() . '/uploads/book_qrs/';

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        if (File::exists($destinationPath . 'qrcode.png')) {
            File::delete($destinationPath . 'qrcode.png');
        }


        $qrcode = QrCode::backgroundColor(255, 255, 255)->color(0,0,0)
            ->format('png')->size(300)
            ->generate($hashids, $destinationPath . $path);

        $book = PhysicalBook::find($id);
        $strpath = public_path()."/uploads/book_qrs/".$book->qr_photo;
        // dd($strpath);
        $myFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $newName = $book->name.'.png';


        return response()->download($myFile, $newName, $headers);

        return redirect()->route('physical_books.index') 
            ->with('success', 'QrCode generate  success!.');
    }

    public function downloadQR($id)
    {
        $book = PhysicalBook::find($id);
       $strpath = public_path()."/uploads/book_qrs/".$book->qr_photo;
        // dd($strpath);
        $myFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $newName = $book->name.'.png';


        return response()->download($myFile, $newName, $headers);
    }


}
