<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopupAd extends Model
{
    use HasFactory;

    protected $table='popup_ads';
    protected $fillable = ['popup_img','path','status', 'description','half_or_full'];
}
