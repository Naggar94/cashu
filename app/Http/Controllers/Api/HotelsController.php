<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Http\Providers\OurHotelsProvider;
use App\Http\Providers\BestHotelsProvider;
use App\Http\Providers\TopHotelsProvider;

/**
 * @group  Hotel Explore
 *
 * APIs fetching hotels from different providers
 */
class HotelsController extends Controller
{
	/**
		* @bodyParam  page int optional The page of search by default it is set to 1. Example: 3
		* @bodyParam  city string optional IATA code of the city. Example: CAI.
		* @bodyParam  from date optional starting date of availability of Hotel. Example: 2020-01-15
		* @bodyParam  to date optional end date of availability of Hotel. Example: 2020-08-20
		* @bodyParam  adults_number int optional The count of people desired for reservation. Example: 3
		* @responseFile  responses/ourhotels.get.json
	*/
	public function ourHotels(Request $request){
		try{
			// throw new \Exception("Error Processing Request");
			
			$ourHotelsProvider = new OurHotelsProvider($request->has('page') && is_numeric($request->page) ? $request->page : 1);
			$ourHotelsProvider->select([
				['key'=>'name','alias'=>'hotelName'],
				['key'=>'provider'],
				['key'=>'amenities'],
				['key'=>'price','alias'=>'fare'],
			]);
			$request->has('city')?$ourHotelsProvider->where(['city','==',$request->city]):null;
			$request->has('from') && $request->has('to')?$ourHotelsProvider->whereDateBetween(['from','to',$request->from,$request->to]):null;
			$request->has('adults_number') && is_numeric($request->adults_number) ?$ourHotelsProvider->where(['adults_count','>=',$request->adults_number]):null;
			return (new Response($ourHotelsProvider->fetch(), 200))
	              ->header('Content-Type', 'application/json');
		}catch(\Exception $e){
			return (new Response(["error_msg"=>$e->getMessage()], 400))
	              ->header('Content-Type', 'application/json');
		}
	}

	/**
		* @bodyParam  page int optional The page of search by default it is set to 1. Example: 3
		* @bodyParam  city string optional IATA code of the city. Example: CAI.
		* @bodyParam  from date optional starting date of availability of Hotel. Example: 2020-01-15
		* @bodyParam  to date optional end date of availability of Hotel. Example: 2020-08-20
		* @bodyParam  numberOfAdults int optional The count of people desired for reservation. Example: 3
		* @responseFile  responses/besthotels.get.json
	*/
	public function bestHotels(Request $request){
		try{
			$bestHotelsProvider = new BestHotelsProvider($request->has('page') && is_numeric($request->page) ? $request->page : 1);
			$bestHotelsProvider->select([
				['key'=>'name','alias'=>'hotel'],
				['key'=>'rate','alias'=>'hotelRate'],
				['key'=>'amenities','alias'=>'roomAmenities','transform'=>'listToString'],
				['key'=>'price','alias'=>'hotelFare'],
			]);
			$request->has('city')?$bestHotelsProvider->where(['city','==',$request->city]):null;
			$request->has('from') && $request->has('to')?$bestHotelsProvider->whereDateBetween(['from','to',$request->from,$request->to]):null;
			$request->has('numberOfAdults') && is_numeric($request->numberOfAdults) ?$ourHotelsProvider->where(['adults_count','>=',$request->numberOfAdults]):null;
			return (new Response($bestHotelsProvider->fetch(), 200))
				->header('Content-Type', 'application/json');
		}catch(\Exception $e){
			return (new Response(["error_msg"=>$e->getMessage()], 400))
				->header('Content-Type', 'application/json');
		}
	}

	/**
		* @bodyParam  page int optional The page of search by default it is set to 1. Example: 3
		* @bodyParam  city string optional IATA code of the city. Example: CAI.
		* @bodyParam  from date optional starting date of availability of Hotel. Example: 2020-01-15
		* @bodyParam  to date optional end date of availability of Hotel. Example: 2020-08-20
		* @bodyParam  adultsCount int optional The count of people desired for reservation. Example: 3
		* @responseFile  responses/tophotels.get.json
	*/
	public function topHotels(Request $request){
		try{
			$topHotelsProvider = new TopHotelsProvider($request->has('page') && is_numeric($request->page) ? $request->page : 1);
			$topHotelsProvider->select([
				['key'=>'name','alias'=>'hotelName'],
				['key'=>'rate','transform'=>'starrize'],
				['key'=>'discount'],
				['key'=>'amenities','alias'=>'roomAmenities'],
				['key'=>'price'],
			]);
			$request->has('city')?$topHotelsProvider->where(['city','==',$request->city]):null;
			$request->has('from') && $request->has('to')?$topHotelsProvider->whereDateBetween(['from','to',$request->from,$request->to]):null;
			$request->has('adultsCount') && is_numeric($request->adultsCount) ?$ourHotelsProvider->where(['adults_count','>=',$request->adultsCount]):null;
			return (new Response($topHotelsProvider->fetch(), 200))
				->header('Content-Type', 'application/json');
	    }catch(\Exception $e){
			return (new Response(["error_msg"=>$e->getMessage()], 400))
				->header('Content-Type', 'application/json');
		}
	}
}