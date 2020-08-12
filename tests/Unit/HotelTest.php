<?php

namespace Tests\Unit;

use Tests\TestCase;

class HotelTest extends TestCase
{
    public function testBestHotels(){
    	$this->get(route('best-hotels'))->assertStatus(200)->assertJsonStructure([
			'*' => [ 'hotel', 'hotelRate', 'roomAmenities', 'hotelFare' ],
		]);;
    }

    public function testTopHotels(){
    	$this->get(route('top-hotels'))->assertStatus(200)->assertJsonStructure([
			'*' => [ 'hotelName', 'rate', 'roomAmenities', 'price' ],
		]);;
    }

    public function testOurHotels()
    {
    	$data = [
		    [
		        "hotelName"=> "Hotel 1",
		        "fare"=> 152.5,
		        "amenities"=> [
		            "Air Conditioner",
		            "TV",
		            "Playstation",
		            "Play Ground"
		        ],
		        "provider"=> "BestHotels"
		    ],
		    [
		        "hotelName"=> "Hotel 2",
		        "fare"=> 152.5,
		        "amenities"=> [
		            "Air Conditioner",
		            "TV",
		            "Playstation",
		            "Play Ground"
		        ],
		        "provider"=> "BestHotels"
		    ],
		    [
		        "hotelName"=> "Hotel 3",
		        "fare"=> 152.5,
		        "amenities"=> [
		            "Air Conditioner",
		            "TV",
		            "Playstation",
		            "Play Ground"
		        ],
		        "provider"=> "BestHotels"
		    ],
		    [
		        "hotelName"=> "Hotel 4",
		        "fare"=> 152.5,
		        "amenities"=> [
		            "Air Conditioner",
		            "TV",
		            "Playstation",
		            "Play Ground"
		        ],
		        "provider"=> "BestHotels"
		    ],
		    [
		        "hotelName"=> "Hotel 5",
		        "fare"=> 152.5,
		        "amenities"=> [
		            "Air Conditioner",
		            "TV",
		            "Playstation",
		            "Play Ground"
		        ],
		        "provider"=> "BestHotels"
		    ],
		    [
		        "hotelName"=> "Hotel 15",
		        "fare"=> 152.5,
		        "amenities"=> [
		            "Air Conditioner",
		            "TV",
		            "Playstation",
		            "Play Ground"
		        ],
		        "provider"=> "TopHotels"
		    ],
		    [
		        "hotelName"=> "Hotel 16",
		        "fare"=> 152.5,
		        "amenities"=> [
		            "Air Conditioner",
		            "TV",
		            "Playstation",
		            "Play Ground"
		        ],
		        "provider"=> "TopHotels"
		    ],
		    [
		        "hotelName"=> "Hotel 17",
		        "fare"=> 152.5,
		        "amenities"=> [
		            "Air Conditioner",
		            "TV",
		            "Playstation",
		            "Play Ground"
		        ],
		        "provider"=> "TopHotels"
		    ],
		    [
		        "hotelName"=> "Hotel 18",
		        "fare"=> 152.5,
		        "amenities"=> [
		            "Air Conditioner",
		            "TV",
		            "Playstation",
		            "Play Ground"
		        ],
		        "provider"=> "TopHotels"
		    ],
		    [
		        "hotelName"=> "Hotel 19",
		        "fare"=> 152.5,
		        "amenities"=> [
		            "Air Conditioner",
		            "TV",
		            "Playstation",
		            "Play Ground"
		        ],
		        "provider"=> "TopHotels"
		    ]
		];
    	$this->get(route('our-hotels'))->assertStatus(200)->assertJson($data)->assertJsonStructure([
			'*' => [ 'hotelName', 'fare', 'amenities', 'provider' ],
		]);;
    }
}
