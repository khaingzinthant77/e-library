@extends('backend.layouts.main')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}">
<div class="content-wrapper">
   <section class="content-header">
      <h1>Book Issue</h1>
      <ol class="breadcrumb">
         <li><a href="https://library.greensoftbd.xyz/dashboard/index"><i class="fa fa-dashboard"></i>Dashboard</a></li>
         <li><a href="https://library.greensoftbd.xyz/bookissue/index">Book Issue</a></li>
         <li class="active">Add</li>
      </ol>
   </section>
   <section class="content">
      <div class="box box-mytheme">
         
            <div class="row">
               <div class="col-md-6">
                  <div class="box-body">
                     <div class="form-group ">
                        <label for="memberID">Scan for member</label><span class="text-red">*</span>
                       <input type="text" name="scan_member" id="scan_member" class="form-control" autofocus>
                     </div>
                     <div class="form-group " id="member_name">
                        <label for="member_name">Name</label><span class="text-red">*</span>
                       <input type="text" name="name" id="name" class="form-control" value="{{$data->member_name}}" readonly>
                     </div>
                     <div class="form-group" id="member_ph">
                        <label for="member_ph">Phone No</label><span class="text-red">*</span>
                       <input type="text" name="ph_no" id="ph_no" class="form-control" value="{{$data->ph_no}}" readonly>
                     </div>
                     <div class="form-group" id="member_email">
                        <label for="member_email">Email</label><span class="text-red">*</span>
                       <input type="text" name="email" id="email" class="form-control" value="{{$data->email}}" readonly>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="box-body">
                     <div class="form-group ">
                        <label for="scan_book">Scan for Book</label><span class="text-red">*</span>
                       <input type="text" name="scan_book" id="scan_book" class="form-control">
                     </div>
                     <div class="form-group" id="b_name">
                        <label for="book_name">Book Name</label><span class="text-red">*</span>
                       <input type="text" name="book_name" id="book_name" class="form-control" value="{{$data->book_name}}" readonly>
                     </div>
                     <div class="form-group" id="c_name">
                        <label for="category">Category</label><span class="text-red">*</span>
                       <input type="text" name="cat_name" id="cat_name" class="form-control" value="{{$data->cat_name}}" readonly>
                     </div>
                     <div class="form-group" id="a_name">
                        <label for="author">Author</label><span class="text-red">*</span>
                       <input type="text" value="{{$data->author_name}}" name="author_name" id="author_name" class="form-control" readonly>
                     </div>
                     <div class="form-group" id="r_name">
                        <label for="author">Rack*</label><span class="text-red">*</span>
                       <input type="text" name="rack_name" id="rack_name" class="form-control" value="{{$data->rack_name}}" readonly>
                     </div>
                     <div class="form-group" id="r_day">
                        <label for="read_day">Read Day</label><span class="text-red">*</span>
                       <input type="text" name="read_day" id="read_day" class="form-control" value="{{$data->read_day}}" readonly>
                     </div>

                     <form role="form" method="post" enctype="multipart/form-data" action="{{route('bookissue.update',$data->id)}}">
                     @csrf
                     @method('PUT')
                     <div class="form-group ">
                        <label for="issue_date">Issue Date</label> <span class="text-red">*</span>
                        <input type="text" class="form-control datepicker" id="issue_date" name="issue_date" value="{{date('d-m-Y',strtotime($data->issue_date))}}" placeholder="Enter issue date">
                     </div>
                     <input type="hidden" name="member_id" id="member_id" value="{{$data->member_id}}">
                     <input type="hidden" name="cat_id" id="cat_id" value="{{$data->cat_id}}">
                     <input type="hidden" name="book_id" id="book_id" value="{{$data->book_id}}">
                     <div class="form-group">
                         <label for="bookID">Rent Expire Date</label> <span class="text-red">*</span>
                         @if($data->rent_expire != null)

                         <input type="text" class="form-control datepicker" id="rent_expire" name="rent_expire" placeholder="Rent Expire Date" value="{{date('d-m-Y',strtotime($data->rent_expire))}}">
                         @else

                         <?php 
                              $exp_date = date('Y-m-d', strtotime('+'.($data->read_day - 1).' day', strtotime($data->issue_date)));

                          ?>

                         <input type="text" class="form-control datepicker" id="rent_expire" name="rent_expire" placeholder="Rent Expire Date" value="{{date('d-m-Y',strtotime($exp_date))}}">
                         @endif
                     </div>
                     <div class="form-group">
                        <label>Issue Status</label>
                        <select class="form-control" id="issue_status" name="issue_status">
                           <option value="0" {{$data->issue_status == 0 ? 'selected' : ''}}>Rent</option>
                           <option value="1" {{$data->issue_status == 1 ? 'selected' : ''}}>Return</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="bookID">Return Date</label>
                         @if($data->return_date != null)
                         <input type="text" class="form-control datepicker" id="return_date" name="return_date" placeholder="Rent Expire Date" value="{{date('d-m-Y',strtotime($data->return_date))}}">
                         @else
                         <input type="text" class="form-control datepicker" id="return_date" name="return_date" placeholder="Enter Return Date">
                         @endif  
                     </div>
                     <div class="form-group ">
                        <label for="notes">Notes</label>
                        <textarea name="notes"  id="notes" cols="30" rows="5" class="form-control" placeholder="Enter Notes">{{$data->remark}}</textarea>
                     </div>
                     <div class="box-footer">
                        <button type="submit" class="btn btn-mytheme">Update Book Issue</button>
                     </div>
                  </form>
                  </div>
               </div>
            </div>
       
      </div>
   </section>
