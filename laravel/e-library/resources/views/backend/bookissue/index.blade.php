@extends('backend.layouts.main')
@section('content')
<?php
   $keyword = isset($_GET['keyword'])?$_GET['keyword']:'';
?>
<div class="content-wrapper">
            <section class="content-header">
               <h1>Book Issue</h1>
               <ol class="breadcrumb">
                  <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li class="active">Book Issue</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="row">
                     <div class="bookissuesearchbox">
                        <div class="col-sm-1">
                           <div class="box-header">
                              <a href="{{route('bookissue.create')}}" class="btn btn-inline btn-mytheme btn-md"><i class="fa fa-plus"></i>  Add Book Issue</a>
                           </div>
                        </div>
                        <div class="col-sm-3 pull-right">
                           <div class="box-body">
                             <form method="get" accept-charset="utf-8" class="form-horizontal" action="{{route('bookissue.index')}}">
                                 @csrf
                                 <div class="input-group">
                                    <input type="text" class="form-control" value="{{ old('keyword',$keyword) }}" name="keyword" placeholder="Filter By Name">
                                    <div class="input-group-btn">
                                       <button type="submit" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> Search</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="box box-mytheme">
                  <div class="box-body">
                     <div id="hide-table">
                        <table id="example1" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Member</th>
                                 <th>Category</th>
                                 <th>Book</th>
                                 <th>Code No</th>
                                 <th>Rent Date</th>
                                 <th>Rent Expire Date</th>
                                 <th>Duration</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($book_issues as $key=>$book_issue)
                              <tr>
                                 <td data-title="#">{{++$i}}</td>
                                 <td data-title="Member">{{$book_issue->member_name}}</td>
                                 <td data-title="Category">{{$book_issue->cat_name}}</td>
                                 <td data-title="Book">{{$book_issue->book_name}}</td>
                                 <td data-title="Book No">{{$book_issue->code_no}}</td>
                                 <td>{{date('d-m-Y',strtotime($book_issue->issue_date))}}</td>
                                 <td>
                                    @if($book_issue->rent_expire != null)
                                    {{date('d-m-Y',strtotime($book_issue->rent_expire))}}
                                    @endif
                                 </td>
                                 <td>
                                    {{$book_issue->read_day}} Days
                                 </td>
                                 <td data-title="Action">
                                    <a href="{{route('bookissue.show',$book_issue->id)}}" class='btn btn-success btn-xs' data-placement='auto' data-toggle='tooltip' data-original-title='View'><i class='fa fa-eye'></i></a>

                                    <a href="{{route('bookissue.edit',$book_issue->id)}}" class='btn btn-warning btn-xs' data-placement='auto' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></a>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                           
                        </table>
                        {!! $book_issues->appends(request()->input())->links() !!}
                     </div>
                  </div>
               </div>
            </section>
         </div>
         <div class="modal fade" id="paymentmodal" tabindex="-1" role="dialog" aria-labelledby="paymentmodaltitle">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <form method="POST" id="paymentform">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="paymentmodaltitle">Add Payment</h4>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group" id="paymentamounterrorDiv">
                                 <label for="paymentamount">Payment Amount</label> <span class="text-red">*</span>
                                 <input type="text" class="form-control" data-paymentamount="0" id="paymentamount" name="paymentamount">
                                 <span class="help-block totalfineamount" style="color: #a94442"></span>
                                 <span id="paymentamounterror"></span>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group" id="discountamounterrorDiv">
                                 <label for="discountamount">Discount Amount</label> <span class="text-red">*</span>
                                 <input type="text" class="form-control" id="discountamount" name="discountamount">
                                 <span id="discountamounterror"></span>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group" id="noteserrorDiv">
                                 <label for="notes">Notes</label>
                                 <textarea class="form-control" name="notes" id="notes" cols="30" rows="3"></textarea>
                                 <span id="noteserror"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submite" class="btn btn-mytheme submitpaymentamount">Submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
@endsection