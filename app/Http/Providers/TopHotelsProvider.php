<?php
namespace App\Http\Providers;

use App\Http\Data\TopHotels;

class TopHotelsProvider extends BaseProvider{
	public function __construct($page = 1,$limit = 10){
		parent::__construct($page,"TopHotels",TopHotels::$data,$limit);
	}
}