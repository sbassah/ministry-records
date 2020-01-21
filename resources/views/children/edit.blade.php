@extends('layouts.master')

@section('content')
<div class="container">
                @if (session()->has('msg'))
                <div class="alert alert-success my-2">
                    {{session()->get('msg')}}
                </div> 
                @endif
    <div class="row justify-content-center my-2">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header"><h3>Edit Child </h3>

                </div>
                <div class="card-body">
                
                              
                                <div class="row">
                                        <div class="col-md-6">
                                                <h3>  {{$child_guardians[0]->first_name}} {{$child_guardians[0]->last_name }}</h3>
                                               <h4> Age:  {{ date_diff(date_create($child_guardians[0]->date_of_birth), 
                                                       date_create('now'))->y}}   </h4>
                                        </div>
                                        <div class="col-md-6">
                                                        <img src="{{url('/uploads/children').'/'.
                                                        $child_guardians[0]->photo}}" height="200px"  class="img-circle elevation-2"/>
                                        </div> 
                                </div>
                                {!! Form::open(['url' => ['children', $child_guardians[0]->id], 'files'=>'true', 'method'=> 'put']) !!}
                                @csrf
                                <div class="row">
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                  

                                                      {{Form::label('first_name', 'First Name')}}
                                                      {{ Form::text('first_name',$child_guardians[0] ? $child_guardians[0]->first_name :'', ['class'=>'form-control', 'required'])}}
                                                 
                                                      @error('first_name')
                                                         <span style="color:red">{{ $message }}</span>
                                                      @enderror
                                             </div>
                                     </div>
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                    {{Form::label('last_name', 'Last Name')}}
                                                    {{ Form::text('last_name',$child_guardians[0] ? $child_guardians[0]->last_name :'', ['class'=>'form-control', 'required'])}}
                                               
                                                      @error('last_name')
                                                      <span style="color:red">{{ $message }}</span>
                                                   @enderror
                                             </div>
                                     </div>
                                </div>
                     
                                <div class="row">
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                 
                                                {{Form::label('gender', 'Gender')}}
                                                    {{Form::select('gender', ['male'=>'Male', 'female'=>'Female'], $child_guardians[0] ? $child_guardians[0]->gender : '', ['class'=>'form-control', 'required'])}}
                                        
                                                     @error('gender')
                                                     <span style="color:red">{{ $message }}</span>
                                                  @enderror
                                             </div>
                                     </div>
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                   
                                                      {{Form::label('date_of_birth', 'Date of Birth')}}
                                                      {{ Form::date('date_of_birth',$child_guardians[0] ? $child_guardians[0]->date_of_birth :'', ['class'=>'form-control', 'required'])}}
                                                      

                                                      @error('date_of_birth')
                                                      <span style="color:red">{{ $message }}</span>
                                                   @enderror
                                             </div>
                                     </div>
                                </div>
                     
                             
                                <div class="row">
                                     <div class="col-md-6">
                                             <div class="form-group">
                                                     
                                                     {{Form::label('church_class', 'Class in Church')}}
                                                     {{Form::select('church_class',$church_class , $child_guardians[0] ? $child_guardians[0]->church_class_id : '', ['class'=>'form-control', 'required'])}}
                                     
                                                     @error('church_class')
                                                     <span style="color:red">{{ $message }}</span>
                                                  @enderror
                                             </div>
                                     </div>
                                     <div class="col-md-6">
                                            <div class="form-group">
                                                    {{Form::label('name_of_school', 'Name of School')}}
                                                    {{ Form::text('name_of_school',$child_guardians[0] ?$child_guardians[0]->school_name :'', ['class'=>'form-control'])}}
                                                        
                                                     @error('name_of_school')
                                                     <span style="color:red">{{ $message }}</span>
                                                  @enderror
                                            </div>
                                    </div>

                                    
                                </div>
                                
                                
                             
                                <div class="row">
                                                
                                              
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                             
                                                                {{Form::label('school_class', 'Class in School')}}
                                                                {{Form::select('school_class',$school_class , $child_guardians[0] ? $child_guardians[0]->school_class_id : '', ['class'=>'form-control'])}}
                                                
                                                                @error('school_class')
                                                                <span style="color:red">{{ $message }}</span>
                                                             @enderror
                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                                <div class="form-group">
                                                                        {{Form::label('photo', 'Upload Picture')}}
                                                                        {{Form::file('photo', ['class'=>'form-control'])}}
                                                                
                                                                         @error('photo')
                                                                         <span style="color:red">{{ $message }}</span>
                                                                      @enderror
                                                                </div>
                                                        </div>
                                           
                                </div>

                                <div class="row">
                                                <div class="col-md-12">
                                                                <div class="form-group">
                                                                       {{Form::label('address', 'Residential Location')}}
                                                                           <textarea name="address" id="address" 
                                                                       cols="30" placeholder="Enter Residential Location"  
                                                                       rows="5" class="form-control">{{$child_guardians[0]? $child_guardians[0]->home_address :''}}</textarea>
                                                                        @error('address')
                                                                        <span style="color:red">{{ $message }}</span>
                                                                     @enderror
                                                                </div>
                                                        </div>
                                </div>

                                <button type="submit"  class="btn btn-primary">Update Record</button>

                               
                            </form>
                </div>
             
            </div>
        </div>

        <div class="col-md-5">
                <div class="card">
                        <div class="card-header"><h3>Guardians </h3></div>
                        <div class="card-body table-responsive">
                                <table class="table table-hover">
                                        <thead>
                                                <tr>
                                                <th>Name</th>
                                                <th> </th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                
                                        @foreach($child_guardians[0]->guardians as $guardian)
                                        <tr> 
                                                <td><img src="{{url('/uploads/guardians').'/'.$guardian->photo}}"
                                                         width="50px" class="img-circle elevation-2" /></td>
                                                <td>    <a href="{{url('/guardians/'.$guardian->id)}}">
                                                                {{$guardian->full_name}}
                                                        </a><br/>
                                                        {{$guardian->pivot->relationship}}
                                                </td>
                                                <td> 
                                                <a href="{{url('/child/guardian/'.$guardian->pivot->child_id.'/'.
                                                        $guardian->pivot->guardian_id)}}"
                                                        onclick="return confirm('Are you sure, you want to delete it?')">
                                                        <i class="fa fa-trash red"></i>
                                                </a>
                                                </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                </table>
                       
                                <h4> Add/Update Guardian </h4>
                                {!! Form::open(['url' => ['child/guardian']]) !!}

                                <div class="row">
                                        <div class="col-md-12">

                                                <div class="form-group">
                                                        
                                                                <input type="hidden" name="child_id" value="{{$child_guardians[0]->id}}" />
                                                        {{Form::label('guardian_name', 'Name of Guardian')}}
                                                        {{Form::select('guardian',$guardians ,
                                                                                '', ['class'=>'form-control select2', 'required',
                                                                                'style'=>'width: 100%'])}}
                                                
                                                </div>
                                        </div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                        

                                                {{Form::label('relationship', 'Relationship')}}
                                                {{Form::select('relationship', ['Father'=>'Father', 'Mother'=>'Mother', 
                                                                        'Uncle'=>'Uncle', 'Aunty'=>'Aunty', 'Other'=> 'Other'],
                                                                        '', ['class'=>'form-control', 'required'])}}
                                        
                                                </div>
                                                <button type="submit"  class="btn btn-primary">Update Guardian</button>
                                       
                                        </div>
                                </div>
                          </form>
                        </div>
                </div>     
        </div>
    </div>
</div>
@endsection
