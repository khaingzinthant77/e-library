@extends('frontend.layouts.main')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">
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
                        <a href="{{url('my_request_list/'.auth()->user()->id)}}">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        My Request Book List
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
                  <form method="POST" action="{{route('create_request_book')}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                     <input type="hidden" name="member_id" value="{{auth()->user()->id}}">
                     <div class="account-details">
                        <div class="account clearfix">
                           <h4>Request Book</h4>
                           <div class="row form-group">
                              <div class="form-group">
                                 <div style="margin-left:15px;">
                                    <label>
                                       Book Name
                                    </label>
                                 </div>
                                 
                                 <div class="col-md-12">
                                    <input type="text" name="book_name" id="book_name" class="form-control" value="">
                                 </div>
                                 
                              </div>
                           </div>
                           <div class="row form-group">
                              <div class="form-group">
                                 <div style="margin-left:15px;">
                                    <label>
                                       Author Name
                                    </label>
                                 </div>
                                 
                                 <div class="col-md-12">
                                    <input type="text" name="author_name" id="author_name" class="form-control" value="">
                                 </div>
                                 
                              </div>
                           </div>
                           
                        </div>
                        
                     </div>
                     <button type="submit" class="btn btn-primary" data-loading>
                     Request Book
                     </button>
                  </form>
               </div>
            </div>
         </div>
      </div>
     
   </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="<?= url('assets/plugins/toastr/toastr.min.js')?>"></script>
<script type="text/javascript">
   <?php 
        $success = session('success');
        $error   = session('error');
        if($success) { ?>
            toastr.success('<?=$success?>');
        <?php } elseif($error) { ?>
            toastr.error('<?=$error?>');
        <?php } ?>
</script>
@endsection