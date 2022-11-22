@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <h1>Role</h1>
      <ol class="breadcrumb">
         <li><a href="/"><i class="fa fa-dashboard"></i>Dashboard</a></li>
         <li class="active">Role</li>
      </ol>
   </section>
   <section class="content">
      <div class="box box-mytheme">
         <div class="box-header">
            <a href="{{route('roles.create')}}" class="btn btn-inline btn-mytheme btn-md pull-left"><i class="fa fa-plus"></i> Add Role</a>
            <div class="col-sm-3 pull-right">
            </div>
         </div>
         <div class="box-body">
            <div id="hide-table">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>#</th>
                         <th>Name</th>
                         <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($roles as $key=>$role)
                     <tr>
                        <td data-title="#">{{++$i}}</td>
                        <td data-title="Name">{{$role->name}}</td>
                       
                        <td data-title="Action">
                           <form action="{{route('roles.destroy',$role->id)}}" method="post" onsubmit="return confirm('Do you want to delete?');">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('roles.show',$role->id)}}" class='btn btn-success btn-xs' data-placement='top' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-eye'></i></a> 

                               <a href="{{route('roles.edit',$role->id)}}" class='btn btn-warning btn-xs' data-placement='top' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></a>   

                                 <button class="btn btn-xs btn-danger" type="submit">
                                     <i class="fa fa-fw fa-trash" title="Delete"></i>
                                 </button>
                             </form>

                        </td>
                     </tr>
                     @endforeach
                     
                  </tbody>
                  
               </table>
               {!! $roles->appends(request()->input())->links() !!}
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