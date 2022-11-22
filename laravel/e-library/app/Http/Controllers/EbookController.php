<?php

namespace App\Http\Controllers;

use App\Ebook;
use App\Author;
use App\Category;

use Illuminate\Http\Request;

class EbookController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ebook_list|ebook_create|ebook_edit|ebook_delete', ['only' => ['index','store']]);
         $this->middleware('permission:ebook_create', ['only' => ['create','store']]);
         $this->middleware('permission:ebook_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:ebook_delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $e_books = new Ebook();

        $e_books = $e_books->leftjoin('authors','authors.id','=','ebooks.author_id')
                            ->leftjoin('categories','categories.id','=','ebooks.cat_id')
                            ->select('ebooks.*','authors.name AS author_name','categories.name AS cat_name');

        if ($request->keyword != null) {
            $e_books  = $e_books->where('name','like','%'.$request->keyword.'%');
        }

        if ($request->author_id != null) {
            $e_books = $e_books->where('author_id',$request->author_id);
        }

        $count = $e_books->get()->count();

        $e_books = $e_books->orderBy('created_at','desc')->paginate(10);
        
        return view('backend.ebook.ebook_list',compact('e_books','count'))->with('i', (request()->input('page', 1) - 1) * 10);
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

        return view('backend.ebook.add',compact('authors','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $size = $request->file("file")->getSize();
        
        $num = $size / 1000000;

        $file_size = round($num,1);
       
        $destination_path = public_path() . '/uploads/coverPhoto/';
        $fiel_path = public_path() . '/uploads/files/';

        $cover_photo = "";
        //upload image
        if ($file = $request->file('coverphoto')) {
            $cover_photo = $request->file('coverphoto');
            $ext = '.'.$request->coverphoto->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->coverphoto->getClientOriginalName());
            $file->move($destination_path, $fileName);
            $cover_photo = $fileName;
        }

        $file_name = "";
        if ($file = $request->file('file')) {
            $file_name = $request->file('file');
            $ext = '.'.$request->file->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->file->getClientOriginalName());
            $file->move($fiel_path, $fileName);
            $file_name = $fileName;
        }

        $e_book = Ebook::create([
            'name'=>$request->name,
            'author_id'=>$request->author_id,
            'cover_path'=>'uploads/coverPhoto/',
            'cover_photo'=>$cover_photo,
            'file_path'=>'uploads/files/',
            'file_name'=>$file_name,
            'remark'=>$request->remark,
            'cat_id'=>$request->cat_id,
            'file_size'=>$file_size." MB",
            'is_feature'=>$request->is_feature,
            'publish_date'=>date('Y-m-d',strtotime($request->publisheddate))
            // 'c_by'=>auth()->user()->name
        ]);

        return redirect()->route('e_books.index')->with('success','Success');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $e_book = new Ebook();
        $e_book = $e_book->leftjoin('authors','authors.id','=','ebooks.author_id')
                        ->leftjoin('categories','categories.id','ebooks.cat_id')
                        ->select('ebooks.*','authors.name AS author_name','categories.name AS cat_name')->find($id);

        return view('backend.ebook.view',compact('e_book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = Author::all();
        $categories = Category::where('status',1)->get();
        $e_book = Ebook::find($id);
        return view('backend.ebook.edit',compact('authors','e_book','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $e_book = Ebook::find($id);

        $destination_path = public_path() . '/uploads/coverPhoto/';
        $fiel_path = public_path() . '/uploads/files/';

        //cover photo
        $coverPhoto = ($request->coverphoto != '') ? $request->coverphoto : $e_book->cover_photo;
        // dd($coverPhoto);
        if ($file = $request->file('coverphoto')) {
            $coverPhoto = $request->file('coverphoto');
            $ext = '.'.$request->coverphoto->getClientOriginalExtension();

            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $coverPhoto->getClientOriginalName());
            $file->move($destination_path, $fileName);
            $coverPhoto = $fileName;
        }

        //file
        $file_pdf = ($request->file != '') ? $request->file : $e_book->file_name;
      
        $file_size = $e_book->file_size;
        
        if ($request->file != '') {

            $size = $request->file("file")->getSize();
        
            $num = $size / 1000000;

            $file_size = round($num,1);
        }


        


        if ($file = $request->file('file')) {
            $file_pdf = $request->file('file');
            $ext = '.'.$request->file->getClientOriginalExtension();

            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $file_pdf->getClientOriginalName());
            $file->move($fiel_path, $fileName);
            $file_pdf = $fileName;
        }

        // dd($coverPhoto);

        $e_book = $e_book->update([
            'name'=>$request->name,
            'author_id'=>$request->author_id,
            'cover_path'=>'uploads/coverPhoto/',
            'cover_photo'=>$coverPhoto,
            'file_path'=>'uploads/files/',
            'file_name'=>$file_pdf,
            'remark'=>$request->remark,
            'cat_id'=>$request->cat_id,
            'is_feature'=>$request->is_feature,
            'file_size'=>$request->file != '' ? $file_size." MB" : $file_size,
            'publish_date'=>date('Y-m-d',strtotime($request->publisheddate))
        ]);

        return redirect()->route('e_books.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $e_book = Ebook::find($id)->delete();
        return redirect()->route('e_books.index')->with('success','Success');
    }
}
