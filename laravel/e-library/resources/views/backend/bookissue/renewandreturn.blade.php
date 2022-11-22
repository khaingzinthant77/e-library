@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>Book Issue</h1>
      <ol class="breadcrumb">
         <li><a href="https://library.greensoftbd.xyz/dashboard/index"><i class="fa fa-dashboard"></i>Dashboard</a></li>
         <li><a href="https://library.greensoftbd.xyz/bookissue/index">Book Issue</a></li>
         <li class="active">Return And Renew</li>
      </ol>
   </section>
   <section class="content">
      <div class="row">
         <div class="col-md-3">
            <div class="box box-mytheme">
               <form role="form" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="form-group ">
                        <label for="bookstatusID">Book Status</label> <span class="text-red">*</span>
                        <select name="bookstatusID"  id="bookstatusID" class="form-control">
                           <option value="0">Please Select</option>
                           <option value="1">Renew</option>
                           <option value="2">Return</option>
                           <option value="3">Lost</option>
                        </select>
                     </div>
                     <div class="form-group ">
                        <label for="fineamount">Fine Amount</label> <span class="text-red">*</span>
                        <input type="text" class="form-control" id="fineamount" name="fineamount" value="" placeholder="Enter fine amount">
                        <span class="help-block lostbookerror" style="color: #a94442"></span>
                     </div>
                     <div class="form-group ">
                        <label for="notes">Notes</label>
                        <textarea name="notes"  id="notes" cols="30" rows="5" class="form-control" placeholder="Enter Notes"></textarea>
                     </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" class="btn btn-mytheme">Add Fine And Return</button>
                  </div>
               </form>
            </div>
            <div class="box box-mytheme">
               <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="https://library.greensoftbd.xyz/uploads/member/default.png" alt="Galib Mia profile picture">
                  <h3 class="profile-username text-center">Galib Mia</h3>
                  <p class="text-muted text-center">Member</p>
                  <ul class="list-group list-group-unbordered">
                     <li class="list-group-item">
                        <b>Gender</b> <span class="pull-right">Male</span>
                     </li>
                     <li class="list-group-item">
                        <b>Phone</b> <span class="pull-right">123456</span>
                     </li>
                     <li class="list-group-item">
                        <b>Email</b> <span class="pull-right">galib@gmail.com</span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-9">
            <div class="nav-tabs-custom">
               <ul class="nav nav-tabs">
                  <li class="active"><a href="#renewhistory" data-toggle="tab">Renew History</a></li>
                  <li class=""><a href="#bookissue" data-toggle="tab">Book Issue</a></li>
                  <li><a href="#paymentinformation" data-toggle="tab">Payment Information</a></li>
               </ul>
               <div class="tab-content">
                  <div class="active tab-pane" id="renewhistory">
                     <div class="row">
                        <div class="col-md-12">
                           <h3 style="margin-top: 0px">Book Renew History </h3>
                           <div id="hide-table">
                              <table id="example1" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Book Status</th>
                                       <th>Renewed</th>
                                       <th>Fine Amount</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td data-title="#">1</td>
                                       <td data-title="Book Status">
                                          Issued       
                                       </td>
                                       <td data-title="Renewed">1</td>
                                       <td data-title="Fine Amount">0.00</td>
                                    </tr>
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <th>#</th>
                                       <th>Book Status</th>
                                       <th>Renewed</th>
                                       <th>Fine Amount</th>
                                    </tr>
                                 </tfoot>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class=" tab-pane" id="bookissue">
                     <div class="row">
                        <div class="col-md-12">
                           <h3 style="margin-top: 10px">Book Issue Information :</h3>
                           <div class="profile_view_item">
                              <p><b>Book Name</b> : Pride and Prejudice</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Book Code No</b> : 33333</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Book No</b> : 17</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Book Status</b>:
                                 <span class="text-bold text-success">
                                 Issued                                            </span>
                              </p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Issue Date</b>: 22 Jul 2020</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Expire Date</b>: 01 Aug 2020</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Renewed Time</b>: 1 / 10</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Fine Per Day</b>: 10.00</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Fine Amount</b>: 0.00</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Discount Amount</b>: 0.00</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Payment Amount</b>: 0.00</p>
                           </div>
                           <div class="profile_view_item">
                              <p><b>Due Amount</b>: 
                                 0.00                                        
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="paymentinformation">
                     <div class="row">
                        <div class="col-md-12">
                           <h3 style="margin-top: 0px">Book Issue Payment Information </h3>
                           <p class="text-danger">Payment and discount data not found.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
@endsection
@section('js')
<script type="text/javascript">
            var bookissueID  = "7";
</script> 
<script type="text/javascript">
         if ($.fn.datepicker) {
             $('.datepicker').datepicker({
                 autoclose: true,
                 format : 'dd-mm-yyyy',
             });
         }
         var globalFilebrowse = "File Browse";
</script>
<script src="{{ asset('/assets/custom/js/bookissue.js')}}"></script>
@endsection