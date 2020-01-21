@extends('layouts.master')

@section('content')
<div class="container">
        @if (session()->has('msg'))
        <div class="alert alert-success my-2">
            {{session()->get('msg')}}
        </div> 
        @endif
    <div class="row justify-content-center my-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Manage Guardians</h3>
                    <div class="card-tools">
                        <a type="button" class="btn btn-primary" href="/guardians/create">
                         <i class="fas fa-user"> New Guardian</i>
                        </a>
                    </div>

                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Phone Number</th>
                          <th>Is a Member</th>
                          <th>Photo</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $k =0; ?>
                        @foreach ($guardians as $guardian)
                        <tr>
                            <td>{{$k +=1}}</td>
                            <td>{{$guardian->salutation}} {{ucfirst($guardian->first_name)}} {{($guardian->last_name)}}</td>
                            <td>{{$guardian->phone_no}}</td>
                            <td>{{$guardian->is_member == 1? 'Yes' : 'No'}}</td>
                            <td> <img src="{{url('/uploads/guardians').'/'.$guardian->photo}}" 
                              class="img-circle elevation-2" height="50px" />
                              
                            </td>
                            <td>

                                {!! link_to_route('guardians.edit', 'Edit', $guardian->id,  ['class' => 'btn btn-info btn-sm']) !!}                               
                                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'guardians.destroy', $guardian->id ],'style' => 'float:right' ]) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger',  'onclick' => 'return confirm("Are you sure you want to delete this record?")']) }}
                            {{ Form::close() }}
                            </td>
                          </tr>
                        @endforeach
                     
                      </tbody>
                    </table>
                  </div>
                  {{ $guardians->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
