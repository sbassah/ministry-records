<?php

namespace App\Http\Controllers;
use App\ChurchClass;
use App\Child;
use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Arr;

class ReportsController extends Controller
{
    public function index(){

        $classes = ChurchClass::pluck('name', 'id');

        $data = array(
            'classes' => $classes
        );

        return view('reports')->with($data);
    }

    public function getByClass(Request $request){
        $class = $request->group;
        $file_name = 'CTM'.time();
        if( $request->group == '1'){
            $file_name = 'Class One_'.time();
        }
        elseif( $request->group == '2'){
            $file_name = 'Class Two_'.time();
        }
        elseif( $request->group == '3'){
            $file_name = 'Class Teens_'.time();
        }
        
         if($class == '0'){
             $arrval = array();

            $groups = ChurchClass::all();

            foreach($groups as $group){
                $arrval[$group->name] = Child::select('first_name', 'last_name', 'gender','date_of_birth','home_address','school_name')
                ->where('church_class_id', '=', $group->id)
                ->get();
            }
            Excel::create($file_name, function($excel) use($arrval) {
                foreach ($arrval as $val){
                    $excel->sheet('Records', function($sheet)use($val) {
                        
                         $sheet->fromModel($val);
                         
                     });
                }
              
    
            })->export('xls');
         }
     else{
        $children = Child::select('first_name', 'last_name', 'gender','date_of_birth','home_address','school_name')
        ->where('church_class_id', '=', $class)
        ->get();
            Excel::create($file_name, function($excel) use($children) {
            $excel->sheet('Children', function($sheet)use($children) {
            $sheet->fromModel($children);

            });

            })->export('xls');

     }

        //Sesion Messege
        $request->session()->flash('msg', "Report has been exported successfully.");

        //Redirect
         return redirect('reports');

    }

    public function getByAgeGroup(Request $request){
        
        $age_from = $request->age_start;
        $age_to = $request->age_end;
        $children = Child::select('first_name', 'last_name', 'gender','date_of_birth','home_address','school_name')
        ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR,date_of_birth,CURDATE())'),
        array($age_from, $age_to))
        ->orderBy('date_of_birth', 'ASC')
        ->get();

        $file_name = 'Children '.$age_from.'-'.$age_to.'_'.time();
        Excel::create($file_name, function($excel) use($children) {
            $excel->sheet('Children', function($sheet)use($children) {
            $sheet->fromModel($children);

            });

            })->export('xls');
                //Sesion Messege
                $request->session()->flash('msg', "Report has been exported successfully.");

                //Redirect
                return redirect('reports');


    }

    public function getAttendanceByMonth(Request $request){

            $month = $request->month;
            $year = $request->year;
             $attendance =  Attendance::whereRaw('YEAR(sunday_date) = 2020 AND MONTH(sunday_date) = 1')
            ->get();
                dd($attendance); 
     
    }

    
    public function getAttendanceByDay(){

    }

    public function getAttendance(){

    }
}
