@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>Book</h1>
      <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
         <li class="active">Book</li>
      </ol>
    </section>
    <section class="content">
        <div class="box box-mytheme">
                        <div class="box-header">
                <a href="{{route('physical_books.create')}}" class="btn btn-inline btn-mytheme btn-md"><i class="fa fa-plus"></i> Add Book</a>
            </div>
                        <div class="box-body">
                <div id="hide-table">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code No</th>
                                <th>Cover Photo</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Total Qty</th>
                                <th>Rent Qty</th>
                                <th>Remain Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($book_lists as $key=>$list)
                                <tr>
                                    <td data-title="#">{{++$i}}</td>
                                    <td data-title="Code No">{{$list->code_no}}</td>
                                    <td data-title="Cover Photo"><img src="{{asset($list->path.$list->cover_photo)}}" class="profile_img" alt=""></td>
                                    <td>{{$list->cat_name}}</td>
                                    <td data-title="Name">{{$list->name}}</td>
                                    <td data-title="Author">{{$list->author_name}}</td>
                                    <td data-title="Quantity">{{$list->qty}}</td>
                                    <td>{{$list->rent_count}}</td>
                                    <td>
                                        <?php 
                                            $remail_count = $list->qty - $list->rent_count;
                                         ?>
                                         {{$remail_count}}
                                    </td>
                                    <td data-title="Action">
                                        <form action="{{route('physical_books.destroy',$list->id)}}" method="post" onsubmit="return confirm('Do you want to delete?');">
                                           @csrf
                                           @method('DELETE')
                                           <a href="{{route('qr_generate',$list->id)}}" class='btn btn-info btn-xs' data-placement='auto' data-toggle='tooltip' data-original-title='QR Generate'><i class='fa fa-qrcode'></i></a>
                                           
                                            <a href="{{route('physical_books.show',$list->id)}}" class='btn btn-success btn-xs' data-placement='auto' data-toggle='tooltip' data-original-title='View'><i class='fa fa-eye'></i></a>
                                            <a href="{{route('physical_books.edit',$list->id)}}" class='btn btn-warning btn-xs' data-placement='top' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></a> 
                                            <button class="btn btn-xs btn-danger" type="submit">
                                                <i class="fa fa-fw fa-trash" title="Delete"></i>
                                            </button>
                                        </form>
                                        </td>
                                    </tr>
                            @endforeach                     
                            </tbody>
                        
                    </table>
                    {!! $book_lists->appends(request()->input())->links() !!}
                </div>
            </div>
          </div>
    </section>
</div>
@endsection

@section('js')
@endsection