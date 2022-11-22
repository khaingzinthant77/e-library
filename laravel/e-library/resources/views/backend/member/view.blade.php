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
                           <p class="text-muted text-center">{{$member->name}}</p>
                           <ul class="list-group list-group-unbordered">
                              
                              <li class="list-group-item">
                                 <b>Phone</b> <span class="pull-right">{{$member->ph_no}}</span>
                              </li>
                              <li class="list-group-item">
                                 <b>Email</b> <span class="pull-right">{{$member->email}}</span>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                           <li class="active"><a href="#bookissue" data-toggle="tab">Book Issue History</a></li>
                           <!-- <li><a href="#renewhistory" data-toggle="tab">Renew History</a></li>
                           <li><a href="#paymentinformation" data-toggle="tab">Payment Information</a></li> -->
                        </ul>
                        <div class="tab-content">
                           <div class="active tab-pane" id="bookissue">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div id="hide-table">
                                       <table id="example1" class="table table-bordered table-striped">
                                          <thead>
                                             <tr>
                                                <th>#</th>
                                                <th>Cover</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Code No</th>
                                                <th>Author</th>
                                                <th>Issue Date</th>
                                                <th>Expire Date</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @foreach($rent_books as $key=>$rent_book)
                                             <tr>
                                                <td data-title="#">{{++$i}}</td>
                                                <td data-title="Cover">
                                                   <img src="{{asset($rent_book->path.$rent_book->cover_photo)}}" class="profile_img" alt="">      
                                                </td>
                                                <td data-title="Category">{{$rent_book->cat_name}}</td>
                                                <td data-title="Book Name">{{$rent_book->name}}</td>
                                                <td>{{$rent_book->code_no}}</td>
                                                <td>{{$rent_book->author_name}}</td>
                                                <td>{{date('d-m-Y',strtotime($rent_book->issue_date))}}</td>
                                                <td>
                                                   @if($rent_book->rent_expire != null)
                                                   {{date('d-m-Y',strtotime($rent_book->rent_expire))}}
                                                   @endif
                                                </td>
                                             </tr>
                                             @endforeach
                                          </tbody>
                                          
                                       </table>
                                    </div>
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
                                                <th>Cover</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Code No</th>
                                                <th>Author</th>
                                                <th>Issue Date</th>
                                                <th>Expire Date</th>
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