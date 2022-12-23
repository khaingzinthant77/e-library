@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="<?php echo asset('/css/ticket-header.css') ?>">
 <link rel="stylesheet" type="text/css" href="<?php echo asset('/css/daterangepicker.css') ?>">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-11">
                 <form id="form" action="{{ url('/action_logs') }}">
                    <div class="col-md-3">
                         <div class="input-group mb-3">
                                 <div  class="form-control" id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 80%">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                    <input type="hidden" id="ctr_start" name="start" value="">
                                    <input type="hidden" id="ctr_end" name="end" value="">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-secondary btn-sm"><i class="cil-filter"></i></button>
                                </div>
                        </div>
                      </div>
                 </form>
        </div>
    </div>
    
     <h4>Action Logs</h4>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="table-responsive">
                <table id="suspend-table" class="table">
                    <thead>
                        <tr>
                            <th class="not-exported" width="200px;">No</th>
                            <th width="400px;">Login Id*</th>
                            <th width="400px;">User Name*</th>
                            <th width="300px;">User Role</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($action_logs)>0)
                        @foreach($action_logs as $key=>$action_log)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$action_log->login_id}}</td>
                            <td>{{$action_log->user_name}}</td>
                            <td>{{$action_log->user_level}}</td>
                            <td>{{date('d-m-Y H:i A',strtotime($action_log->login_date))}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   <div>

</div>

@endsection
<?php 
  $start = isset($_GET['start'])?$_GET['start']:'';
  $end = isset($_GET['end'])?$_GET['end']:'';
?>
@section('javascript')
<script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/moment.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/daterangepicker.min.js')}}"></script>

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

        $(document).ready(function(){
            $(".dataTables_empty").on('click',function(event){
                // alert("hi");
                this.onclick = null;
                    event.preventDefault();
                    event.returnValue = false;
                    return false;

            });

            // $("select#tsh_id").change(function(){
            //    $("#form").submit();
            // });

            // $("select#tech_id").change(function(){
            //    $("#form").submit();
            // });

            // $("select#srv_status").change(function(){
            //    $("#form").submit();
            // });

            // $('#new-table tbody').on('click', 'tr', function () {
            //   window.location = $(this).data("url");      
            // });
            // $('#suspend-table tbody').on('click', 'tr', function () {
            //   window.location = $(this).data("url");      
            // });
        });

    $(function() {

    // var start = moment().subtract(29, 'days');
    var std = "<?php echo $start ?>";
    var ed = "<?php echo $end ?>";
    var url_start
    var start =  moment();
    var end = moment();

    var start = (std!='')?moment(std):moment();
    var end = (ed!='')?moment(ed):moment();

    // console.log(mon)

    function cb(start, end) {
      $('#reportrange span').html(start.format('DD/MMMM/YYYY') + ' - ' + end.format('DD/MMMM/YYYY'));

      var ct_start = start.format('YYYY-MM-DD');
      $('#ctr_start').val(ct_start);

      var ct_end = end.format('YYYY-MM-DD');
      $('#ctr_end').val(ct_end);

    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
}); 


    $('#suspend-table').DataTable( {
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
@endsection
