@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
            <section class="content-header">
               <h1>Author</h1>
               <ol class="breadcrumb">
                  <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li><a href="{{route('authors.index')}}">Author</a></li>
                  <li class="active">Add</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="row">
                     <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('authors.store')}}">
                           @csrf
                           @method('post')
                           <div class="box-body">
                              <div class="form-group ">
                                 <label for="name">Name</label> <span class="text-red">*</span>
                                 <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter name" required>
                              </div>
                              <div class="form-group ">
                                 <label for="dateofbirth">Date of birth</label> <span class="text-red">*</span>
                                 <input type="text" class="form-control datepicker" id="dateofbirth" name="dateofbirth" value="" placeholder="Enter date of birth" required>
                              </div>
                              <div class="form-group ">
                                 <label>Gender</label> <span class="text-red">*</span>
                                 <select name="gender" id="gender" class="form-control" required>
                                    <option value="">Please Select</option>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                 </select>
                              </div>
                              
                              <div class="form-group">
                                 <label for="p_data">Personal Data</label> <span class="text-red">*</span>
                                 <textarea name="p_data" value="" id="" cols="30" rows="5" class="form-control" placeholder="Enter p_data" required></textarea>
                              </div>
                             
                              <div class="form-group ">
                                 <label for="photo">Photo</label>
                                 <div class="input-group image-preview">
                                    <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                    <span class="input-group-btn">
                                       <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                       <span class="fa fa-remove"></span>Clear						                </button>
                                       <div class="btn btn-success image-preview-input">
                                          <span class="fa fa-repeat"></span>
                                          <span class="image-preview-input-title">File Browse</span>
                                          <input type="file" accept="image/png, image/jpeg, image/gif" name="photo"/>
                                       </div>
                                    </span>
                                 </div>
                              </div>
                              
                           <div class="box-footer">
                              <button type="submit" class="btn btn-mytheme">Add Author</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </section>
         </div>
@endsection
@section('js')
<script src="{{ asset('/assets/custom/js/member.js')}}"></script>
<script type="text/javascript">
   if ($.fn.DataTable) {
        $('#example1').DataTable({
            'pageLength':15,
            'ordering': false
        });

        $('.mainpermission').DataTable({
            paging: false
        });

    }
    if ($.fn.datepicker) {
       $('.datepicker').datepicker({
           autoclose: true,
           format : 'dd-mm-yyyy',
       });
   }
   var globalFilebrowse = "File Browse";
</script>
@endsection