<?php

namespace App\Http\Controllers;
use App\Child;
use App\ChurchClass;
use App\Guardian;
use App\SchoolClass;
use App\ChildGuardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $children = Child::paginate(5);
        $school_class = SchoolClass::pluck('name', 'id');
        $church_class = ChurchClass::pluck('name', 'id');
       
        $data = array(
            'school_class' => $school_class,
            'church_class' => $church_class,
            'children' => $children
        );
        return view('children.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school_class = SchoolClass::pluck('name', 'id');
      //  $children = Child::pluck('[first_name, last_Name]', 'id');
      //  Child::get(['first_name', 'last_Name', 'id'])->pluck('columns', 'id');

       // dd($children);
        $church_class = ChurchClass::pluck('name', 'id');
        $data = array(
            'school_class' => $school_class,
            'church_class' => $church_class
        );
        return view('children.create')->with($data);
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
            'gender' => 'required',
            'date_of_birth'=> 'required',
            'church_class'=> 'required',
            'address'=> 'required|string|max:191',
            'name_of_school' => 'string',
        ]);

        $photo_name ='no-profile.jpg';
             //Check if there is an image

             if($request->hasFile('photo')){
                $photo = $request->photo;
                $photo_name = $request->last_name.'_'.time().'.' . $request->photo->getClientOriginalExtension();
                $photo->move('uploads/children', $photo_name);
            }


         Child::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['date_of_birth'],
            'church_class_id' => $request['church_class'],
            'home_address' => $request['address'],
            'school_name' => $request['name_of_school'],
            'school_class_id' => $request['school_class'],
            'photo' =>  $photo_name,
           ]);

           //Sesion Messege
       $request->session()->flash('msg', 'Child Record has been added. Now please update the Guardian information');

       //Redirect
       return redirect('children/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('children/'.$id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {	
       // $child = Child::find($id);
      //  $child_guardians = ChildGuardian::where('child_id',$id)->get();
        $child_guardians = Child::where('id', '=', $id)
            ->with('guardians')
            ->get();
       //  dd($child_guardians[0]->guardians[0]->pivot->relationship);
        $school_class = SchoolClass::pluck('name', 'id');
        $church_class = ChurchClass::pluck('name', 'id');
        $guardians = Guardian::pluck('full_name', 'id');
        $data = array(
            'guardians' => $guardians,
           'church_class' => $church_class,
           
            'school_class' => $school_class,
            'child_guardians' => $child_guardians
            
        );
        return view('children.edit')->with($data);
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
            'gender' => 'required',
            'date_of_birth'=> 'required',
            'church_class'=> 'required',
            'address'=> 'required|string|max:191',
            'name_of_school' => 'string',
        ]);

        $child = Child::find($id);
          //Check if there is an image change

          if($request->hasFile('photo')){
            //Check if the old image exists inside the folder

            if(file_exists(public_path('uploads/children'). $child->photo)){
                unlink(public_path('uploads/children'). $child->photo);
            }

            //Upload the new image

            $photo = $request->photo;
            $photo_name = $request->last_name.'_'.time().'.' . $request->photo->getClientOriginalExtension();

            $photo->move('uploads/children', $photo_name);

            $child->photo =  $photo_name;
        }


        
        //Update Child record

        $child->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['date_of_birth'],
            'church_class_id' => $request['church_class'],
            'home_address' => $request['address'],
            'school_name' => $request['name_of_school'],
            'school_class_id' => $request['school_class'],
            'photo' =>  $child->photo,
        ]);

            // Store Message in Flash
        $request->session()->flash('msg', 'Child record has been updated!');

        //Redirect
        return redirect ('children/'.$id.'/edit');

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
        $child = Child::find($id);
     //   dd($child);
        if($child){
            
            $first_name = $child->first_name;
            DB::table('children_guardians')
            ->where('child_id', '=', $id)
            ->delete();

          DB::table('children')
            ->where('id', '=', $id)
            ->delete();   
            // Store Message in Flash
            $request->session()->flash('msg', $first_name ."'s record has been deleted successfully");

            //Redirect
            return redirect ('children');
        }

        $request->session()->flash('msg',"Error!!!. No Record to Delete");

        //Redirect
        return redirect ('children');
       
    }

    public function AddGuardianToChild(Request $request)
    {
        $child_id = $request->child_id;
        $guardian_id = $request->guardian;
        $relationship_id = $request->relationship;

        $child_guardian = ChildGuardian::updateOrCreate(
            ['child_id' => $child_id, 'guardian_id' => $guardian_id ],
            ['relationship' => $relationship_id]
        );
              // Store Message in Flash
              $request->session()->flash('msg', 'Guardian has been added to child record successfully');

              //Redirect
              return redirect ('children/'.$child_id.'/edit');

    }


    public function removeGuardian($child_id, $guardian_id ){
     //  $childguardian = ChildGuardian::find(
       //     ['child_id' => $child_id, 'guardian_id' => $guardian_id ]);
            DB::table('children_guardians')
            ->where('child_id', '=', $child_id)
            ->where('guardian_id', '=',  $guardian_id)
            ->delete();

              // Store Message in Flash
            //  $request->session()->flash('msg', "Guardian has been detached from child's record successfully");

              //Redirect
              return redirect ('children/'.$child_id.'/edit');

          //  dd($childguardian);
    }

    public function filter_children(Request $request){
        $class = $request->class_filter;
        if ($class == "0"){
            $children = DB::table('children')->paginate(20);
        }
        else{
            $children = DB::table('children')->where('church_class_id', $class)->paginate(20);
        }
        $school_class = SchoolClass::pluck('name', 'id');
        $church_class = ChurchClass::pluck('name', 'id');
       
        $data = array(
            'school_class' => $school_class,
            'church_class' => $church_class,
            'children' => $children
        );
        return view('children.index')->with($data);
    }


    public function search_child(Request $request){
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        
        
       $children = Child::where('first_name', 'LIKE', '%' .$first_name. '%')
                ->orwhere('last_name','LIKE','%'. $last_name.'%')->paginate(20);
                
        $school_class = SchoolClass::pluck('name', 'id');
        $church_class = ChurchClass::pluck('name', 'id');
        
        $data = array(
            'school_class' => $school_class,
            'church_class' => $church_class,
            'children' => $children
        );
        return view('children.index')->with($data);
    }

}
