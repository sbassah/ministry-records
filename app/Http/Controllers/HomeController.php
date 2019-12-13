<?php

namespace App\Http\Controllers;

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
        
        // $children = Child::paginate(5);
        // $school_class = SchoolClass::pluck('name', 'id');
        // $church_class = ChurchClass::pluck('name', 'id');
        // $data = array(
        //     'school_class' => $school_class,
        //     'church_class' => $church_class,
        //     'children' => $children
        // );
        // return view('children.index')->with($data);
        return view('dashboard');
    }

    

    public function logout(Request $request)
    {
        auth()->guard()->logout();

          return redirect('/')->with('msg', "You have been logged out successfully!")
          ->with('status', 'success');
      

    }
}
