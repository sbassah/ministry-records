<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
       
        $data = array(
            'users' => $users,
        );
        return view('users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'name' => 'required |string | max:255',
            'type' => 'required| string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required | string | min:8 | confirmed',
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'password' => Hash::make($request['password']),
           ]);

                 //Sesion Messege
       $request->session()->flash('msg', 'New user Account has been created.');

       //Redirect
       return redirect('users');
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
        $user = User::find($id);
        $data = array(
            'user' => $user,
        );
        return view('users.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required |string | max:255',
            'type' => 'required| string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'sometimes | string | min:8 | confirmed',
        ]);
       
            if($user){
                $password = Hash::make($request['password']);
                if($request->password == ''){
                  $password = $user->password;
                }
                $user->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'type' => $request['type'],
                    'password' => $password,
                   ]);
            }
            $request->session()->flash('msg', "User account has been Updated successfully");
            //Redirect
            return redirect ('users');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        if($user){
            
          DB::table('users')
            ->where('id', '=', $id)
            ->delete();   
            // Store Message in Flash
            $request->session()->flash('msg', "User account has been deleted successfully");

            //Redirect
            return redirect ('users');
        }

        $request->session()->flash('msg',"Error!!!. No Record to Delete");

        //Redirect
        return redirect ('users');
       
    }

    public function show_password(){

        return view('users.change_password');
    }

    public function change_password(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
                    //Sesion Messege
       $request->session()->flash('msg', 'Password change successfully.');

       //Redirect
       return redirect('/change-password');    }
}
