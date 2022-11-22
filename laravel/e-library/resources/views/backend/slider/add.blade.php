@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
            <section class="content-header">
               <h1>Slider</h1>
               <ol class="breadcrumb">
                  <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li><a href="{{route('sliders.index')}}">Slider</a></li>
                  <li class="active">Add</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="row">
                     <div class="col-md-6">
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('sliders.store')}}">
                           @csrf
                           @method('post')
                           <div class="box-body">
                              <div class="form-group ">
                                 <label for="title">Title</label> <span class="text-red">*</span>
                                 <input type="text" class="form-control" id="title" name="title" value="" placeholder="Enter title" required>
                              </div>
                             
                              <div class="form-group ">
                                 <label for="photo">Photo</label><span class="text-red">*</span>
                                 <div class="input-group image-preview">
                                    <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                    <span class="input-group-btn">
                                       <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                       <span class="fa fa-remove"></span>Clear						                </button>
                                       <div class="btn btn-success image-preview-input">
                                          <span class="fa fa-repeat"></span>
                                          <span class="image-preview-input-title">File Browse</span>
                                          <input type="file" accept="image/png, image/jpeg, image/gif" name="slider_photo"/>
                                       </div>
                                    </span>
                                 </div>
                              </div>
                              
                           <div class="box-footer">
                              <button type="submit" class="btn btn-mytheme">Add Slider</button>
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
<script src="{{asset('assets/custom/js/fileupload.js')}}"></script>
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