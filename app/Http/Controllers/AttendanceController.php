<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChurchClass;
use App\Attendance;
use Illuminate\Support\Arr;

class AttendanceController extends Controller
{
    public function index(){

        $classes = ChurchClass::pluck('name', 'id');

        $data = array(
            'classes' => $classes
        );

        return view('attendance')->with($data);
    }
    
    public function record(Request $request){
      $this->validate($request,[
          'sunday_date' => 'required',
          'group' => 'required',
          'boys' => 'required',
          'girls' => 'required',

      ]);

      $sunday_date = $request->sunday_date;
      $group = $request->group;
      $boys = $request->boys;
      $girls = $request->girls;
      $comment = $request->comment;

      $record = Attendance::updateOrCreate(
        ['sunday_date' => $sunday_date, 'group' => $group ],
        [
         'boys' => $boys,
         'girls' => $girls,
         'comment' => $comment
        ]
    );

        // Store Message in Flash
        $request->session()->flash('msg', $group.'attendance for '. $sunday_date .' has been recorded successfully');

        //Redirect
        return redirect ('attendance');


    }
}
