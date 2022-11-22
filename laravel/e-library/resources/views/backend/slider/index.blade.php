@extends('backend.layouts.main')
@section('content')

<?php
   $keyword = isset($_GET['keyword'])?$_GET['keyword']:'';
?>
<style type="text/css">
   .switch {
        position: relative;
        display: inline-block;
        width: 45px;
        height: 22px;
    }

    .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 2px;
        bottom: 0px;
        top:3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

/* Rounded sliders */
    .slider.round {
        border-radius: 36px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<div class="content-wrapper">
            <section class="content-header">
               <h1>Slider</h1>
               <ol class="breadcrumb">
                  <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li class="active">Sliders</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="box-header">
                     <a href="{{route('sliders.create')}}" class="btn btn-inline btn-mytheme btn-md pull-left"><i class="fa fa-plus"></i> Add Slider</a>
                     <div class="col-sm-3 pull-right">
                        <form method="get" accept-charset="utf-8" class="form-horizontal" action="{{route('sliders.index')}}">
                           <div class="input-group">
                              <input type="text" class="form-control" value="{{ old('keyword',$keyword) }}" name="keyword" placeholder="Filter By Name">
                              <div class="input-group-btn">
                                 <button type="submit" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> Search</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="box-body">
                     <div id="hide-table">
                        <table id="example1" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Title</th>
                                 <th>Photo</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($sliders as $key=>$slider)
                              <tr>
                                 <td data-title="#">{{++$i}}</td>
                                 <td data-title="Name">{{$slider->title}}</td>
                                 <td data-title="Photo"><img src="{{asset($slider->path.$slider->photo)}}" class="profile_img" alt=""></td>
                                 <td>
                                    <label class="switch">
                                       <input class="toggle-class" data-id="{{$slider->id}}" type="checkbox" id="flexSwitchCheckChecked" {{ $slider->status? 'checked' : '' }} > 
                                     
                                       <span class="slider round"></span>

                                   </label>
                                 </td>
                                 <td data-title="Action">
                                 <form action="{{route('sliders.destroy',$slider->id)}}" method="post" onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')

                                     <a href="{{route('sliders.edit',$slider->id)}}" class='btn btn-warning btn-xs' data-placement='top' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></a>

                                    <button class="btn btn-xs btn-danger" type="submit">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>
                                </form>

                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                           
                        </table>
                         {!! $sliders->appends(request()->input())->links() !!}
                     </div>
                  </div>
               </div>
            </section>
         </div>
@endsection

@section('js')
<script type="text/javascript">
   $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var slider_id = $(this).data('id'); 
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo(route("change_slider_status")) ?>",
                    data: {'status': status, 'slider_id': slider_id},
                    success: function(data){
                     console.log(data.success);
                    }
                });
            })
          });
</script>
@endsection