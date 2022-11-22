@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
       <h1>Role</h1>
       <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
          <li><a href="{{url('roles/')}}">Role</a></li>
          <li class="active">Add</li>
       </ol>
    </section>
    <section class="content">
       <div class="box box-mytheme">
          <div class="row">
             <div class="col-md-6">
                <form role="form" method="post" enctype="multipart/form-data" action="{{route('roles.update',$role->id)}}">

                  @csrf
                  @method('PATCH')
                   <div class="box-body">
                      <div class="form-group ">
                         <label for="name">Name</label> <span class="text-red">*</span>
                         <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}" placeholder="Enter name" required>
                      </div>
                      <div class="form-group col-md-12">
                         <table class="table table-bordered styled-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Read</th>
                                <th>Create</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $i=>$permission)
                        @php
                            $ids = explode(',', $permission->ids);
                            $strArr = explode(',', $permission->name);
                        @endphp
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $permission->model }}</td>
                            @foreach($ids as $k=>$id)
                            <td>
                                 <label>{{ Form::checkbox('permission[]', $id, in_array($id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                </label>
                            </td>
                            @endforeach
                        </tr>
                    @endforeach
                        </tbody>    
                    </table>
                      </div>
                   </div>
                   <div class="box-footer">
                      <button type="submit" class="btn btn-mytheme">Update Role</button>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </section>
 </div>
@endsection
@section('js')
<script type="text/javascript">
   if ($.fn.datepicker) {
       $('.datepicker').datepicker({
           autoclose: true,
           format : 'dd-mm-yyyy',
       });
   }
   var globalFilebrowse = "File Browse";
</script>
<script src="{{ asset('/assets/custom/js/member.js') }}"></script>
<script src="{{ asset('/assets/custom/js/fileupload.js') }}"></script>
@endsection