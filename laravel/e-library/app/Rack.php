<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    protected $table = 'racks';
    protected $fillable = ['name','description','c_by','u_by'];

    public static function list($param)
    {
        $racks = new Rack();

        if (count($param) > 0) {
            if ($param->keyword != null) {
               $racks = $racks->where('name','like','%'.$param->keyword.'%');
            }
        }
        
        
        return $racks;
    }

    public static function store($param)
    {
        // dd($param['name']);
        $rack = Rack::create([
            'name'=>$param['name'],
            'description'=>$param['description'],

        ]);

        return $rack;
    }

    public static function update_data($param,$id)
    {
        // dd($param);
        $rack = Rack::find($id);
        // dd($rack);

        $rack = $rack->update([
            'name'=>$param['name'],
            'description'=>$param['description'],
        ]);

        return $rack;
    }
}
