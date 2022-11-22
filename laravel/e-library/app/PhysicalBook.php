<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhysicalBook extends Model
{
    protected $table = 'physical_books';

    protected $fillable = ['name','author_id','qty','price','code_no','path','cover_photo','cat_id','book_no','rack_id','edition_number','edition_date','publisher','publish_date','book_expire','qr_photo','rent_count','read_day'];

    public function author()
    {
        return $this->hasOne('App\Author','id','author_id');
    }

    public static function list($param)
    {
        $list = new PhysicalBook();
        $list = $list->leftjoin('authors','authors.id','=','physical_books.author_id')
                    ->leftjoin('categories','categories.id','=','physical_books.cat_id')
                    ->select('physical_books.*','authors.name AS author_name','categories.name AS cat_name');

        return $list;
    }

    public static function store_data($param)
    {
        // dd($cover_photo);
        $destination_path = public_path() . '/uploads/coverPhoto/';
        
        $cover_photo = "";
        //upload image
        if ($file = $param['coverphoto']) {
            $cover_photo = $param['coverphoto'];
            $ext = '.'.$param['coverphoto']->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $param['coverphoto']->getClientOriginalName());
            $file->move($destination_path, $fileName);
            $cover_photo = $fileName;
        }

        $p_book = PhysicalBook::create([
            'name'=>$param['name'],
            'author_id'=>$param['author_id'],
            'qty'=>$param['quantity'],
            'price'=>$param['price'],
            'code_no'=>$param['codeno'],
            'path'=>'uploads/coverPhoto/',
            'cover_photo'=>$cover_photo,
            'cat_id'=>$param['cat_id'],
            'rack_id'=>$param['rack_id'],
            'edition_number'=>$param['editionnumber'],
            'edition_date'=>date('Y-m-d',strtotime($param['editiondate'])),
            'publisher'=>$param['publisher'],
            'publish_date'=>date('Y-m-d',strtotime($param['publisheddate'])),
            'read_day'=>$param['read_day']
        ]);

        return $p_book;
    }

    public static function show_data($id)
    {
        $data = new PhysicalBook();
        $data = $data->leftjoin('authors','authors.id','=','physical_books.author_id')
                    ->leftjoin('categories','categories.id','=','physical_books.cat_id')
                    ->leftjoin('racks','racks.id','=','physical_books.rack_id')
                    ->select('physical_books.*','authors.name AS author_name','categories.name AS cat_name','racks.name AS rack_name')->find($id);
        return $data;
    }

    public static function update_data($param,$id,$cover_photo)
    {
        // dd($cover_photo);
        $data = PhysicalBook::find($id);

        $destination_path = public_path() . '/uploads/coverPhoto/';
        
        //cover photo
        $coverPhoto = ($cover_photo != '') ? $cover_photo : $data->cover_photo;
        // dd($coverPhoto);
        if ($file = $cover_photo) {
            $coverPhoto = $cover_photo;
            $ext = '.'.$cover_photo->getClientOriginalExtension();

            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $coverPhoto->getClientOriginalName());
            $file->move($destination_path, $fileName);
            $coverPhoto = $fileName;
        }
        // dd($coverPhoto);
        $data = $data->update([
            'name'=>$param['name'],
            'author_id'=>$param['author_id'],
            'qty'=>$param['quantity'],
            'price'=>$param['price'],
            'code_no'=>$param['codeno'],
            'path'=>'uploads/coverPhoto/',
            'cover_photo'=>$coverPhoto,
            'cat_id'=>$param['cat_id'],
            'rack_id'=>$param['rack_id'],
            'edition_number'=>$param['editionnumber'],
            'edition_date'=>date('Y-m-d',strtotime($param['editiondate'])),
            'publisher'=>$param['publisher'],
            'publish_date'=>date('Y-m-d',strtotime($param['publisheddate'])),
            'read_day'=>$param['read_day']
        ]);

        return $data;
    }

    
}
