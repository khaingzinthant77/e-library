@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>Rack</h1>
      <ol class="breadcrumb">
         <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
         <li><a href="{{route('rack.index')}}">Rack</a></li>
         <li class="active">Edit</li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-mytheme">
         <div class="row">
            <div class="col-md-6">
               <form role="form" method="post" enctype="multipart/form-data" action="{{route('rack.update',$rack->id)}}">
               	@csrf
               	@method('PUT')
                  <div class="box-body">
                     <div class="form-group ">
                        <label for="name">Name</label> <span class="text-red">*</span>
                        <input type="text" class="form-control" id="name" name="name" value="{{$rack->name}}" placeholder="Enter name">
                                             </div>
                     <div class="form-group ">
                        <label for="description">Description</label> <span class="text-red">*</span>
                        <textarea name="description" value="" id="" cols="30" rows="5" class="form-control" placeholder="Enter description">{{$rack->description}}</textarea>
                                             </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" class="btn btn-mytheme">Update Rack</button>
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