@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
            <section class="content-header">
               <h1>Book Category</h1>
               <ol class="breadcrumb">
                  <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li><a href="{{route('categories.index')}}">Book Category</a></li>
                  <li class="active">Add</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="row">
                     <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('categories.store')}}">
                        	@csrf
                        	@method('POST')
                           <div class="box-body">
                              <div class="form-group ">
                                 <label for="name">Name</label> <span class="text-red">*</span>
                                 <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter name" required>
                              </div>
                              <div class="form-group ">
                                 <label for="code_no">Code No</label> <span class="text-red">*</span>
                                 <input type="text" class="form-control" id="code_no" name="code_no" value="" placeholder="Enter code no" required>
                              </div>
                              <!-- <div class="form-group ">
                                 <label for="description">Description</label> <span class="text-red">*</span>
                                 <textarea name="description" value="" id="" cols="30" rows="5" class="form-control" placeholder="Enter description" required></textarea>
                              </div> -->
                              <div class="form-group ">
                                 <label for="coverphoto">Cover Photo</label>
                                 <div class="input-group image-preview">
                                    <input type="text" class="form-control image-preview-filename" disabled="disabled" required>
                                    <span class="input-group-btn">
                                       <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                       <span class="fa fa-remove"></span>Clear                                  </button>
                                       <div class="btn btn-success image-preview-input">
                                          <span class="fa fa-repeat"></span>
                                          <span class="image-preview-input-title">File Browse</span>
                                          <input type="file" accept="image/png, image/jpeg, image/gif" name="coverphoto"/>
                                       </div>
                                    </span>
                                 </div>
                              </div>
                              <div class="form-group ">
                                 <label for="status">Status</label> <span class="text-red">*</span>
                                 <select name="status" id="status" class="form-control" required>
                                    <option value="0">Please Select</option>
                                    <option value="1">Enable</option>
                                    <option value="2">Disable</option>
                                 </select>
                              </div>
                           </div>
                           <div class="box-footer">
                              <button type="submit" class="btn btn-mytheme">Add Book Category</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </section>
         </div>
@endsection
@section('js')
<script src="{{asset('assets/custom/js/custom.js')}}"></script>
<script src="{{asset('assets/custom/js/fileupload.js')}}"></script>
<script type="text/javascript">
 if ($.fn.datepicker) {
     $('.datepicker').datepicker({
         autoclose: true,
         format : 'dd-mm-yyyy',
     });
 }
 var globalFilebrowse = "File Browse";
</script>
<script type="text/javascript">
         $.widget.bridge('uibutton', $.ui.button);
         $('[data-toggle="tooltip"]').tooltip();
         
         
         $( document ).ready(function() {
             if ($.fn.DataTable) {
                 $('#example1').DataTable({
                     'pageLength':15,
                     'ordering': false
                 });
         
                 $('.mainpermission').DataTable({
                     paging: false
                 });
             }
         });
         
      </script>

@endsection