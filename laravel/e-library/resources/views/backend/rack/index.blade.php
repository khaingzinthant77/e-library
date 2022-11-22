@extends('backend.layouts.main')
@section('content')
<div class="content-wrapper">
            <section class="content-header">
               <h1>Rack</h1>
               <ol class="breadcrumb">
                  <li><a href=""><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li class="active">Rack</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="box-header">
                     <a href="{{route('rack.create')}}" class="btn btn-inline btn-mytheme btn-md"><i class="fa fa-plus"></i> Add Rack</a>
                  </div>
                  <div class="box-body">
                     <div id="hide-table">
                        <table id="example1" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Name</th>
                                 <th>Description</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                            @foreach($list as $key=>$rack)
                              <tr>
                                 <td data-title="#">{{++$i}}</td>
                                 <td data-title="Name">{{$rack->name}}</td>
                                 <td data-title="Description">{{$rack->description}}</td>
                                 <td data-title="Action">
                                    <form action="{{route('rack.destroy',$rack->id)}}" method="post" onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')

                                    <a href="{{route('rack.edit',$rack->id)}}" class='btn btn-warning btn-xs' data-placement='top' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></a>

                                    <button class="btn btn-xs btn-danger" type="submit">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>

                                    </form>                   
                                 </td>
                              </tr>
                              @endforeach
                              
                           </tbody>
                          
                        </table>
                        {!! $list->appends(request()->input())->links() !!}
                     </div>
                  </div>
               </div>
            </section>
         </div>
@endsection

@section('js')
<script src="{{asset('assets/custom/js/custom.js')}}"></script>
<script type="text/javascript">
         $.widget.bridge('uibutton', $.ui.button);
         $('[data-toggle="tooltip"]').tooltip();
         
         
         $( document ).ready(function() {
             if ($.fn.DataTable) {
                 $('#example1').DataTable({
                     'pageLength':15,
                     'ordering': false
                 });
         
                 $('.mainpermission').DataTable({
                     paging: false
                 });
             }
         });
         
      </script>
@endsection