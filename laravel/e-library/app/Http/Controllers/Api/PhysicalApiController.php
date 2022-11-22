<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\BookIssue;
use App\Rating;
use App\Ebook;
use App\Slider;
use App\PhysicalBook;
use Hashids\Hashids;

class PhysicalApiController extends Controller
{
	public function physical_rent_list(Request $request)
	{
		$rent_list = new BookIssue();
		$rent_list = $rent_list->leftjoin('physical_books','physical_books.id','=','book_issues.book_id')->leftjoin('categories','categories.id','book_issues.cat_id')->leftjoin('authors','authors.id','=','physical_books.author_id')->select('physical_books.name','categories.name AS cat_name','authors.name AS author_name','physical_books.code_no','physical_books.path','physical_books.cover_photo','book_issues.issue_date','physical_books.price','book_issues.rent_expire')->where('book_issues.member_id',$request->member_id)->limit(20)->paginate(20);

		return response(['message'=>"Success",'status'=>1,'rent_list'=>$rent_list]);
	}

	public function physical_book_rent(Request $request)
	{
		$hashids = new Hashids('', 10); // pad to length 10
      	$p_id = $hashids->decodeHex($request->p_book_id);
      	$member_id = $hashids->decodeHex($request->member_id);

		$p_book = Ebook::find($p_id);
		// dd($p_book);
		$p_book_rent = BookIssue::create([
			'member_id'=>$member_id,
			'book_id'=>$p_id,
			'cat_id'=>$p_book->cat_id,
			'code_no'=>$p_book->code_no,
			'issue_date'=>date('Y-m-d')
		]);

		return response(['message'=>"Success",'status'=>1]);
	}

	public function p_book_detail(Request $request)
	{
		$hashids = new Hashids('', 10); // pad to length 10
      	$p_id = $hashids->decodeHex($request->book_id);
      	$book = new PhysicalBook();
      	$book = $book->leftjoin('authors','authors.id','=','physical_books.author_id')->select('physical_books.name','physical_books.path','physical_books.cover_photo','authors.name AS author_name','physical_books.read_day AS duration','physical_books.price')->find($p_id);

      	return response(['message'=>"Success",'status'=>1,'book_data'=>$book]);
	}
}