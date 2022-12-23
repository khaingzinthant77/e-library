<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\PopupAd;

class PopupAdApiController extends BaseController
{
	public function getPopup_ad()
	{
		$popupAd = PopupAd::where('status',1)->get();

		if (count($popupAd)>0) {
			$popupAd = $popupAd[0];
		}else{
			$popupAd = null;
		}

		return $this->sendResponse($popupAd, 'Retrieved successfully.');
	}
}