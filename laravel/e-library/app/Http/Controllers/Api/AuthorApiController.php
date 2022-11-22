<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Author;
use App\Ebook;

class AuthorApiController extends Controller
{
	public function get_all_author(Request $request)
	{
		$data = new Author();
		if ($request->keyword != null) {
			$data = $data->where('name','like','%'.$request->keyword.'%');
		}


		$data = $data->select('authors.id','authors.name')->orderBy('name','asc')->limit(20)->paginate(20);
		return response(['message'=>"Success",'status'=>1,'authors'=>$data]);
	}

	public function author_detail(Request $request)
	{
		$author_detail = Author::find($request->author_id);

		$latest_book = Ebook::where('author_id',$request->author_id)->latest()->take(5)->get();

		return response(['message'=>"Success",'status'=>1,'detail'=>$author_detail,'book'=>$latest_book]);
	}
}