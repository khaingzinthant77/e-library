@extends('backend.layouts.main')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}">
<div class="content-wrapper">
    <section class="content-header">
      <h1>Book</h1>
      <ol class="breadcrumb">
         <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
         <li><a href="{{route('physical_books.index')}}">Book</a></li>
         <li class="active">Add</li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-mytheme">
      <form role="form" method="post" enctype="multipart/form-data" action="{{route('physical_books.store')}}"> 
         <div class="row">
            <div class="col-md-6">
               
                  @csrf
                  @method('POST')
                  <div class="box-body">
                     <div class="form-group ">
                        <label for="name">Name</label> <span class="text-red">*</span>
                        <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter name">
                    </div>

                     <div class="form-group ">
                        <label for="author">Author</label> <span class="text-red">*</span>
                        <select class="form-control" id="author_id" name="author_id">
                       	<option value="">Select Author</option>
                       	@foreach($authors as $key=>$author)
                       	<option value="{{$author->id}}">{{$author->name}}</option>
                       	@endforeach
                       </select>
                    </div>

                     <div class="form-group ">
                        <label for="quantity">Quantity</label> <span class="text-red">*</span>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="" placeholder="Enter Quantity">
                                             </div>

                     <div class="form-group ">
                        <label for="price">Price</label> <span class="text-red">*</span>
                        <input type="number" class="form-control" id="price" name="price" value="" placeholder="Enter Price">
                     </div>

                     <div class="form-group ">
                        <label for="rackID">Rack</label>
                        <select class="form-control" id="rack_id" name="rack_id">
                           <option value="">Select Rack</option>
                           @foreach($racks as $key=>$rack)
                           <option value="{{$rack->id}}">{{$rack->name}}</option>
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

                     
                     
                  </div>
                 
               
            </div>
            <div class="box-body">
               <div class="col-md-6">
               <div class="form-group ">
                        <label for="bookcategoryID">Book Category</label> <span class="text-red">*</span>

                        <select class="form-control" id="cat_id" name="cat_id">
                           <option value="">Select Category</option>
                           @foreach($categories as $key=>$category)
                           <option value="{{$category->id}}">{{$category->name}}</option>
                           @endforeach
                       </select>
                    </div>
                    <div class="form-group ">
                        <label for="codeno">Code No</label> <span class="text-red">*</span>
                        <input type="text" class="form-control" id="codeno" name="codeno" value="" placeholder="Enter Code No" readonly>
                     </div> 
                     

                      <div class="form-group ">
                        <label for="editionnumber">Edition Number</label>
                        <input type="text" class="form-control" id="editionnumber" name="editionnumber" value="" placeholder="Enter Edition Number">
                     </div>
                     
                     <div class="form-group">
                        <label for="editiondate">Edition Date</label>
                        <input type="text" class="form-control datepicker" id="editiondate" name="editiondate" value="" placeholder="Enter Edition Date">
                     </div>
                     
                     <div class="form-group ">
                        <label for="publisher">Publisher</label>
                        <input type="text" class="form-control" id="publisher" name="publisher" value="" placeholder="Enter Publisher">
                     </div>
                     
                     <div class="form-group">
                        <label for="publisheddate">Published date</label>
                        <input type="text" class="form-control datepicker" id="publisheddate" name="publisheddate" value="" placeholder="Enter Published Date">
                     </div>
                     <div class="form-group">
                        <label for="read_day">Read Day</label>
                        <input type="number" class="form-control" id="read_day" name="read_day" value="" placeholder="Enter read day">
                     </div>
                     <div class="box-footer">
               <button type="submit" class="btn btn-mytheme">Add Book</button>
            </div>
            </div>
             
            </div>
            
           
         </div>

         </form>
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

     $('#rack_id').select2({
        allowClear: true,
        placeholder: 'Select Rack'
    });

     
     $(function(){
        $("#cat_id").change(function(){
         var cat_id = $(this).val();
                 $.ajax({
                 type: "GET",
                 dataType: "json",
                 url: "<?php echo route('generate_book_code') ?>",
                 data: {'cat_id': cat_id},
                 success: function(data){
                    // book_code
                    // console.log(data);
                    $('#codeno').val(data);
                 }
               });
         });
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