<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DogController extends Controller
{
    public function index(Request $request){

        // $this->generateDog();

        return view('view-dog');
    }

    public function generateDog(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://dog.ceo/api/breeds/image/random");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        echo $response;
    }
}
