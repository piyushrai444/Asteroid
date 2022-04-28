<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function data(){
        return view('neo');
    }

    public function findAsteroid(Request $request){
        $validator = Validator::make($request->all(),[
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError([],$validator->errors()->first(),200);
        }
        $url = "https://api.nasa.gov/neo/rest/v1/feed";
        $dataArray = ['start_date' => $request->start_date, 'end_date'=> $request->end_date,'detailed'=>true, 'api_key'=>'DEMO_KEY'];
      
        $data = http_build_query($dataArray);
      
        $getUrl = $url."?".$data;
        $ch = curl_init();
        $authorization = "Authorization: Bearer ".$request->access_token; // Prepare the authorisation token
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', $authorization));
        curl_setopt($ch, CURLOPT_HTTPGET, 1); // Specify the request method as GET
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL,$getUrl);
        # Send request.
        $result = curl_exec($ch);
        
        curl_close($ch); // Close the cURL connection
        $data= json_decode($result);
        dd($data);
        if(isset($data->near_earth_objects)){
            foreach($data->near_earth_objects as $newdata){
                if(isset($newdata->close_approach_data)){
                    
                }
                dd($newdata);
                // dd($newdata[0]->close_approach_data[0]->relative_velocity->kilometers_per_hour);
            }
        }
        
        $year = ['2015','2016','2017','2018','2019','2020'];
        $user = ['2015','2016','2017','2018','2017','2020'];
        // dd($data);
        return view('asteroid-chart')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK));
        
    }
}
