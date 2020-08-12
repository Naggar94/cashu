<?php
namespace App\Http\Providers;

use App\Http\Data\BestHotels;

class BestHotelsProvider extends BaseProvider{

	public function __construct($page = 1,$limit = 10){
		parent::__construct($page,"BestHotels",BestHotels::$data,$limit);
	}
}