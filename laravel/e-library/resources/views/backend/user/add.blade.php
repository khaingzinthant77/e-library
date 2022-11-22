@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
       <h1>Member</h1>
       <ol class="breadcrumb">
          <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
          <li><a href="{{url('member/')}}">Member</a></li>
          <li class="active">Add</li>
       </ol>
    </section>
    <section class="content">
       <div class="box box-mytheme">
          <div class="row">
             <div class="col-md-6">
                <form role="form" method="post" enctype="multipart/form-data" action="{{route('users.store')}}">
                  @csrf
                  @method('POST')
                   <div class="box-body">
                      <div class="form-group ">
                         <label for="name">Name</label> <span class="text-red">*</span>
                         <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter name" required>
                      </div>
                     
                      <div class="form-group ">
                         <label for="phone">Phone</label> <span class="text-red">*</span>
                         <input type="text" class="form-control" id="phone" name="phone" value="" placeholder="Enter phone" required>
                      </div>

                      <div class="form-group ">
                         <label for="email">Email</label>
                         <input type="text" class="form-control" id="email" name="email" value="" placeholder="Enter email" required>
                      </div>
                      
                      <div class="form-group ">
                         <label for="status">Status</label> <span class="text-red">*</span>
                         <select name="status" id="status" class="form-control" required>
                            <option value="0">Please Select</option>
                            <option value="1">Active</option>
                            <option value="2">Block</option>
                         </select>
                      </div>
                      
                      <div class="form-group ">
                         <label for="password">Password</label> <span class="text-red">*</span>
                         <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" value="" placeholder="Enter Password" required>
                            <span style="cursor: pointer;" class="input-group-addon" id="generate_password"><i class="fa fa-repeat"></i></span>
                            <span style="cursor: pointer;" class="input-group-addon" id="showpassword"><i class="fa fa-eye" id="eyeicon"></i></span>
                         </div>
                      </div>
                      <div class="form-group ">
                         <label for="roles">Roles</label> <span class="text-red">*</span>
                         <select name="roles" id="roles" class="form-control" required>
                            <option value="">Please Role</option>
                            @foreach($roles as $key=>$role)
                            <option value="{{$role}}">{{$role}}</option>
                            @endforeach
                         </select>
                      </div>

                   </div>
                   <div class="box-footer">
                      <button type="submit" class="btn btn-mytheme">Add Member</button>
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