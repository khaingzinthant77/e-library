<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Ebook;
use App\Rating;
use App\EbookRent;
use App\Slider;
use App\Favourite;
use App\RequestBook;

use Validator;

class BookApiController extends Controller
{
	public function book_detail(Request $request)
	{
		$book_detail = new Ebook();
		$book_detail = $book_detail->leftjoin('authors','authors.id','=','ebooks.author_id')
									->leftjoin('categories','categories.id','=','ebooks.cat_id')
									->select('ebooks.id','ebooks.name','authors.name AS author_name','ebooks.remark','ebooks.cover_path','ebooks.cover_photo','ebooks.file_path','ebooks.file_name','ebooks.file_size','ebooks.rating_count','ebooks.rating_user','categories.id AS cat_id')->find($request->book_id);

		$rating = Rating::where('book_id',$request->book_id)->where('user_id',$request->user_id)->first();
		$favourite = Favourite::where('book_id',$request->book_id)->where('member_id',$request->user_id)->first();

		$ebook_rent = EbookRent::where('member_id',$request->user_id)->where('ebook_id',$request->book_id)->get()->count();
		if ($ebook_rent == 0) {
			$status = 0;
		}else{
			$status = 1;
		}

		if ($book_detail != null) {
			$books = new Ebook();
			$books = $books->select('id','name','cover_path','cover_photo')->where('cat_id',$book_detail->cat_id)->latest()->take(5)->get();

		}else{
			$books = [];
		}

		if ($favourite != null) {
			$fav_id = $favourite->id;
		}else{
			$fav_id = null;
		}

		return response(['message'=>"Success",'status'=>1,'book_detail'=>$book_detail,'rating'=>$rating,'books'=>$books,'rent_status'=>$status,'fav_id'=>$fav_id]);
	}

	public function book_rating(Request $request)
	{
		$rating = Rating::create([
			'book_id'=>$request->book_id,
			'rate_count'=>$request->rating_count,
			'user_id'=>$request->user_id
		]);

		$count = Rating::where('book_id',$request->book_id)->get()->count();

		$ratings = Rating::where('book_id',$request->book_id)->get();

		$sum = 0;

		foreach ($ratings as $key => $value) {
			// dd($value);
			$sum = $sum + ($value->rate_count * $value->rate_count);
			// dd($sum);
		}

		$avg = $sum / (5 * $count);

		$e_book = Ebook::find($request->book_id)->update([
			'rating_user'=>$count,
			'rating_count'=>round($avg,1)
		]);

		return response(['message'=>"Success",'status'=>1,'rating_user'=>$count,'rating'=>round($avg)]);
	}

	public function ebook_rent(Request $request)
	{
		$ebook_rent = EbookRent::create([
			'member_id'=>$request->member_id,
			'ebook_id'=>$request->ebook_id,
			'rent_date'=>date('Y-m-d',strtotime($request->rent_date))
		]);
		$read_count = Ebook::find($request->ebook_id)->read_count;
		$count_update =  Ebook::find($request->ebook_id)->update([
			'read_count'=> ++$read_count
		]);

		return response(['message'=>"Success",'status'=>1]);
	}

	public function my_book(Request $request)
	{
		$books = new EbookRent();
		

		$books = $books->leftjoin('ebooks','ebooks.id','=','ebook_rents.ebook_id')
						->leftjoin('authors','authors.id','=','ebooks.author_id')
						->select('ebooks.id','ebooks.name','cover_path','cover_photo','file_path','file_name','authors.name AS author_name');
						
		if ($request->keyword != null) {
			// dd("Here");
			$books = $books->where('ebooks.name','like','%'.$request->keyword.'%');
		}

		$books = $books->where('member_id',$request->member_id)->limit(20)->paginate(20);

		return response(['message'=>"Success",'status'=>1,'books'=>$books]);
	}

	public function home()
	{
		$sliders = Slider::where('status',1)->get();
		$books = new Ebook();
		// 
		$feature_books = $books->where('is_feature',1)->select('id','name','cover_path','cover_photo')->latest()->take(5)->get();
		$max_count = Ebook::max('read_count');
		$popular_books = $books->where('read_count',$max_count)->select('id','name','cover_path','cover_photo')->latest()->take(5)->get();
		$latest_books = $books->select('id','name','cover_path','cover_photo')->latest('publish_date')->take(5)->get();

		return response(['message'=>"Success",'status'=>1,'sliders'=>$sliders,'feature_books'=>$feature_books,'popular_books'=>$popular_books,'latest_books'=>$latest_books]);
	}

