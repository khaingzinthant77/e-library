@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>Login User</h1>
      <ol class="breadcrumb">
         <li><a href="/"><i class="fa fa-dashboard"></i>Dashboard</a></li>
         <li class="active">Login User</li>
      </ol>
   </section>
   <section class="content">
      <div class="box box-mytheme">
         <div class="box-header">
            <a href="{{route('member.create')}}" class="btn btn-inline btn-mytheme btn-md pull-left"><i class="fa fa-plus"></i> Add Member</a>
            <div class="col-sm-3 pull-right">
               <!-- select name="roleID" id="filterRoleID" data-url="https://library.greensoftbd.xyz/member/index" class="form-control pull-right">
                  <option value="1" >Admin</option>
                  <option value="2" >Librarian</option>
                  <option value="3" selected>Member</option>
                  <option value="4" >Customer</option>
               </select> -->
            </div>
         </div>
         <div class="box-body">
            <div id="hide-table">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Joined Date</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($members as $key=>$member)
                     <tr>
                        <td data-title="#">{{++$i}}</td>
                        <td data-title="Name">{{$member->name}}</td>
                        <td data-title="Phone">{{$member->ph_no}}</td>
                        <td data-title="Email">{{$member->email}}</td>
                        <td data-title="joinDate">{{date('d-m-Y',strtotime($member->created_at))}}</td>
                        <td>
                           @if(!empty($member->getRoleNames()))

                             @foreach($member->getRoleNames() as $v)

                                <label class="badge badge-success">{{ $v }}</label>

                             @endforeach

                           @endif
                        </td>
                        @if($member->status == 1)
                        <td>Active</td>
                        @else
                        <td>Block</td>
                        @endif
                        
                        <td data-title="Action">
                           <form action="{{route('users.destroy',$member->id)}}" method="post" onsubmit="return confirm('Do you want to delete?');">
                                @csrf
                                @method('DELETE')
                                
                               <a href="{{route('users.edit',$member->id)}}" class='btn btn-warning btn-xs' data-placement='top' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></a>   

                                 <button class="btn btn-xs btn-danger" type="submit">
                                     <i class="fa fa-fw fa-trash" title="Delete"></i>
                                 </button>
                             </form>

                        </td>
                     </tr>
                     @endforeach
                     
                  </tbody>
                  
               </table>
               {!! $members->appends(request()->input())->links() !!}
            </div>
         </div>
      </div>
   </section>
</div>
@endsection
@section('js')
<script type="text/javascript">
   if ($.fn.datepicker) {
       $('.datepicker').datepicker({
           autoclose: true,
           format : 'dd-mm-yyyy',
       });
   }
   var globalFilebrowse = "File Browse";
</script>
@endsection