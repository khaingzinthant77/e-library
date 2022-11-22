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
                       <input type="text" name="name" id="name" class="form-control" readonly>
                     </div>
                     <div class="form-group" id="member_ph">
                        <label for="member_ph">Phone No</label><span class="text-red">*</span>
                       <input type="text" name="ph_no" id="ph_no" class="form-control" readonly>
                     </div>
                     <div class="form-group" id="member_email">
                        <label for="member_email">Email</label><span class="text-red">*</span>
                       <input type="text" name="email" id="email" class="form-control" readonly>
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
                       <input type="text" name="book_name" id="book_name" class="form-control" readonly>
                     </div>
                     <div class="form-group" id="c_name">
                        <label for="category">Category</label><span class="text-red">*</span>
                       <input type="text" name="cat_name" id="cat_name" class="form-control" readonly>
                     </div>
                     <div class="form-group" id="a_name">
                        <label for="author">Author</label><span class="text-red">*</span>
                       <input type="text" name="author_name" id="author_name" class="form-control" readonly>
                     </div>
                     <div class="form-group" id="r_name">
                        <label for="author">Rack</label><span class="text-red">*</span>
                       <input type="text" name="rack_name" id="rack_name" class="form-control" readonly>
                     </div>
                     <div class="form-group" id="r_day">
                        <label for="read_day">Read Day</label><span class="text-red">*</span>
                       <input type="text" name="read_day" id="read_day" class="form-control" readonly>
                     </div>
                     <form role="form" method="post" enctype="multipart/form-data" action="{{route('bookissue.store')}}">
                     @csrf
                     @method('POST')
                     <div class="form-group ">
                        <label for="issue_date">Issue Date</label> <span class="text-red">*</span>
                        <input type="text" class="form-control datepicker" id="issue_date" name="issue_date" value="" placeholder="Enter issue date">
                     </div>
                     <input type="hidden" name="member_id" id="member_id">
                     <input type="hidden" name="cat_id" id="cat_id">
                     <input type="hidden" name="book_id" id="book_id">
                     <div class="form-group">
                         <label for="bookID">Rent Expire Date</label> <span class="text-red">*</span>
                         <input type="text" class="form-control datepicker" id="rent_expire" name="rent_expire" placeholder="Rent Expire Date">
                     </div>
                     <div class="form-group">
                        <label>Issue Status</label>
                        <select class="form-control" id="issue_status" name="issue_status">
                           <option value="0">Rent</option>
                           <option value="1">Return</option>
                        </select>
                     </div>
                     <div class="form-group ">
                        <label for="return_date">Return Date</label>
                        <input type="text" class="form-control datepicker" id="return_date" name="return_date" value="" placeholder="Enter return date">
                     </div>
                     <div class="form-group ">
                        <label for="notes">Notes</label>
                        <textarea name="notes"  id="notes" cols="30" rows="5" class="form-control" placeholder="Enter Notes"></textarea>
                     </div>
                     <div class="box-footer">
                        <button type="submit" class="btn btn-mytheme">Add Book Issue</button>
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
      $('#member_name').hide();
      $('#member_ph').hide();
      $('#member_email').hide();

      $('#b_name').hide();
      $('#c_name').hide();
      $('#a_name').hide();
      $('#r_name').hide();
      $('#r_day').hide();
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
               $('#member_name').show();
               $('#member_ph').show();
               $('#member_email').show();
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
               $('#r_day').show();

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

  $(function(){
   $('#issue_date').change(function(){
      // alert(new Date(3));
     var issue_timestamp  = new Date($(this).val().replace(/^(\d{2}\-)(\d{2}\-)(\d{4})$/,
    '$2$1$3')).getTime();
     var read_day = parseInt($('#read_day').val() - 1) * 24 * 60 * 60 *1000;
     
     var exp_date = issue_timestamp + read_day;

     var date = new Date(exp_date);
      
     

      var day = date.getDate()+"";
      while (day.length < 2) day = "0" + day;
     
       var month = (date.getMonth() + 1)+"";
      while (month.length < 2) month = "0" + month;

      var datestring = day  + "-" + (month) + "-" + date.getFullYear();

      $('#rent_expire').val(datestring);
   });
  })

</script>
@endsection