	public function author_book(Request $request)
	{
		$books = new Ebook();

		$books = $books->select('id','name','cover_path','cover_photo')->where('author_id',$request->author_id);

		if ($request->cat_id != null) {
			$books = $books->where('cat_id',$request->cat_id);
		}

		if ($request->keyword != null) {
			$books = $books->where('name','like','%'.$request->keyword.'%');
		}

		$books = $books->limit(20)->paginate(20);

		return response(['message'=>"Success",'status'=>1,'books'=>$books]);
	}

	public function home_book_list(Request $request)
	{
		$books = new Ebook();

		if ($request->status == 1) {
			$books = $books->where('is_feature',1)->select('id','name','cover_path','cover_photo');		
		}elseif ($request->status == 2) {
			$max_count = Ebook::max('read_count');
			$books = $books->where('read_count',$max_count)->select('id','name','cover_path','cover_photo');
		}elseif ($request->status == 3) {
			$books = $books->select('id','name','cover_path','cover_photo')->latest('publish_date');
		}

		if ($request->author_id != null) {
			$books = $books->where('author_id',$request->author_id);
		}

		if ($request->cat_id != null) {
			$books = $books->where('cat_id',$request->cat_id);
		}
		$books = $books->limit(20)->paginate(20);

		return response(['message'=>"Success",'status'=>1,'books'=>$books]);
	}

	public function add_favourite(Request $request)
	{
		if ($request->fav_id == null) {
			$favourites = Favourite::create([
				'book_id'=>$request->book_id,
				'member_id'=>$request->member_id
			]);
			return response(['message'=>"Successfully added to favourite",'status'=>1]);
		}else{
			
			$favourites = Favourite::find($request->fav_id)->delete();

			return response(['message'=>"Successfully removed from favourite",'status'=>1]);
		}
		
	}

	public function favourite_list(Request $request)
	{
		$data = new Favourite();
        $data = $data->leftjoin('ebooks','ebooks.id','=','favourites.book_id')->leftjoin('users','users.id','=','favourites.member_id')
        ->select('ebooks.id','users.name AS member_name','ebooks.name AS ebook_name','ebooks.cover_path','ebooks.cover_photo')->where('favourites.member_id',$request->member_id)->limit(10)->paginate(20);

        return response(['message'=>"Success",'status'=>1,'list'=>$data]);
	}

	public function all_books(Request $request)
	{
		$books = new Ebook();
		$books = $books->leftjoin('authors','authors.id','=','ebooks.author_id')->select('ebooks.id','ebooks.name AS book_name','authors.name AS author_name','ebooks.cover_path','ebooks.cover_photo','ebooks.remark');

		if ($request->keyword != null) {
			$books = $books->where('ebooks.name','like','%'.$request->keyword.'%');
		}
		
		$books = $books->limit(20)->paginate(20);
		return response(['message'=>"Success",'status'=>1,'list'=>$books]);
	}

	public function request_book(Request $request)
	{
		$input = $request->all();
	    $rules=[
	    	'book_name'=>'required',
            'member_id'=>'required'
	    ];
          $validator = Validator::make($input, $rules);
          $response = array('response' => '', 'success'=>false);
           if ($validator->fails()) {
              $messages = $validator->messages();
               $messages = $validator->messages();
               return response(['message'=>$validator->messages()->first(),'status'=>0]);
          }else{
	          	$data = RequestBook::create([
				'book_name'=>$request->book_name,
				'author_name'=>$request->author_name,
				'member_id'=>$request->member_id
			]);
          }
		return response(['message'=>"Success",'status'=>1]);
	}

	public function request_book_list(Request $request)
	{
		$input = $request->all();
	    $rules=[
            'member_id'=>'required'
	    ];
          $validator = Validator::make($input, $rules);
          $response = array('response' => '', 'success'=>false);
           if ($validator->fails()) {
            $messages = $validator->messages();
            return response(['message'=>$validator->messages()->first(),'status'=>0]);
          }else{
	          	
	          	$books = new RequestBook();
	          	$books = $books->leftjoin('users','users.id','=','request_books.member_id')->select('request_books.book_name','request_books.author_name')->limit(20)->paginate(20);
          }
		return response(['message'=>"Success",'status'=>1,'list'=>$books]);
	}
}