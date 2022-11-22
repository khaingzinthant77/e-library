<?php
namespace App\Helper; 
use App\Category;
use App\Ebook;

class Helpers{

  public static function getCategory(){
     $categories = Category::where('status',1)->get();
     return $categories;
  }

  public static function popular_category(){
    $max_count = Ebook::max('read_count');
    $books = new Ebook();
    $popular_books = $books->leftjoin('categories','categories.id','=','ebooks.cat_id')
                            ->select('categories.id','categories.name AS cat_name')->where('read_count',$max_count)->get();
    return $popular_books;
    // where('read_count',$max_count)->select('id','name','cover_path','cover_photo')->latest()->take(5)->get();
  }
  
}