</div>
@endsection
@section('js')
<script src="{{asset('assets/custom/js/bookissue.js')}}"></script>
<script src="{{asset('assets/custom/js/fileupload.js')}}"></script>
<script src="{{asset('assets/custom/js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/select2/dist/js/select2.js')}}"></script>

<script type="text/javascript">
   if ($.fn.datepicker) {
       $('.datepicker').datepicker({
           autoclose: true,
           format : 'dd-mm-yyyy',
       });
   }
   var globalFilebrowse = "File Browse";
   
   $(document).ready(function(){
      // $('#member_name').hide();
      // $('#member_ph').hide();
      // $('#member_email').hide();

      // $('#b_name').hide();
      // $('#c_name').hide();
      // $('#a_name').hide();
      // $('#r_name').hide();
   });
   $(function(){
     $("#scan_member").change(function(){
      var member_id = $(this).val();
              $.ajax({
              type: "GET",
              dataType: "json",
              url: "<?php echo route('get_member_data') ?>",
              data: {'member_id': member_id},
              success: function(data){
               // $('#member_name').show();
               // $('#member_ph').show();
               // $('#member_email').show();
               $('#name').val(data.name);
               $('#ph_no').val(data.ph_no);
               $('#email').val(data.email);
               $('#member_id').val(data.id);
               $('#scan_member').val("");
              }
            });
      // alert(cat_id);
      });
  });

  $(function(){
     $("#scan_book").change(function(){
      var book_id = $(this).val();
              $.ajax({
              type: "GET",
              dataType: "json",
              url: "<?php echo route('get_book_data') ?>",
              data: {'book_id': book_id},
              success: function(data){
              // console.log(data);
               $('#b_name').show();
               $('#c_name').show();
               $('#a_name').show();
               $('#r_name').show();

               $('#book_name').val(data.name);
               $('#cat_name').val(data.cat_name);
               $('#author_name').val(data.author_name);
               $('#rack_name').val(data.rack_name);
               $('#read_day').val(data.read_day);

               $('#scan_book').val('');

               $('#cat_id').val(data.cat_id);
               $('#book_id').val(data.book_id);
              }
            });
      // alert(cat_id);
      });
  });  

</script>
@endsection