@extends('backend.layouts.main')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}">
<?php 
   $book_id = isset($_GET['book_id']) ? $_GET['book_id'] : ""
 ?>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Request Book List</h1>
      <ol class="breadcrumb">
         <li><a href="/"><i class="fa fa-dashboard"></i>Dashboard</a></li>
         <li class="active">Request Book List</li>
      </ol>
   </section>
   <section class="content">
      <div class="box box-mytheme">
         
         <div class="box-body">
            <div id="hide-table">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Book Name</th>
                        <th>Author Name</th>
                        <th>Member Name</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($request_books as $key=>$request_book)
                     <tr>
                        <td data-title="#">{{++$i}}</td>
                        <td data-title="Book">{{$request_book->book_name}}</td>
                        <td data-title="Name">{{$request_book->author_name}}</td>
                        <td>{{$request_book->member_name}}</td>
                        </tr>
                     @endforeach
                     
                  </tbody>
                  
               </table>
               {!! $request_books->appends(request()->input())->links() !!}
            </div>
         </div>
      </div>
   </section>
</div>
@endsection
@section('js')
<script src="{{asset('assets/custom/js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/plugins/select2/dist/js/select2.js')}}"></script>

<script type="text/javascript">
   if ($.fn.datepicker) {
       $('.datepicker').datepicker({
           autoclose: true,
           format : 'dd-mm-yyyy',
       });
   }
  

   $('#book_id').select2({
        allowClear: true,
        placeholder: 'Select Author'
    });

   $('#book_id').change(function(){
     this.form.submit();
   });

</script>
@endsection