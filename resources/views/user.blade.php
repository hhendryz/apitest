@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary" id="my-card">
            <div class="card-header">
                <h3 class="card-title">User Form</h3>

            </div>
            @if(Session::get('success'))
                <x-adminlte-alert theme="success" title="message" dismissable>
                    {{ Session::get('success') }}
                </x-adminlte-alert>
            @elseif(Session::get('error'))
                <x-adminlte-alert theme="error" title="message" dismissable>
                    {{ Session::get('error') }}
                </x-adminlte-alert>
            @endif
            {!! Form::open(['url' => route('user.store') ,'id' => 'myform', 'method' => 'post']) !!}
                <div class="card-body">
                    <div class="form-group">
                        <label for="InputEmail1">Email address</label>
                        <input type="email" class="form-control" id="InputEmail1" name="email" placeholder="Enter email" value="@if(isset($curruser)) {{ $curruser->email }} @elseif(old('email')) {{ old('email') }} @endif ">
                        @if ($errors->has('email'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="InputPassword1">Password</label>
                        <input type="password" class="form-control" id="InputPassword1" name="password" placeholder="Password" value="{{ isset($curruser) ? $curruser->password : (old('password')) ? old('password')  : "" }}">
                         @if ($errors->has('password'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="InputName1">Name</label>
                        <input type="text" class="form-control" id="InputName1" name="name" placeholder="Enter name" value="{{ isset($curruser) ? $curruser->name : (old('name')) ? old('name')  : ""}}">
                         @if ($errors->has('name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="createbtn">Create</button>
                </div>
            {!! Form::close() !!}


            {!! Form::open(['url' => route('user.update') ,'id' => 'myeditform', 'method' => 'patch', 'style' => "display:none"]) !!}
                <div class="card-body">
                    <div class="form-group">
                        <label for="InputEmail1">Email address</label>
                        <input type="email" class="form-control" id="InputEmail2" name="email" placeholder="Enter email" value="@if(isset($curruser)) {{ $curruser->email }}
                        @elseif(old('email')) {{ old('email') }} @endif ">
                        @if ($errors->has('email'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="InputPassword1">Password</label>
                        <input type="password" class="form-control" id="InputPassword2" name="password" placeholder="Password" value="{{ isset($curruser) ? $curruser->password : (old('password')) ? old('password')  : "" }}">
                         @if ($errors->has('password'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="InputName1">Name</label>
                        <input type="text" class="form-control" id="InputName2" name="name" placeholder="Enter name" value="{{ isset($curruser) ? $curruser->name : (old('name')) ? old('name')  : ""}}">
                         @if ($errors->has('name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="editbtn" >Update</button>
                    <button type="button" class="btn btn-success" id="newbtn" onclick="clearform()">New</button>
                    <input type="hidden" name="id" id="iduser" value="">
                </div>
            {!! Form::close() !!}

            {!! Form::open(['url' => route('user.delete') ,'id' => 'delform', 'method' => 'post']) !!}
                 <input type="hidden" name="id" id="deliduser" value="">
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-6">
         <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">User List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                  <tbody>
                    @foreach ($users as $data)
                      
                            <tr data-widget="expandable-table" aria-expanded="false">
                              <td> {{ $data->name }} <i class="fas fa-pen fa-fw tooltipped" data-toggle="tooltip" title="Edit" onclick="wref({{ $data->id }})"></i>
                                    @if(Auth::user()->id != $data->id)
                                        <i class="fas fa-times fa-fw tooltipped" data-toggle="tooltip" title="Delete" onclick="dref({{ $data->id }})"></i>
                                    @endif
                              </td>
                            </tr>
                            <tr class="expandable-body">
                              <td>
                                <p>
                                  {{ $data->email }}
                                </p>
                              </td>
                            </tr>
                        
                    @endforeach
                 </tbody>
                </table>
            </div>
    </div>
</div>
    

<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Are you sure to delete this user?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        let urlcreate = '{!! route('user.store') !!}';
        let urledit = '{!! route('user.update') !!}';
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            /*$("#my-card").CardRefresh({
                    sources : "admin/user/get",
                    params : { id:1 },
                    responseType : "json"
                });*/

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')}
            });

            $('#myModal').on('shown.bs.modal', function () {
              $('#myInput').trigger('focus')
            })
             
        })
            function clearform(){
                $(':input','#myeditform')
                  .not(':button, :submit, :reset, :hidden')
                  .val('')
                  .prop('checked', false)
                  .prop('selected', false);
                  $('#iduser').val('');
                  $('#myform').show();
                  $('#myeditform').hide();
            }
            function wref(ele){
                $.ajax({
                    url: "users/get",
                      type: 'POST',
                      dataType: 'JSON',
                      data: {
                        _token: $('meta[name=csrf-token]').attr('content'),
                        id: ele,
                      }
                  }).done(function(resp){
                    //retrive data
                    console.log(resp);
                    if(resp.data.id){
                        $('#iduser').val(resp.data.id);
                        $('#InputEmail2').val(resp.data.email);
                        $('#InputName2').val(resp.data.name);
                        $('#myform').hide();
                        $('#myeditform').show();
                    }else{
                        clearform();
                    }
                    
                  });
            }

            function dref(ele){
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    //console.log(result);
                  if (result && !result.dismiss) {
                    $('#deliduser').val(ele);
                    $('#delform').submit();
                    /*Swal.fire(
                      'Deleted!',
                      'Your user has been deleted.',
                      'success'
                    ).then((result) => {
                       
                    })*/
                  }
                })
            }

    </script>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
