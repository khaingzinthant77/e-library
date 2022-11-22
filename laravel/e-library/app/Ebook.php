<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $table = 'ebooks';
    protected $fillable = ['name','cat_id','author_id','cover_path','cover_photo','file_path','file_name','remark','c_by','u_by','rating_count','rating_user','file_size','read_count','is_feature','publish_date'];

    public function authors()
    {
        return $this->hasOne('App\Author','id','author_id');
    }

    public function category()
    {
        return $this->hasOne('App\Category','id','cat_id');
    }
}
