<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:author_list|author_create|author_edit|author_delete', ['only' => ['index','store']]);
         $this->middleware('permission:author_create', ['only' => ['create','store']]);
         $this->middleware('permission:author_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:author_delete', ['only' => ['destroy']]);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $authors = new Author();

        if ($request->keyword != null) {
            $authors = $authors->where('name','like','%'.$request->keyword.'%');
        }
        // dd($authors->get());
        $count = $authors->get()->count();

        $authors = $authors->orderBy('created_at','desc')->paginate(10);
        
        return view('backend.author.index',compact('authors','count'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.author.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $destination_path = public_path() . '/uploads/authorPhoto/';

        $author_photo = "";
        //upload image
        if ($file = $request->file('photo')) {
            $author_photo = $request->file('photo');
            $ext = '.'.$request->photo->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->photo->getClientOriginalName());
            $file->move($destination_path, $fileName);
            $author_photo = $fileName;
        }

        $author = Author::create([
            'name'=>$request->name,
            'dob'=>date('Y-m-d',strtotime($request->dateofbirth)),
            'gender'=>$request->gender,
            'personal_data'=>$request->p_data,
            'path'=>$author_photo ? 'uploads/authorPhoto/' : null,
            'photo'=>$author_photo
        ]);

        return redirect()->route('authors.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);

        return view('backend.author.detail',compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);
        return view('backend.author.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        
        $author = Author::find($id);

        $path = public_path() . '/uploads/authorPhoto/';

        //author photo
        $authorPhoto = ($request->photo != '') ? $request->photo : $author->photo;
        // dd($authorPhoto);
        if ($file = $request->file('photo')) {
            $authorPhoto = $request->file('photo');
            $ext = '.'.$request->photo->getClientOriginalExtension();

            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $authorPhoto->getClientOriginalName());
            $file->move($path, $fileName);
            $authorPhoto = $fileName;
        }

        $author = $author->update([
            'name'=>$request->name,
            'dob'=>date('Y-m-d',strtotime($request->dateofbirth)),
            'gender'=>$request->gender,
            'personal_data'=>$request->p_data,
            'path'=>$authorPhoto ? 'uploads/authorPhoto/' : null,
            'photo'=>$authorPhoto
        ]);

        return redirect()->route('authors.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id)->delete();
        return redirect()->route('authors.index')->with('success','Success');
    }
}
