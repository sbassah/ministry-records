<?php

namespace App\Http\Controllers;
use App\Guardian;
use App\Salutation;
use App\Child;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salutations = Salutation::pluck('name', 'id');
        $guardians = Guardian::paginate(10);
        
        $data = array(
            'guardians' => $guardians,
            'salutations'=> $salutations
        );
        return view('guardians.index')->with($data);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
      $salutations = Salutation::pluck('name', 'name');
       
        $data = array(
            'salutations'=> $salutations
        );
        return view('guardians.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required| string| max:191',
            'last_name' => 'required| string| max:191',
            'phone_no' => 'required',
            'salutation' => 'required',
            'is_member'=> 'required'
        ]);

        $photo_name ='no-profile.jpg';
        //Check if there is an image

        if($request->hasFile('photo')){
           $photo = $request->photo;
           $photo->move('uploads/guardians', $photo->getClientOriginalName());
           $photo_name = $photo->getClientOriginalName();
       }
       $full_name = $request['salutation']. ' '.$request['first_name'].' '.$request['last_name'];
       Guardian::create([
        'salutation' => $request['salutation'],
        'first_name' => $request['first_name'],
        'last_name' => $request['last_name'],
        'phone_no' => $request['phone_no'],
        'full_name' => $full_name,
        'is_member' => $request['is_member'],
        'other_comment' => $request['comment'],
        'photo' =>  $photo_name,
       ]);

       //Sesion Messege
      $request->session()->flash('msg', 'Guardian record has been added Successfully');

   //Redirect
   return redirect('guardians/create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('guardians/'.$id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $child_guardians = Guardian::where('id', '=', $id)
        ->with('children')
        ->get();
       // dd($child_guardians);
        $guardian = Guardian::find($id);
       $salutations = Salutation::pluck('name', 'name');
       $children = Child::pluck('first_name', 'id');
        $data = array(
            'guardian' => $guardian,
            'child_guardians' => $child_guardians,
            'salutations' => $salutations,
            'children' =>$children
        );
        return view('guardians.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
