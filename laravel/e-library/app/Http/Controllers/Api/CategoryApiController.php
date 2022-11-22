<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Ebook;

class CategoryApiController extends Controller
{
	public function get_all_category()
	{
		$categories = Category::where('status',1)->limit(20)->paginate(20);

		return response(['message'=>"Success",'status'=>1,'categories'=>$categories]);
	}

	public function category_book_list(Request $request)
	{
		$books = new Ebook();
		$books = $books->where('cat_id',$request->cat_id)->select('id','name','cover_path','cover_photo');
		if ($request->author_id != null) {
			$books = $books->where('author_id',$request->author_id);
		}

		if ($request->keyword != null) {
			$books = $books->where('ebooks.name','like','%'.$request->keyword.'%');
		}

		$books = $books->limit(20)->paginate(20);
		
		return response(['message'=>"Success",'status'=>1,'books'=>$books]);
	}
}	