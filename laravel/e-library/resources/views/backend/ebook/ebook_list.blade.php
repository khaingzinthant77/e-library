@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
            <section class="content-header">
               <h1>eBook List</h1>
               <ol class="breadcrumb">
                  <li><a href="https://library.greensoftbd.xyz/dashboard/index"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li class="active">eBook List</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="box-header">
                     <a href="{{route('categories.create')}}" class="btn btn-inline btn-mytheme btn-md"><i class="fa fa-plus"></i> Add eBook</a>
                  </div>
                  <div class="box-body">
                     <div id="hide-table">
                        <table id="example1" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Cover Photo</th>
                                 <th>Name</th>
                                 <th>Category</th>
                                 <th>Author</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                            @foreach($e_books as $key=>$e_book)
                            <tr>
                               <td>{{++$i}}</td>
                               <td>
                                 <img src="{{asset($e_book->cover_path.$e_book->cover_photo)}}" class="profile_img" alt="">
                               </td>
                               <td>{{$e_book->name}}</td>
                               <td>{{$e_book->cat_name}}</td>
                               <td>{{$e_book->author_name}}</td>
                               <td>
                                  <form action="{{route('e_books.destroy',$e_book->id)}}" method="post" onsubmit="return confirm('Do you want to delete?');">
                                     @csrf
                                     @method('DELETE')
                                    
                                      <a href="{{route('e_books.show',$e_book->id)}}" class='btn btn-success btn-xs' data-placement='auto' data-toggle='tooltip' data-original-title='View'><i class='fa fa-eye'></i></a>
                                      <a href="{{route('e_books.edit',$e_book->id)}}" class='btn btn-warning btn-xs' data-placement='top' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></a> 
                                      <button class="btn btn-xs btn-danger" type="submit">
                                          <i class="fa fa-fw fa-trash" title="Delete"></i>
                                      </button>
                                  </form>
                               </td>
                            </tr>
                            @endforeach
                           </tbody>
                           
                        </table>
                        {!! $e_books->appends(request()->input())->links() !!}
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