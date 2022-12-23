@extends('layouts.app')
@section('css')
  <!-- table sorter stylesheet-->
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/vendor/datatable/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/css/header.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo asset('/css/toggle-switch.css') ?>">
@endsection
@section('content')

 @if (session()->has('message1'))
        <div class="alert alert-success alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>{{ session()->get('message1') }}
        </div>
  @endif

<div style="margin-left: 10px">
  <a class="btn btn-sm btn-success" onclick ="window.location.href='{{ route('setting_url.create') }}'"><i class="cil-plus"></i> Add News</a>
</div><br>
 

<div class="table-responsive">
    <table id="solved-table" class="table">
        <thead>
            <tr>
              <th>No</th>
              <th>URL</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key=>$d)
            <tr>
                <td>{{++$key}}</td>
                <td>
                    {{$d->url}}
                </td>
                <td>{{$d->description}}</td>
                <td>
                    <label class="switch" style="margin-top: 9px;">
                      <input data-id="{{$d->id}}" data-size ="small" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $d->status? 'checked' : '' }}>
                    <span class="slider round"></span>
                </td>
                <td>
                    <form action="{{ route('setting_url.destroy',$d->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                        @csrf
                        @method('DELETE')
                       
                        <a class="btn btn-sm btn-primary" href="{{ route('setting_url.edit',$d->id) }}"><i class="cil-pencil"></i></a>
                        <button type="submit" class="btn btn-sm btn-danger"><i class="cil-trash"></i></button> 
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>


  <!-- table sorter js-->
    <script type="text/javascript" src="<?php echo asset('/vendor/datatable/pdfmake.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/vendor/datatable/vfs_fonts.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/vendor/datatable/jquery.dataTables.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/vendor/datatable/dataTables.bootstrap4.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/vendor/datatable/dataTables.buttons.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/vendor/datatable/buttons.bootstrap4.min.js') ?>">"></script>
    <script type="text/javascript" src="<?php echo asset('/vendor/datatable/buttons.colVis.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/vendor/datatable/buttons.html5.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo asset('/vendor/datatable/buttons.print.min.js') ?>"></script>

    <script type="text/javascript">

        $(function() {
                $('.toggle-class').change(function() {
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var url_id = $(this).data('id');
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "<?php echo route('change-status-url') ?>",
                        data: {'active': status, 'url_id': url_id},
                        success: function(data){
                         console.log(data.success);
                        }
                        
                    });
                })
              });

    $('#solved-table').DataTable( {
        "order": [],
        'language': {
            'lengthMenu': '_MENU_ Record Per Page',
             "info":      '<small>Showing _START_ - _END_ (_TOTAL_) Items</small>',
            "search":  'Search',
            'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
            }
        },
        'columnDefs': [
            {
                "orderable": false,
                'targets': [0]
            },
            {
                // 'render': function(data, type, row, meta){
                //     if(type === 'display'){
                //         data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                //     }

                //    return data;
                // },
                // 'checkboxes': {
                //    'selectRow': true,
                //    'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                // },
                'targets': [0]
            }
        ],
        'select': { style: 'multi',  selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: '<"row"lfB>rtip',
        buttons: [
            {
                extend: 'pdf',
                text: 'PDF',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                },
                customize: function(doc) {

                },
            },
            {
                extend: 'csv',
                text: 'CSV',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                   
                },
            },
            {
                extend: 'print',
                text: 'Print',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    stripHtml: false
                },
            },
            
            {
                extend: 'colvis',
                text: 'Column visibility',
                columns: ':gt(0)'
            },
        ],


    } );

</script>
</script>

@endsection
