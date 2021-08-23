<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PostController extends Controller
{
    //
    public function index()
    {
        //
        $client = new Client(); //GuzzleHttp\Client
        $url = "http://localhost:8002/api/lists";

        $request = $client->request('GET', $url, [
            'verify'  => false,
        ]);
        $response = $request->getBody();


        $responseBody = json_decode($response);
     
        return view('pages.index', compact('responseBody'));
    }

    public function insert(Request $req)
    {
        $client = new Client(); //GuzzleHttp\Client

        $url = "http://localhost:8002/api/insert";


        $response= $client->request("POST", $url,[
            'form_params' => [
                'name' => $req['text'],
            ]
        ]);
        $res = $response->getBody();

       
        $responseBody = json_decode($res);
        return redirect('/')->with('success','Insert Successfully!!');
    }
    public function delete(Request $req,$id)
    {
        //echo $id;
        $client = new Client(); //GuzzleHttp\Client

        $url = "http://localhost:8002/api/delete/".$id;


        $response = $client->request('GET', $url);
   
        $statusCode = $response->getStatusCode();
        $responseBody = json_decode($response->getBody(), true);

        return redirect('/')->with('success','Delete Successfully!!');
    }
}

