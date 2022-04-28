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
        $dates = array_keys(get_object_vars($data->near_earth_objects));
        $asteroids_count = [];
        $fastest_astroid_array = [];
        $closest_astroid_array = [];
        $average_size_data = [];
        if(isset($data->near_earth_objects)){
            foreach($data->near_earth_objects as $newdata){
                $fastest_astroid = [];
                $closest_astroid = [];
                $max_speed = 0;
                $closest_astroid_distance = 0;
                $average_size = 0;
                array_push($asteroids_count, count($newdata));
                foreach($newdata as $each_ast){
                    if($max_speed < $each_ast->close_approach_data[0]->relative_velocity->kilometers_per_hour){
                       
                        $max_speed = $each_ast->close_approach_data[0]->relative_velocity->kilometers_per_hour;
                        $fastest_astroid = [
                            'astroidId' => $each_ast->id,
                            'speed' => $max_speed,
                        ];
                    }
                    echo $each_ast->close_approach_data[0]->miss_distance->kilometers."<br>";
                    if($closest_astroid_distance < $each_ast->close_approach_data[0]->miss_distance->kilometers){
                        $closest_astroid_distance = $each_ast->close_approach_data[0]->miss_distance->kilometers;
                        $closest_astroid = [
                            'astroidId' => $each_ast->id,
                            'distance' => $closest_astroid_distance,
                        ];
                    }
                   $average_size += $each_ast->estimated_diameter->kilometers->estimated_diameter_max;
                      
                } 
                exit();
                $averagefor_date=$average_size/count((array)$data->near_earth_objects);

                array_push($fastest_astroid_array, $fastest_astroid);
                array_push($closest_astroid_array, $closest_astroid);
                array_push($average_size_data, $averagefor_date);
            }
        }

        dd($fastest_astroid_array);
        // dd($average_size_data);
        
        return view('asteroid-chart')
        ->with('dates',json_encode($dates,JSON_NUMERIC_CHECK))
        ->with('fastest_astroid',json_encode($fastest_astroid_array,JSON_NUMERIC_CHECK))
        ->with('closest_astroid',json_encode($closest_astroid_array,JSON_NUMERIC_CHECK))
        ->with('average_size',json_encode($average_size_data,JSON_NUMERIC_CHECK))
        ->with('asteroids_count',json_encode($asteroids_count,JSON_NUMERIC_CHECK));
        
    }
}
