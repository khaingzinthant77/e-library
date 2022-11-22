<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = 'favourites';
    protected $fillable = ['book_id','member_id'];

    public static function list($param){
        $data = new Favourite();


        $data = $data->leftjoin('ebooks','ebooks.id','=','favourites.book_id')->leftjoin('users','users.id','=','favourites.member_id')->leftjoin('authors','authors.id','ebooks.author_id')->leftjoin('categories','categories.id','=','ebooks.cat_id')
            ->select('favourites.id','users.name AS member_name','ebooks.name AS ebook_name','categories.name AS cat_name','authors.name AS author_name');

        if ($param != null) {
            $data = $data->where('book_id',$param);
        }
        return $data;
    }
}
