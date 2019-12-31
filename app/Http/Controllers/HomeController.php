<?php

namespace App\Http\Controllers;
use App\Child;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $query = 'SELECT 
       count(CASE WHEN (YEAR(NOW()) - YEAR(date_of_birth) BETWEEN 0 AND 4) 
             THEN id ELSE null END) AS "Under_5", 
       count(CASE WHEN (YEAR(NOW()) - YEAR(date_of_birth) BETWEEN 5 AND 8) 
             THEN id ELSE null END) AS "Under_9", 
       count(CASE WHEN (YEAR(NOW()) - YEAR(date_of_birth) BETWEEN 9 AND 12) 
             THEN id ELSE null END) AS "Under_13", 
       count(CASE WHEN (YEAR(NOW()) - YEAR(date_of_birth) BETWEEN 13 AND 18) 
             THEN id ELSE null END) AS "Teens", 
       count(CASE WHEN (YEAR(NOW()) - YEAR(date_of_birth) BETWEEN 19 AND 100) 
             THEN id ELSE null END) AS "Above 19"
        FROM children';
       $children_stats = DB::select($query);
       $class_one_boys = DB::select("select count(*) as class_one_boys from children where church_class_id = 1 and gender='Male'");
       $class_one_girls = DB::select("select count(*) as class_one_girls from children where church_class_id = 1 and gender='Female'");
       $class_two_boys = DB::select("select count(*) as class_two_boys from children where church_class_id = 2  and gender='Male'");
       $class_two_girls = DB::select("select count(*) as class_two_girls from children where church_class_id = 2  and gender='Female'");
       $teens_boys = DB::select("select count(*) as teens_boys from children where church_class_id = 3  and gender='Male'");
       $teens_girls = DB::select("select count(*) as teens_girls from children where church_class_id = 3 and gender='Female'");
           // dd($class_one_girls);
        $data = array(
            'class_one_boys' => $class_one_boys,
            'class_one_girls' => $class_one_girls,
            'class_two_girls' => $class_two_girls,
            'class_two_boys' => $class_two_boys,
            'teens_girls' => $teens_girls,
            'teens_boys' => $teens_boys,
            'children_stats' => $children_stats,
         );

      // $jq= response()->json($children_stats);
       //dd($jq->data);
        return view('dashboard')->with($data);
    }


    public function charts(){
      //  dd('test');
        $query = 'SELECT 
        count(CASE WHEN (YEAR(NOW()) - YEAR(date_of_birth) BETWEEN 0 AND 4) 
              THEN id ELSE null END) AS "Under_5", 
        count(CASE WHEN (YEAR(NOW()) - YEAR(date_of_birth) BETWEEN 5 AND 8) 
              THEN id ELSE null END) AS "Under_9", 
        count(CASE WHEN (YEAR(NOW()) - YEAR(date_of_birth) BETWEEN 9 AND 12) 
              THEN id ELSE null END) AS "Under_13", 
        count(CASE WHEN (YEAR(NOW()) - YEAR(date_of_birth) BETWEEN 13 AND 18) 
              THEN id ELSE null END) AS "Teens", 
        count(CASE WHEN (YEAR(NOW()) - YEAR(date_of_birth) BETWEEN 19 AND 100) 
              THEN id ELSE null END) AS "Above 19"
         FROM children';
         
        $result = DB::select($query); 

        return response()->json($result);
    }
    

    public function logout(Request $request)
    {
        auth()->guard()->logout();

          return redirect('/')->with('msg', "You have been logged out successfully!")
          ->with('status', 'success');
      

    }
}
