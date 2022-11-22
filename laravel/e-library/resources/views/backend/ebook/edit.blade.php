@extends('backend.layouts.main')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}">
<div class="content-wrapper">
    <section class="content-header">
      <h1>Ebook</h1>
      <ol class="breadcrumb">
         <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
         <li><a href="{{route('e_books.index')}}">Ebook</a></li>
         <li class="active">Add</li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-mytheme">
         <div class="row">
            <div class="col-md-6">
               <form role="form" method="post" enctype="multipart/form-data" action="{{route('e_books.update',$e_book->id)}}">
               	@csrf
               	@method('PUT')
                  <div class="box-body">
                     <div class="form-group ">
                        <label for="name">Name</label> <span class="text-red">*</span>
                        <input type="text" class="form-control" id="name" name="name" value="{{$e_book->name}}" placeholder="Enter Name" required>
                                             </div>
                    <div class="form-group">
                        <label for="category">Category</label> <span class="text-red">*</span>
                       <select class="form-control" id="cat_id" name="cat_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $key=>$category)
                        <option value="{{$category->id}}" {{$e_book->cat_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                       </select>
                       </div>

                     <div class="form-group">
                        <label for="author">Author</label> <span class="text-red">*</span>
                       <select class="form-control" id="author_id" name="author_id">
                       	<option value="">Select Author</option>
                       	@foreach($authors as $key=>$author)
                       	<option value="{{$author->id}}" {{$e_book->author_id == $author->id ? 'selected' : ''}}>{{$author->name}}</option>
                       	@endforeach
                       </select>
                       </div>
                     <div class="form-group ">
                          <label for="coverphoto">Cover Photo</label> <span class="text-red">*</span>
                          <div class="input-group image-preview">
                              <input type="text" class="form-control image-preview-filename" disabled="disabled">
                              <span class="input-group-btn">
                                  <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                      <span class="fa fa-remove"></span>Clear                                </button>
                                  <div class="btn btn-success image-preview-input">
                                      <span class="fa fa-repeat"></span>
                                      <span class="image-preview-input-title">File Browse</span>
                                      <input type="file" accept="image/png, image/jpeg, image/gif" name="coverphoto"/>
                                  </div>
                              </span>
                          </div>
                        </div>
                     <div class="form-group ">
                        <label for="file">File</label> <span class="text-red">*</span>
                         <input type="file" class="form-control" name="file" accept="application/pdf"/>
                    </div>
                    <div class="form-group ">
                        <label for="publisheddate">Published date</label>
                        <input type="text" class="form-control datepicker" id="publisheddate" name="publisheddate" value="{{date('d-m-Y',strtotime($e_book->publish_date))}}" placeholder="Enter Published Date">
                     </div>
                     
                    <div class="form-group">
                        <label for="file">Is Feature</label> <span class="text-red"></span>
                        <select class="form-control" id="is_feature" name="is_feature">
                            <option value="0" {{$e_book->is_feature == 0 ? 'selected' : ''}}>No</option>
                            <option value="1" {{$e_book->is_feature == 1 ? 'selected' : ''}}>Yes</option>
                        </select>
                    </div>

                     <div class="form-group ">
                        <label for="remark">Notes</label>
                        <textarea name="remark" value="" cols="30" rows="5" class="form-control" placeholder="Enter notes">{{$e_book->remark}}</textarea>
                                             </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" class="btn btn-mytheme">Update Ebook</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
    </section>
</div>
@endsection

@section('js')
<script src="{{asset('assets/custom/js/fileupload.js')}}"></script>
<script src="{{asset('assets/custom/js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/select2/dist/js/select2.js')}}"></script>
<script type="text/javascript">
    $.widget.bridge('uibutton', $.ui.button);
    $('[data-toggle="tooltip"]').tooltip();

     $('#author_id').select2({
        allowClear: true,
        placeholder: 'Select Author'
    });

     $('#cat_id').select2({
        allowClear: true,
        placeholder: 'Select Category'
    });

    
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

    if ($.fn.datepicker) {
        $('.datepicker').datepicker({
            autoclose: true,
            format : 'dd-mm-yyyy',
        });
    }
    var globalFilebrowse = "File Browse";

</script>
@endsection