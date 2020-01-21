<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChurchClass;
use Illuminate\Support\Facades\DB;
use Exception;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $groups = ChurchClass::all();

       $data = array(
           'groups' => $groups,
       );

       return view('groups.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('groups.create');
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
            'group_name' => 'required |string | max:255|unique:church_classes,name',
        ]);
            $name =  $request['group_name'];
        ChurchClass::create([
            'name' => $request['group_name'],
            'comment' => $request['comment'],
           ]);

           //Sesion Messege
       $request->session()->flash('msg',"The ".$name. " group has been created successfully");

       //Redirect
       return redirect('groups/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = ChurchClass::find($id);

        $data = array(
            'group' => $group,
        );

        return view ('groups.edit')->with($data);
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
        $group = ChurchClass::find($id);

        $this->validate($request, [
            'group_name' => 'required |string | max:255| unique:church_classes,name,'.$group->id,
       
        ]);


            
        $group->update([
            'name' => $request['group_name'],
            'comment' => $request['comment'],
        ]);

            // Store Message in Flash
        $request->session()->flash('msg', 'Group has been updated!');

        //Redirect
        return redirect ('groups/'.$id.'/edit');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
    
        $group = ChurchClass::find($id);
     //   dd($child);
        if($group){
            
            $name = $group->first_name;
        try{
            DB::table('church_classes')
            ->where('id', '=', $id)
            ->delete();   
            // Store Message in Flash
            $request->session()->flash('msg','The group '. $name . 'has been deleted successfully');

            //Redirect
            return redirect ('groups');
        }catch(Exception $e){
             //if email or phone exist before in db redirect with error messages
                return redirect()->back()->with('msg','Error. Check if group has not be assigned.');
            }
         
        }

        $request->session()->flash('msg',"Error!!!. No Record to Delete");

        //Redirect
        return redirect ('groups');
    }
}
