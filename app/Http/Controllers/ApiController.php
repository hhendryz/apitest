<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
use Response;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        try {
            $client = new Client();
           /* $res = $client->request('GET', 'https://api.github.com/user', [
                'auth' => ['user', 'pass']
            ]);*/

            $params = [
               'query' => [
                  'email' => "blrsit21@gmail.com",
                  'page' => 1,
                  'pageSize' => 1
               ]
            ];

            $res = $client->request('GET', 'http://107.172.204.17/jubelio/api/all/products/stock', $params);
            //echo $res->getStatusCode();
            // "200"
            //echo $res->getHeader('content-type')[0];
            // 'application/json; charset=utf8'
            //echo $res->getBody();
            // {"type":"User"...'
            return json_decode($response->getBody(), true);

        }catch (\Exception $e) {
            $res = $e->getMessage();
        }
        //return view('apistock', get_defined_vars());
    }

    public function api_user(Request $request)
    {
        $user = User::all();
        if (!$user){
            $jsondata = Response::json(['status' => false, 'message' => 'Get User Fail!']);
        }else{
            $data = $user->toArray();
            $jsondata = Response::json([
                'data' => $data,
                'status' => true,
                'message' => 'Get User Success!'
            ]);
        }
        return $jsondata;
        //return view('apiuser', get_defined_vars());
    }
}
