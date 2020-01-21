<?php

namespace App\Http\Controllers;
use App\Guardian;
use App\Salutation;
use App\Child;
use Illuminate\Support\Facades\DB;
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
           $photo_name = $request->last_name.'_'.time().'.' . $request->photo->getClientOriginalExtension();
           $photo->move('uploads/guardians', $photo_name);
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
        $this->validate($request, [
            'first_name' => 'required| string| max:191',
            'last_name' => 'required| string| max:191',
            'phone_no' => 'required',
            'salutation' => 'required',
            'is_member'=> 'required'
        ]);
        $guardian = Guardian::find($id);
         //Check if there is an image change
         $photo_name ='no-profile.jpg';

         if($request->hasFile('photo')){
            //Check if the old image exists inside the folder

            if(file_exists(public_path('uploads/guadians'). $guardian->photo)){
                unlink(public_path('uploads/guardians'). $guardian->photo);
            }

            //Upload the new image


            $photo = $request->photo;
            $photo_name = $request->last_name.'_'.time().'.' . $request->photo->getClientOriginalExtension();

            $photo->move('uploads/guardians', $photo_name);

            $guardian->photo =  $photo_name;
        }

       $full_name = $request['salutation']. ' '.$request['first_name'].' '.$request['last_name'];
       $guardian->update([
        'salutation' => $request['salutation'],
        'first_name' => $request['first_name'],
        'last_name' => $request['last_name'],
        'phone_no' => $request['phone_no'],
        'full_name' => $full_name,
        'is_member' => $request['is_member'],
        'other_comment' => $request['comment'],
        'photo' =>   $guardian->photo,
       ]);

       //Sesion Messege
          $request->session()->flash('msg', $full_name."'s record has been successfully updated.");

        //Redirect
         return redirect('guardians/'.$id.'edit/');
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

         $guardian = Guardian::find($id);
        if($guardian){
        
        $full_name = $guardian->full_name;
        DB::table('children_guardians')
        ->where('guardian_id', '=', $id)
        ->delete();

      DB::table('guardians')
        ->where('id', '=', $id)
        ->delete();   
        // Store Message in Flash
        $request->session()->flash('msg', $full_name ."'s record has been deleted successfully");

        //Redirect
        return redirect ('guardians');
    }
        $request->session()->flash('msg',"Error!!!. No Record to Delete");
        //Redirect
        return redirect ('guardians');

    }
}
