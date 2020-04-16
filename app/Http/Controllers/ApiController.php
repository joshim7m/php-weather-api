<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;

class ApiController extends Controller
{
    
    public function getGithub($username){

      $client = New GuzzleClient;
      $response = $client->get("api.github.com/users/". $username);
      $body = json_decode($response->getBody());

      print $body->name;

    }

    public function getWeather(){

      return view('weather');
    }

    public function postWeather(Request $request){

      // api to get coordinates

      $locatonClient = new GuzzleClient();
      $response = $locatonClient->get('https://us1.locationiq.com/v1/search.php?', [
          'query'=> [
              'key'=>'50eef054f315ae',
              'q'=> $request->location,
              'format'=>'json',
          ]
      ]);

      $responseBody = json_decode($response->getBody());
      $coords = $responseBody[0];
      $address = $responseBody[0]->display_name;

      //print $coords->lat. "<br>";
      //print $coords->lon. "<br>";

      // use the lat and long to get wheater informatoin

      $owClient = new GuzzleClient();
      $api = '7d68c164873760ed13834944f0069cc1';
      $owUrl = "api.openweathermap.org/data/2.5/weather?lat=".$coords->lat."&lon=".$coords->lon."&appid=". $api;
      //print $owUrl;

      $owResponse = $owClient->get($owUrl);
      $owResponseBody = json_decode($owResponse->getBody());


      return view('w-result', compact('owResponseBody', 'address'));

    } 

    // vue js approach

    public function getWeatherJs(){

      return view('weatherjs');
    }

    public function postWeatherJs(Request $request){


    }
}