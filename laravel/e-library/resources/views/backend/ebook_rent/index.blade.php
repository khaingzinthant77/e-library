@extends('backend.layouts.main')
@section('content')
<?php
   $keyword = isset($_GET['keyword'])?$_GET['keyword']:'';
?>
<div class="content-wrapper">
            <section class="content-header">
               <h1>eBook Rent List</h1>
               <ol class="breadcrumb">
                  <li><a href="https://library.greensoftbd.xyz/dashboard/index"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li class="active">eBook Rent List</li>
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
                                 <th>Member</th>
                                 <th>Category</th>
                                 <th>Book</th>
                                
                                 <th>Rent Date</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($ebook_rents as $key=>$ebook_rent)
                              <tr>
                                 <td data-title="#">{{++$i}}</td>
                                 <td data-title="Member">{{$ebook_rent->member_name}}</td>
                                 <td data-title="Category">{{$ebook_rent->cat_name}}</td>
                                 <td data-title="Book">{{$ebook_rent->book_name}}</td>
                                
                                 <td data-title="rent">
                                    {{date('d-m-Y',strtotime($ebook_rent->rent_date))}}
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                           
                        </table>
                        {!! $ebook_rents->appends(request()->input())->links() !!}
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