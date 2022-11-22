@extends('backend.layouts.main')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}">
<?php 
   $book_id = isset($_GET['book_id']) ? $_GET['book_id'] : ""
 ?>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Favourite</h1>
      <ol class="breadcrumb">
         <li><a href="/"><i class="fa fa-dashboard"></i>Dashboard</a></li>
         <li class="active">Favourite</li>
      </ol>
   </section>
   <section class="content">
      <div class="box box-mytheme">
         <div class="box-header">
          
            <div class="col-sm-3 pull-right">
               <form method="get" accept-charset="utf-8" class="form-horizontal" action="{{route('favourites.index')}}">
                  @csrf
                  <div class="input-group">
                    
                     <select class="form-control" id="book_id" name="book_id">
                        <option value="">All</option>
                        @foreach($e_books as $key=>$e_book)
                        <option value="{{$e_book->id}}" {{ (old('book_id',$book_id)==$e_book->id)?'selected':'' }}>{{$e_book->name}}</option>
                        @endforeach
                     </select>
                    <!--  <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> Search</button>
                     </div> -->
                  </div>
               </form>
            </div>
         </div>
         <div class="box-body">
            <div id="hide-table">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Member Name</th>
                        <th>Book Name</th>
                        <th>Category</th>
                        <th>Author</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($favourites as $key=>$favourite)
                     <tr>
                        <td data-title="#">{{++$i}}</td>
                        <td data-title="Book">{{$favourite->member_name}}</td>
                        <td data-title="Name">{{$favourite->ebook_name}}</td>
                        <td>{{$favourite->cat_name}}</td>
                        <td>{{$favourite->author_name}}</td>
                        </tr>
                     @endforeach
                     
                  </tbody>
                  
               </table>
               {!! $favourites->appends(request()->input())->links() !!}
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