<?php 

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;

class ApiController extends Controller {


	public function index()
	{
    $client = new Client();                   
    $credentials = 'LdT23Q9rv8g9bVf8v/fQYsyIcuD14svaYL6Bi8f9uGhLBVlHA3ybTFjjqe+cQO8k';

    $response = $client->request('GET', 'http://api.jakarta.go.id/v1/kelurahan', [
     'header' => ['Authorization', $credentials]
    ]);

     $response->getBody()->getContents(); 
	}

}