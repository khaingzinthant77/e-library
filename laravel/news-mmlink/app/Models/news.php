<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    protected $table='news';
    protected $fillable = ['post_category','title','feature_photo', 'detail_description', 'detail_photo', 'publish_date','status'];
}
