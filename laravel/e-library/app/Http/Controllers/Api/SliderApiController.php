<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use Validator;
use Hash;

class SliderApiController extends Controller
{
	public function get_all_sliders()
	{
		$sliders = Slider::where('status',1)->get();

		return response(['message'=>"Success",'status'=>1,'sliders'=>$sliders]);
	}
	
}