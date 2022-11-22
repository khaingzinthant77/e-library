@extends('frontend.layouts.main')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">

<div class="content-wrapper clearfix">
   <div class="container">
      <div class="breadcrumb">
         <ul class="list-inline">
            <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li><a href="{{url('member_ebooks')}}">My Account</a></li>
            <li class="active">My eBooks</li>
         </ul>
      </div>
      <div class="row">
         <div class="my-account clearfix">
            <div class="col-md-3">
               <div class="sidebar-menu">
                  <ul class="list-inline">
                     <li class="active">
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
                     <li class="">
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
                  <div class="my-dashboard">
                     <div class="account-information clearfix">
                        <h4>My Favourite eBooks</h4>
                        <div class="col-md-12">
                           <div class="row">
                              <div class="index-table">
                                 <div class="table-responsive">
                                    <table class="table">
                                       <thead>
                                          <tr>
                                             <th>Cover Image</th>
                                             <th width="200px">eBook</th>
                                             <th>Category</th>
                                             <th>Featured</th>
                                             <th>Date</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @foreach($data as $e_book)
                                          <tr>
                                             <td>
                                                <div class="image-holder">
                                                   <img src="{{asset($e_book->cover_path.$e_book->cover_photo)}}">
                                                </div>
                                             </td>
                                             <td>
                                               {{$e_book->ebook_name}}
                                             </td>
                                             <td>{{$e_book->cat_name}}</td>
                                             <td>
                                               @if($e_book->is_feature == 1)
                                               Yes
                                               @else
                                               No
                                               @endif
                                             </td>
                                             <td>{{date('M',strtotime($e_book->created_at))}} {{date('d',strtotime($e_book->created_at))}}, {{date('Y',strtotime($e_book->created_at))}}</td>
                                             <td>
                                                <form action="{{route('favourites.destroy',$e_book->id)}}" method="post" onsubmit="return confirm('Do you want to delete?');">
                                                 @csrf
                                                 @method('DELETE')
                                                 
                                                  <button class="btn btn-xs btn-danger" type="submit">
                                                      <i class="fa fa-fw fa-trash" title="Delete"></i>
                                                  </button>
                                             </td>
                                          </tr>
                                         @endforeach
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  {!! $data->appends(request()->input())->links() !!}
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