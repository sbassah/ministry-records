<?php

namespace App\Http\Controllers;
use App\Teacher;
use App\Salutation;
use App\ChurchClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $salutations = Salutation::pluck('name', 'id');
        $teachers = Teacher::paginate(10);
        $church_class = ChurchClass::pluck('name', 'id');
        $data = array(
            'church_class' => $church_class,
            'teachers' => $teachers,
            'salutations' => $salutations
        );
        return view('teachers.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $salutations = Salutation::pluck('name', 'id');
        $church_class = ChurchClass::pluck('name', 'id');
        $data = array(
            'church_class' => $church_class,
            'salutations' => $salutations
        );
        return view('teachers.create')->with($data);
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
            'email'=> 'email',
            'class_assigned'=> 'required',
          
        ]);

            $photo_name ='no-profile.jpg';
             //Check if there is an image

             if($request->hasFile('photo')){
                $photo = $request->photo;
                $photo_name = $request->last_name.'_'.time().'.' . $request->photo->getClientOriginalExtension();
                $photo->move('uploads/teachers', $photo_name);
            }


         Teacher::create([
            'salutation' => $request['salutation'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_no' => $request['phone_no'],
            'email' => $request['email'],
            'class_assigned_id' => $request['class_assigned'],
            'photo' =>  $photo_name,
           ]);

           //Sesion Messege
       $request->session()->flash('msg', $request['first_name']."'s Teacher Record has been added Successfully");

       //Redirect
       return redirect('teachers/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
        public function show($id)
    {
        return redirect('teachers/'.$id.'/edit');
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher  ::find($id);
        $salutations = Salutation::pluck('name', 'id');
        $church_class = ChurchClass::pluck('name', 'id');
        $data = array(
            'church_class' => $church_class,
            'teacher' => $teacher,
            'salutations' => $salutations
        );
        return view('teachers.edit')->with($data);
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
            'email'=> 'email',
            'class_assigned'=> 'required',
          
        ]);

            $teacher = Teacher::find($id);
            //Check if there is an image change
  
            if($request->hasFile('photo')){
              //Check if the old image exists inside the folder
  
              if(file_exists(public_path('uploads/teachers'). $teacher->photo)){
                  unlink(public_path('uploads/teachers'). $teacher->photo);
              }
  
              //Upload the new image

              $photo = $request->photo;
              $photo_name = $request->last_name.'_'.time().'.' . $request->photo->getClientOriginalExtension();
              $photo->move('uploads/teachers', $photo_name);
              $teacher->photo =  $photo_name;
          }

        
        $teacher->update([
            'salutation' => $request['salutation'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_no' => $request['phone_no'],
            'email' => $request['email'],
            'class_assigned_id' => $request['class_assigned'],
            'photo' =>  $teacher->photo,
        ]);

            // Store Message in Flash
        $request->session()->flash('msg', 'Record has been updated!');

        //Redirect
        return redirect ('teachers/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      //  dd($request);
        $teacher = Teacher::find($id);
     //   dd($child);
        if($teacher){
            
            $first_name = $teacher->first_name;

          DB::table('teachers')
            ->where('id', '=', $id)
            ->delete();   
            // Store Message in Flash
            $request->session()->flash('msg', $first_name ."'s record has been deleted successfully");

            //Redirect
            return redirect ('teachers');
        }

        $request->session()->flash('msg',"Error!!!. No Record to Delete");

        //Redirect
        return redirect ('teachers');
       
    }
}
