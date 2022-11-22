@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
            <section class="content-header">
               <h1>Author</h1>
               <ol class="breadcrumb">
                  <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li><a href="{{route('authors.index')}}">Author</a></li>
                  <li class="active">View</li>
               </ol>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-md-3">
                     <div class="box box-mytheme">
                        <div class="box-body box-profile">
                           <img class="profile-user-img img-responsive img-circle" src="{{asset($author->path.'/'.$author->photo)}}" alt="Author profile picture">
                           <h3 class="profile-username text-center">Author</h3>
                           <p class="text-muted text-center">{{$author->name}}</p>
                           <ul class="list-group list-group-unbordered">
                              <li class="list-group-item">
                                 <b>Date of Birth</b> <span class="pull-right">{{date('d-m-Y',strtotime($author->dob))}}</span>
                              </li>

                              <li class="list-group-item">
                                 @if($author->gender == 0)
                                 <b>Gender</b> <span class="pull-right">Male</span>
                                 @else
                                 <b>Gender</b> <span class="pull-right">Female</span>
                                 @endif
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                           <li class="active"><a href="#profile" data-toggle="tab">Personal Data</a></li>
                        </ul>
                        <div class="tab-content">
                           <div class="active tab-pane" id="profile">
                              <div class="row">
                                 <div class="col-md-12">
                                    <p>{{$author->personal_data}}</p>
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
<script src="{{ asset('/assets/custom/js/custom.js')}}"></script>
<script type="text/javascript">
   if ($.fn.DataTable) {
        $('#example1').DataTable({
            'pageLength':15,
            'ordering': false
        });

        $('.mainpermission').DataTable({
            paging: false
        });
    }
</script>
@endsection