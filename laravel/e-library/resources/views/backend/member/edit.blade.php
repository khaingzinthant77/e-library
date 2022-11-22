@extends('backend.layouts.main')
@section('content')
 <div class="content-wrapper">
            <section class="content-header">
               <h1>Member</h1>
               <ol class="breadcrumb">
                    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
          			<li><a href="{{url('member/')}}">Member</a></li>
                    <li class="active">Edit</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="row">
                     <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('member.update',$member->id)}}">
                           @csrf
                           @method('PUT')
                           <div class="box-body">
                              <div class="form-group">
                                 <label for="name">Name</label> <span class="text-red">*</span>
                                 <input type="text" class="form-control" id="name" name="name" value="{{$member->name}}" placeholder="Enter name">
                              </div>
                              <div class="form-group ">
                                 <label for="phone">Phone</label> <span class="text-red">*</span>
                                 <input type="text" class="form-control" id="phone" name="phone" value="{{$member->ph_no}}" placeholder="Enter phone">
                              </div>
                             
                              <div class="form-group ">
                                 <label for="email">Email</label> <span class="text-red">*</span>
                                 <input type="text" class="form-control" id="email" name="email" value="{{$member->email}}" placeholder="Enter email">
                              </div>
                              
                              
                              <div class="form-group ">
                                 <label for="status">Status</label> <span class="text-red">*</span>
                                 <select name="status" id="status" class="form-control">
                                    <option value="0">Please Select</option>
                                    <option value="1" {{$member->status == 1 ? 'selected' : ''}}>Active</option>
                                    <option value="2" {{$member->status == 2 ? 'selected' : ''}}>Block</option>
                                 </select>
                              </div>
                             
                              <div class="form-group ">
                                 <label for="password">Password</label>
                                 <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Enter Password">
                                    <span style="cursor: pointer;" class="input-group-addon" id="generate_password"><i class="fa fa-repeat"></i></span>
                                    <span style="cursor: pointer;" class="input-group-addon" id="showpassword"><i class="fa fa-eye" id="eyeicon"></i></span>
                                 </div>
                              </div>
                           </div>
                           <div class="box-footer">
                              <button type="submit" class="btn btn-mytheme">Update Member</button>
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