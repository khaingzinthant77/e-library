@extends('backend.layouts.main')
@section('content')

<?php
   $keyword = isset($_GET['keyword'])?$_GET['keyword']:'';
?>

<div class="content-wrapper">
            <section class="content-header">
               <h1>Author</h1>
               <ol class="breadcrumb">
                  <li><a href="url('/"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li class="active">Authors</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="box-header">
                     <a href="{{route('authors.create')}}" class="btn btn-inline btn-mytheme btn-md pull-left"><i class="fa fa-plus"></i> Add Author</a>
                     <div class="col-sm-3 pull-right">
                        <form method="get" accept-charset="utf-8" class="form-horizontal" action="{{route('authors.index')}}">
                           <div class="input-group">
                              <input type="text" class="form-control" value="{{ old('keyword',$keyword) }}" name="keyword" placeholder="Filter By Name">
                              <div class="input-group-btn">
                                 <button type="submit" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> Search</button>
                              </div>
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
                                 <th>Name</th>
                                 <th>Photo</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($authors as $key=>$author)
                              <tr>
                                 <td data-title="#">{{++$i}}</td>
                                 <td data-title="Name">{{$author->name}}</td>
                                 <td data-title="Photo"><img src="{{asset($author->path.$author->photo)}}" class="profile_img" alt=""></td>
                                 
                                 <td data-title="Action">
                                 <form action="{{route('authors.destroy',$author->id)}}" method="post" onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                   <a href="{{route('authors.show',$author->id)}}" class='btn btn-success btn-xs' data-placement='auto' data-toggle='tooltip' data-original-title='View'><i class='fa fa-eye'></i></a>

                                     <a href="{{route('authors.edit',$author->id)}}" class='btn btn-warning btn-xs' data-placement='top' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></a>

                                    <button class="btn btn-xs btn-danger" type="submit">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>
                                </form>

                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                           
                        </table>
                         {!! $authors->appends(request()->input())->links() !!}
                     </div>
                  </div>
               </div>
            </section>
         </div>
@endsection