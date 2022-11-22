<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestBook extends Model
{
    protected $table = 'request_books';
    protected $fillable = ['book_name','author_name','member_id'];

    public static function list($param)
    {
        $data = new RequestBook();
        $data = $data->leftjoin('users','users.id','=','request_books.member_id')->select('request_books.book_name','request_books.author_name','users.name AS member_name');

        return $data;
    }
}
