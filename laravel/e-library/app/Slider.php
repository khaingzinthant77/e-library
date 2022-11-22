<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $fillable = ['title','path','photo','status'];
    
    public static function list($param)
    {
        $data = new Slider();

        if (count($param)>0) {
            if ($param['keyword'] != null) {
                $data = $data->where('title','like','%'.$param['keyword'].'%');
            }
        }

        return $data;
    }

    public static function store_data($param)
    {
        $destination_path = public_path() . '/uploads/sliders/';

        $slider_photo = "";
        //upload image
        if ($file = $param['slider_photo']) {
            $slider_photo = $param['slider_photo'];
            $ext = '.'.$param['slider_photo']->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $param['slider_photo']->getClientOriginalName());
            $file->move($destination_path, $fileName);
            $slider_photo = $fileName;
        }

       $data = Slider::create([
        'title'=>$param['title'],
        'path'=>'uploads/sliders/',
        'photo'=>$slider_photo,
       ]);

       return $data;
    }

    public static function update_data($param,$id)
    {
        $data = Slider::find($id);

        $path = public_path() . '/uploads/sliders/';

        //author photo
        $slider_photo = ($param['slider_photo'] != '') ? $param['slider_photo'] : $data->photo;
        // dd($slider_photo);
        if ($file = $param['slider_photo']) {
            $slider_photo = $param['slider_photo'];
            $ext = '.'.$param['slider_photo']->getClientOriginalExtension();

            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $slider_photo->getClientOriginalName());
            $file->move($path, $fileName);
            $slider_photo = $fileName;
        }

        $data = $data->update([
            'title'=>$param['title'],
            'path'=>'uploads/sliders/',
            'photo'=>$slider_photo
        ]);

        return $data;
    }
}
