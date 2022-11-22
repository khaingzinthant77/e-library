<?php

namespace App\Http\Controllers;

use App\Ebook;
use App\Author;
use App\Category;
use App\Slider;
use App\Rating;
use App\EbookRent;
use App\User;
use App\Favourite;
use App\RequestBook;
use Illuminate\Support\Arr;
use DB;

use Hash;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
	public function index()
	{
		$categories = Category::where('status',1)->get();
		$sliders = Slider::where('status',1)->get();

		$books = new Ebook();

		$feature_books = $books->leftjoin('authors','authors.id','=','ebooks.author_id')->where('is_feature',1)->select('ebooks.id','ebooks.name AS book_name','cover_path','cover_photo','authors.name AS author_name')->latest('ebooks.created_at')->take(5)->get();

		$max_count = Ebook::max('read_count');
		$popular_books = $books->leftjoin('authors','authors.id','=','ebooks.author_id')->where('read_count',$max_count)->select('ebooks.id','ebooks.name','cover_path','cover_photo','authors.name AS author_name','ebooks.is_feature')->latest('ebooks.created_at')->take(5)->get();

		$top_authors = $books->leftjoin('authors','authors.id','=','ebooks.author_id')->where('read_count',$max_count)->select('authors.id','authors.path','authors.photo','authors.name AS author_name','ebooks.is_feature')->take(5)->get();

		// dd($top_authors);
		foreach ($top_authors as $key => $value) {
			$value->total_book = Ebook::where('author_id',$value->id)->get()->count();
		}

		$latest_books = $books->leftjoin('authors','authors.id','=','ebooks.author_id')->select('ebooks.id','ebooks.name','cover_path','cover_photo','authors.name AS author_name','ebooks.is_feature')->latest('ebooks.created_at')->take(5)->get();

		$popular_categories = $books->leftjoin('authors','authors.id','=','ebooks.author_id')->leftjoin('categories','categories.id','=','ebooks.cat_id')->where('read_count',$max_count)->select('categories.id','categories.path','categories.photo_name','categories.name')->take(5)->get();
		// dd($popular_categories);
		foreach ($popular_categories as $key => $value) {
			$value->e_books = $books->leftjoin('authors','authors.id','=','ebooks.author_id')->where('ebooks.cat_id',$value->id)->select('ebooks.id','ebooks.name AS book_name','cover_path','cover_photo','authors.name AS author_name')->latest('ebooks.created_at')->take(5)->get();
		}
		// dd($popular_categories);
		return view('frontend.home',compact('categories','sliders','feature_books','popular_books','top_authors','latest_books','popular_categories'));
	}

	public function category_detail($id)
	{
		// dd($id);
		$categories = Category::where('status',1)->get();
		$e_books = new Ebook();
		$e_books = $e_books->leftjoin('authors','authors.id','=','ebooks.author_id')
							->select('ebooks.id','ebooks.name','ebooks.cover_path','ebooks.cover_photo','ebooks.is_feature','authors.name AS author_name')->where('ebooks.cat_id',$id)->get();
		$cat_name = Category::find($id)->name;
		return view('frontend.category.category_detail',compact('categories','e_books','cat_name'));

	}

	public function category_list_view($id)
	{
		$categories = Category::where('status',1)->get();
		$e_books = new Ebook();
		$e_books = $e_books->leftjoin('authors','authors.id','=','ebooks.author_id')
							->select('ebooks.id','ebooks.name','ebooks.cover_path','ebooks.cover_photo','ebooks.is_feature','authors.name AS author_name','ebooks.remark')->where('ebooks.cat_id',$id)->get();
		$cat_name = Category::find($id)->name;

		return view('frontend.category.category_list',compact('categories','e_books','cat_name'));
	}

	public function ebook_view_detail($id)
	{
		$book_data = new Ebook();
		$book_data = $book_data->leftjoin('categories','categories.id','=','ebooks.cat_id')
								->leftjoin('authors','authors.id','=','ebooks.author_id')
								->select('ebooks.*','categories.name AS cat_name','authors.name AS author_name','authors.id AS author_id','categories.id AS cat_id')->find($id);
		$rating_lists = new Rating();
		$rating_lists = $rating_lists->leftjoin('users','users.id','=','ratings.user_id')
									->select('ratings.rate_count','users.name AS member_name','ratings.created_at')
									->where('ratings.book_id',$id)->get();

		if ($book_data != null) {
			$books = new Ebook();
			$books = $books->leftjoin('authors','authors.id','=','ebooks.author_id')->select('ebooks.id','ebooks.name','ebooks.cover_path','ebooks.cover_photo','authors.name AS author_name')->where('cat_id',$book_data->cat_id)->latest('ebooks.created_at')->take(5)->get();

		}else{
			$books = [];
		}

		$ebook_count = EbookRent::where('ebook_id',$id)->get()->count();
		$member = auth()->user();
		if ($member != null) {
			$favourite = Favourite::where('book_id',$id)->where('member_id',auth()->user()->id)->first();
		}else{
			$favourite = null;
		}
		
		// dd($favourite);
		return view('frontend.ebook.view_detail',compact('book_data','rating_lists','books','ebook_count','favourite'));
	}

	public function ebook_list()
	{
		$categories = Category::where('status',1)->get();
		$e_books = new Ebook();
		$e_books = $e_books->leftjoin('authors','authors.id','=','ebooks.author_id')
							->select('ebooks.*','authors.name AS author_name');

		$count = $e_books->get()->count();

        $e_books = $e_books->orderBy('created_at','desc')->paginate(9);
        
        return view('frontend.ebook.ebook_list',compact('categories','e_books','count'))->with('i', (request()->input('page', 1) - 1) * 9);
		
	}

	public function member_ebooks()
	{
		$e_books = new EbookRent();
		$e_books = $e_books->leftjoin('ebooks','ebooks.id','=','ebook_rents.ebook_id')
							->leftjoin('categories','categories.id','=','ebooks.cat_id')
							->select('ebooks.name','categories.name AS cat_name','ebooks.cover_path','ebooks.cover_photo','ebooks.is_feature','ebook_rents.rent_date')->where('member_id',auth()->user()->id)->orderBy('rent_date','desc')->paginate(10);
		
		return view('frontend.member_home.index',compact('e_books'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	public function edit_profile()
	{
		$member_data = User::find(auth()->user()->id);
		return view('frontend.member_home.profile',compact('member_data'));
	}

	public function update_profile($id,Request $request)
	{
		// dd($request->all());
		$this->validate($request, [
            'name' => 'required',
            'ph_no'=>'required',
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
        
         $user = User::find($id)->update([
            'name'=>$request->name,
            'ph_no'=>$request->ph_no,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
         ]);

        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('edit_profile')
                        ->with('success','User updated successfully');
	}

	public function rent_book($id)
	{
		// dd($id);
		if (auth()->user() == null) {
			return redirect()->route('ebook_view_detail', ['id' => $id])->with('error','Please Login!');
		}else{
			$ebook_rent = EbookRent::create([
				'member_id'=>auth()->user()->id,
				'ebook_id'=>$id,
				'rent_date'=>date('Y-m-d')
			]);
			$read_count = Ebook::find($id)->read_count;
			$count_update =  Ebook::find($id)->update([
				'read_count'=> ++$read_count
			]);

			return redirect()->route('ebook_view_detail', ['id' => $id]);
		}
	}

	public function cat_detail(Request $request)
	{
		// dd($request->keyword);
		
		$categories = Category::where('status',1)->get();
		$e_books = new Ebook();
		$e_books = $e_books->leftjoin('authors','authors.id','=','ebooks.author_id')
							->select('ebooks.id','ebooks.name','ebooks.cover_path','ebooks.cover_photo','ebooks.is_feature','authors.name AS author_name');
		$cat_name = null;
		if ($request->category_id != null) {
			$e_books = $e_books->where('ebooks.cat_id',$request->category_id);
			$cat_name = Category::find($request->category_id)->name;
		}

		if ($request->keyword != null) {
			// dd("Here");
			$e_books = $e_books->where('ebooks.name','like','%'.$request->keyword.'%');
		}
		$e_books = $e_books->get();
		
	
		return view('frontend.category.category_detail',compact('categories','e_books','cat_name'));
	}

	public function author_detail($id)
	{
		// dd($id);
		$authors = Author::find($id);
		$e_books = new Ebook();
		$e_books = $e_books->leftjoin('authors','authors.id','=','ebooks.author_id')->select('ebooks.id','ebooks.cover_path','ebooks.cover_photo','authors.name AS author_name','ebooks.name AS book_name','ebooks.is_feature')->where('ebooks.author_id',$id);

		$count = $e_books->get()->count();
		$e_books = $e_books->paginate(9);
		return view('frontend.author.detail',compact('authors','e_books','count'))->with('i', (request()->input('page', 1) - 1) * 9);

	}

	public function add_ebook_list(Request $request)
	{
		// dd($request->all());
		if ($request->member_id != null) {
			if ($request->fav_id == null) {
				$favourites = Favourite::create([
					'book_id'=>$request->ebook_id,
					'member_id'=>$request->member_id
				]);
				return redirect()->route('ebook_view_detail', ['id' => $request->ebook_id])->with('success','Successfully added to favourite');
			}else{
				
				$favourites = Favourite::find($request->fav_id)->delete();

				return redirect()->route('ebook_view_detail', ['id' => $request->ebook_id])->with('success','Successfully removed from favourite');
			}
		}else{
			return redirect()->route('ebook_view_detail', ['id' => $request->ebook_id])->with('error','Please Login!');
		}
		
	}

	public function favourite_list($id)
	{
		$data = new Favourite();
        $data = $data->leftjoin('ebooks','ebooks.id','=','favourites.book_id')->leftjoin('authors','authors.id','=','ebooks.author_id')->leftjoin('categories','categories.id','=','ebooks.cat_id')
        ->select('favourites.id','authors.name AS author_name','ebooks.name AS ebook_name','ebooks.cover_path','ebooks.cover_photo','categories.name AS cat_name','ebooks.is_feature','favourites.created_at')->where('favourites.member_id',$id);

        $count = $data->get()->count();
		$data = $data->paginate(10);
		return view('frontend.favourite.index',compact('data','count'))->with('i', (request()->input('page', 1) - 1) * 10);
	}

	public function favourite_delete($id)
	{
		// dd($id);
		$favourites = Favourite::find($id)->delete();

		return redirect()->route('favourite_list', ['id' => auth()->user()->id])->with('success','Successfully removed from favourite');
	}

	public function about_us()
	{
		return view('frontend.about');
	}

	public function contact_us()
	{
		return view('frontend.contact');
	}

	public function contact_mail(Request $request)
	{
		// dd($request->subject);
		// $input = $request->all();

		// $details =  array('title'=>$input['subject'],'body'=>$input['message']);

		// dd($details);
		// $details = [
	 //        'title' => $request->subject,
	 //        'body' => $request->message
	 //    ];
	    // dd($details);
   
    	\Mail::to('linndeveloper3@gmail.com')->send(new \App\Mail\ContactMail());

    	return redirect()->route('contact_us')->with('success','Success');
	}

	public function request_book()
	{
		return view('frontend.request_book.create');
	}

	public function create_request_book(Request $request)
	{
		$request_book = RequestBook::create([
			'book_name'=>$request->book_name,
			'author_name'=>$request->author_name,
			'member_id'=>$request->member_id
		]);

		return redirect()->route('request')->with('success','Success');
	}

	public function my_request_list($id)
	{
		$books = new RequestBook();
		$count = $books->get()->count();

		$books = $books->orderBy('created_at','desc')->paginate(10);
        
        return view('frontend.request_book.book_list',compact('books','count'))->with('i', (request()->input('page', 1) - 1) * 10);
	}
}