@extends('frontend.layouts.main')
@section('content')
<div class="content-wrapper clearfix">
   <div class="container">
      <div class="breadcrumb">
         <ul class="list-inline">
            <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li><a href="{{url('member_ebooks')}}">My Account</a></li>
            <li class="active">Edit Profile</li>
         </ul>
      </div>
      <div class="row">
         <div class="my-account clearfix">
            <div class="col-md-3">
               <div class="sidebar-menu">
                  <ul class="list-inline">
                     <li class="">
                        <a href="{{url('member_ebooks')}}">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        My Rent eBooks
                        </a>
                     </li>
                     <li class="active">
                        <a href="{{url('favourite_list/'.auth()->user()->id)}}">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        My Favourite eBooks
                        </a>
                     </li>
                     <li class="active">
                        <a href="{{url('request_book')}}">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        Request Book
                        </a>
                     </li>
                     <li class="active">
                        <a href="{{url('edit_profile')}}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Edit Profile
                        </a>
                     </li>
                     <li>
                        <a href="{{url('/member_logout')}}">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        Logout
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="col-md-9">
               <div class="clearfix"></div>
               <div class="content-right clearfix">
                  <form method="POST" action="{{route('update_profile',auth()->user()->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                     <input type="hidden" name="_method" value="put">
                     <div class="account-details">
                        <div class="account clearfix">
                           <h4>Edit Profile</h4>
                           <div class="row form-group">
                              <div class="form-group">
                                 <div style="margin-left:15px;">
                                    <label>
                                       Name
                                    </label>
                                 </div>
                                 
                                 <div class="col-md-12">
                                    <input type="text" name="name" id="name" class="form-control" value="{{$member_data->name}}">
                                 </div>
                                 
                              </div>
                           </div>
                           <div class="row form-group">
                              <div class="form-group">
                                 <div style="margin-left:15px;">
                                    <label>
                                       Phone
                                    </label>
                                 </div>
                                 
                                 <div class="col-md-12">
                                    <input type="text" name="ph_no" id="ph_no" class="form-control" value="{{$member_data->ph_no}}">
                                 </div>
                                 
                              </div>
                           </div>
                           <div class="row form-group">
                              <div class="form-group">
                                 <div style="margin-left:15px;">
                                    <label>
                                       Email
                                    </label>
                                 </div>
                                 
                                 <div class="col-md-12">
                                    <input type="text" name="email" id="email" class="form-control" value="{{$member_data->email}}">
                                 </div>
                                 
                              </div>
                           </div>
                        </div>
                        <div class="password">
                           <h4>Password</h4>
                           <div class="row">
                              <div class="col-sm-8">
                                 <div class="form-group ">
                                    <label for="new-password">
                                    New Password
                                    </label>
                                    <input type="password" name="password" id="new-password" class="form-control">
                                 </div>
                                 <div class="form-group ">
                                    <label for="confirm-password">
                                    Confirm Password
                                    </label>
                                    <input type="password" name="password_confirmation" id="confirm-password" class="form-control">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-primary" data-loading>
                     Save Changes
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </div>
     <!--  <section class="ad-wrapper clearfix">
         <div class="row">
            <div class="col-lg-12 col-sm-12">
               Advertisement 2
            </div>
         </div>
      </section> -->
   </div>
</div>
@endsection