<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:category_list|category_create|category_edit|category_delete', ['only' => ['index','store']]);
         $this->middleware('permission:category_create', ['only' => ['create','store']]);
         $this->middleware('permission:category_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category_delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = new Category();

        if ($request->keyword != null) {
            $categories = $categories->where('name','like','%'.$request->keyword.'%');
        }

        $count = $categories->get()->count();

        $categories = $categories->orderBy('created_at','desc')->paginate(10);
        
        return view('backend.bookcategory.index',compact('categories','count'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.bookcategory.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $destination_path = public_path() . '/uploads/category_photo/';

        $cover_photo = "";
        //upload image
        if ($file = $request->file('coverphoto')) {
            $cover_photo = $request->file('coverphoto');
            $ext = '.'.$request->coverphoto->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->coverphoto->getClientOriginalName());
            $file->move($destination_path, $fileName);
            $cover_photo = $fileName;
        }

        $categories = Category::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
            'path'=>'uploads/category_photo/',
            'photo_name'=>$cover_photo,
            'code_no'=>$request->code_no
        ]);
        return redirect()->route('categories.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.bookcategory.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $category = Category::find($id);

        $path = public_path() . '/uploads/category_photo/';

        //author photo
        $category_photo = ($request->coverphoto != '') ? $request->coverphoto : $category->photo_name;
        // dd($category_photo);
        if ($file = $request->file('coverphoto')) {
            $category_photo = $request->file('coverphoto');
            $ext = '.'.$request->coverphoto->getClientOriginalExtension();

            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $category_photo->getClientOriginalName());
            $file->move($path, $fileName);
            $category_photo = $fileName;
        }

        // dd($category_photo);

        $category = $category->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
            'path'=>'uploads/category_photo/',
            'photo_name'=>$category_photo,
            'code_no'=>$request->code_no
        ]);

        return redirect()->route('categories.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
