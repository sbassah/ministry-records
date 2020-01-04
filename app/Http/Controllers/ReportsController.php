<?php

namespace App\Http\Controllers;
use App\ChurchClass;
use App\Child;
use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
        //$children = DB::table('children')->where('church_class_id', $class)->get();
        $children = Child::where('church_class_id','=', $class)->get();
        $file_name;
        if( $request->group == '1'){
            $file_name = 'Class One_'.time();
        }
        elseif( $request->group == '2'){
            $file_name = 'Class Two_'.time();
        }
        elseif( $request->group == '3'){
            $file_name = 'Class Teens_'.time();
        }
        $data = array(
            array('data1', 'data2'),
            array('data3', 'data4'));
        Excel::create($file_name, function($excel) use($children) {
            $excel->sheet('Children', function($sheet)use($children) {
               // $sheet->fromArray($data, null, 'A1', true);
                $sheet->fromModel($children);
                
            });

        })->export('xls');

    }

    public function getByAgeGroup(){


    }

    public function getAttendanceByMonth(){

    }

    
    public function getAttendanceByDay(){

    }

    public function getAttendance(){

    }
}
