@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
            <section class="content-header">
               <h1>Book Category</h1>
               <ol class="breadcrumb">
                  <li><a href="https://library.greensoftbd.xyz/dashboard/index"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li class="active">Book Category</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="box-header">
                     <a href="{{route('categories.create')}}" class="btn btn-inline btn-mytheme btn-md"><i class="fa fa-plus"></i> Add Book Category</a>
                  </div>
                  <div class="box-body">
                     <div id="hide-table">
                        <table id="example1" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Code No</th>
                                 <th>Cover Photo</th>
                                 <th>Name</th>
                                 <!-- <th>Description</th> -->
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                            @foreach($categories as $key=>$category)
                              <tr>
                                 <td data-title="#">{{++$i}}</td>
                                 <td>{{$category->code_no}}</td>
                                 <td data-title="Cover Photo"><img src="{{asset($category->path.$category->photo_name)}}" class="profile_img" alt=""></td>
                                 <td data-title="Name">{{$category->name}}</td>
                                 <!-- <td data-title="Description">{{$category->description}}</td> -->
                                 @if($category->status == 1)
                                 <td data-title="Status"><span class="btn btn-success btn-xs">Active</span></td>
                                 @else
                                 <td data-title="Status"><span class="btn btn-danger btn-xs">Active</span></td>
                                 @endif
                                 <td data-title="Action">
                                    <a href="{{route('categories.edit',$category->id)}}" class='btn btn-warning btn-xs' data-placement='top' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></a>                                            <a href="https://library.greensoftbd.xyz/bookcategory/delete/5" onclick="return confirm('you are about to delete a record. This cannot be undone. are you sure?')" class="btn btn-danger btn-xs" data-placement="top" data-toggle="tooltip" data-original-title="Delete"><i class='fa fa-trash-o'></i></a>                                        
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                           
                        </table>
                        {!! $categories->appends(request()->input())->links() !!}
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