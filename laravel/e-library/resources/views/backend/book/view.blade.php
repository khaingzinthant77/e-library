@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
            <section class="content-header">
               <h1>Book</h1>
               <ol class="breadcrumb">
                  <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li><a href="{{route('physical_books.index')}}">Book</a></li>
                  <li class="active">View</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="profile_view_item">
                              <p><b>Name</b>: {{$detail->name}}</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Author</b>: {{$detail->author_name}}</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Quantity</b>: {{$detail->qty}}</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Price</b>: {{number_format($detail->price)}}</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Code No</b>: {{$detail->code_no}}</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Book Category</b>: {{$detail->cat_name}}</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Book No</b>: {{$detail->book_no}}</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Rack</b>: {{$detail->rack_name}}</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Edition Number</b>: {{$detail->edition_number}}</p>
                           </div>
                           <div class="profile_view_item">
                            @if($detail->edition_date != null)
                              <p><b>Edition Date</b>: {{date('d-m-Y',strtotime($detail->edition_date))}}</p>
                              @else
                              <p><b>Edition Date</b>: -</p>
                              @endif
                           </div>
                           <div class="profile_view_item">
                              <p><b>Publisher</b>: {{$detail->publisher}}</p>
                           </div>
                           <div class="profile_view_item">
                            @if($detail->publish_date != null)
                              <p><b>Published date</b>: {{date('d-m-Y',strtotime($detail->publish_date))}}</p>
                            @else
                            <p><b>Published date</b>: -</p>
                            @endif
                           </div>
                          
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
@endsection

@section('js')
@endsection