@extends('backend.layouts.main')
@section('content')
<link rel="stylesheet" href="{{asset('assets/custom/css/ebook.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/toastr/toastr.min.css')}}">
<div class="content-wrapper">
            <section class="content-header">
               <h1>Ebook</h1>
               <ol class="breadcrumb">
                  <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li class="active">Ebook</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="box-header">
                     <a href="{{route('e_books.create')}}" class="btn btn-inline btn-mytheme btn-md"><i class="fa fa-plus"></i>Add Ebook</a>
                  </div>
                  <div class="box-body">
                     <div class="mainebook">
                        <div class="row">
                            @foreach($e_books as $key=>$e_book)
                               <div class="col-lg-4 col-md-6 col-sm-12">
                                  <div class="single-ebook">
                                     <div class="single-ebook-img">
                                        <img src="{{asset($e_book->cover_path.$e_book->cover_photo)}}" class="img-fluid" alt="">
                                        <div class="single-overlay">
                                           <div class="icon-info">
                                              <h6><b>Name :</b> {{$e_book->name}}</h6>
                                              <h6><b>Author :</b> {{$e_book->author_name}}</h6>
                                              <h6><b>Publish Date :</b> 
                                                @if($e_book->publish_date != null)
                                                {{date('d-m-Y',strtotime($e_book->publish_date))}}</h6>
                                                @endif
                                              <!-- <p>{{$e_book->remark}}</p> -->
                                           </div>
                                           <div class="icon-item">
                                              <ul>
                                                 <li><a href="{{route('e_books.edit',$e_book->id)}}"><i class="fa fa-edit"></i></a></li>
                                                 <li><a href="{{route('e_books.show',$e_book->id)}}"><i class="fa fa-eye"></i></a></li>
                                                 <li><a href="{{ route('e_books.destroy', ['id' => $e_book->id]) }}" onclick="return confirm('you are about to delete a record. This cannot be undone. are you sure?')"><i class="fa fa-trash"></i></a></li>
                                              </ul>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                           @endforeach
                        </div>
                        <div class="row">
                           <div class="col-sm-12">
                           </div>
                        </div>
                     </div>
                  </div>
                  {!! $e_books->appends(request()->input())->links() !!}
               </div>
            </section>
         </div>
         <div class="control-sidebar-bg"></div>
@endsection

@section('js')
<script type="text/javascript">
         if ($.fn.datepicker) {
             $('.datepicker').datepicker({
                 autoclose: true,
                 format : 'dd-mm-yyyy',
             });
         }
         var globalFilebrowse = "File Browse";
      </script>

      <script src="{{ asset('/assets/custom/js/custom.js')}}"></script>
      <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
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