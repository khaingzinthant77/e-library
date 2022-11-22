@extends('backend.layouts.main')
@section('content')
 <div class="content-wrapper">
            <section class="content-header">
               <h1>Book Issue</h1>
               <ol class="breadcrumb">
                  <li><a href="{{ url('/')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a href="{{ url('/bookissue')}}"> Book Issue</a></li>
                  <li>View</li>
               </ol>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-md-3">
                     <div class="box box-mytheme">
                        <div class="box-body box-profile">
                           <img class="profile-user-img img-responsive img-circle" src="https://library.greensoftbd.xyz/uploads/member/default.png" alt="Member profile picture">
                           <h3 class="profile-username text-center">Member</h3>
                           <p class="text-muted text-center">{{$data->member_name}}</p>
                           <ul class="list-group list-group-unbordered">
                              
                              <li class="list-group-item">
                                 <b>Phone</b> <span class="pull-right">{{$data->ph_no}}</span>
                              </li>
                              <li class="list-group-item">
                                 <b>Email</b> <span class="pull-right">{{$data->email}}</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                           <li class="active"><a href="#bookissue" data-toggle="tab">Book Issue</a></li>
                           <!-- <li><a href="#renewhistory" data-toggle="tab">Renew History</a></li>
                           <li><a href="#paymentinformation" data-toggle="tab">Payment Information</a></li> -->
                        </ul>
                        <div class="tab-content">
                           <div class="active tab-pane" id="bookissue">
                              <div class="row">
                                 <div class="col-md-12">
                                    <h3 style="margin-top: 10px">Book Issue Information :</h3>
                                    <div class="profile_view_item">
                                       <p><b>Book Name</b> : {{$data->book_name}}</p>
                                    </div>
                                    <div class="profile_view_item">
                                       <p><b>Book Code No</b> : {{$data->code_no}}</p>
                                    </div>
                                    <!-- <div class="profile_view_item">
                                       <p><b>Book No</b> : {{$data->book_no}}</p>
                                    </div> -->
                                    <div class="profile_view_item">
                                       <p><b>Book Status</b>:
                                          <span class="text-bold text-success">
                                          Issued
                                       </span>
                                       </p>
                                    </div>
                                    <div class="profile_view_item">
                                       <p><b>Issue Date</b>: {{date('d-m-Y',strtotime($data->issue_date))}}</p>
                                    </div>
                                    <!-- <div class="profile_view_item">
                                       <p><b>Expire Date</b>: 18 Aug 2020</p>
                                    </div>
                                    <div class="profile_view_item">
                                       <p><b>Renewed Time</b>: 3 / 10</p>
                                    </div>
                                    <div class="profile_view_item">
                                       <p><b>Fine Per Day</b>: 10.00</p>
                                    </div>
                                    <div class="profile_view_item">
                                       <p><b>Fine Amount</b>: 100.00</p>
                                    </div>
                                    <div class="profile_view_item">
                                       <p><b>Discount Amount</b>: 0.00</p>
                                    </div>
                                    <div class="profile_view_item">
                                       <p><b>Payment Amount</b>: 0.00</p>
                                    </div>
                                    <div class="profile_view_item">
                                       <p><b>Due Amount</b>: 
                                          100.00                                        
                                       </p>
                                    </div> -->
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane" id="renewhistory">
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
                                                <td data-title="Renewed">3</td>
                                                <td data-title="Fine Amount">50.00</td>
                                             </tr>
                                             <tr>
                                                <td data-title="#">2</td>
                                                <td data-title="Book Status">
                                                   Issued      
                                                </td>
                                                <td data-title="Renewed">2</td>
                                                <td data-title="Fine Amount">50.00</td>
                                             </tr>
                                             <tr>
                                                <td data-title="#">3</td>
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
         </div>@endsection
@section('js')

@endsection