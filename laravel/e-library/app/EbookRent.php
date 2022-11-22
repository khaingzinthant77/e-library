<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EbookRent extends Model
{
    protected $table = 'ebook_rents';
    protected $fillable = ['member_id','ebook_id','rent_date'];

    public function member()
    {
        return $this->hasOne('App\User','id','member_id');
    }

    public function ebook()
    {
        return $this->hasOne('App\Ebook','id','ebook_id');
    }

    public static function list($param)
    {
        $data = new EbookRent();
        $data = $data->leftjoin('users','users.id','=','ebook_rents.member_id')
                    ->leftjoin('ebooks','ebooks.id','=','ebook_rents.ebook_id')
                    ->leftjoin('categories','categories.id','=','ebooks.cat_id')
                    ->select('users.name AS member_name','categories.name AS cat_name','ebooks.name AS book_name','ebook_rents.rent_date');

        return $data;
    }
}
