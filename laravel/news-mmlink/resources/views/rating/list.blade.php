@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="<?php echo asset('/css/ticket-header.css') ?>">
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker3.css') }}"/>
@endsection
@section('content')
<div class="container-fluid">
    
     <h4>Rating List</h4>
    <?php
        $rating = isset($_GET['rating'])?$_GET['rating']:'';
        $from_date = isset($_GET['from_date'])?$_GET['from_date']:date('d-m-Y');
        $to_date = isset($_GET['to_date'])?$_GET['to_date']:date('d-m-Y');
    ?>

     <form action="{{route('rating.index')}}" method="get" accept-charset="utf-8" class="form-horizontal" id="form">
            <div class="row">
                <div class="col-md-2">
                    <label>Select Rating</label>
                    <select class="form-control" id="rating" name="rating">
                        <option value="">All</option>
                        <option value="1" {{$rating == 1 ? 'selected' : ''}}>Poor</option>
                        <option value="2" {{$rating == 2 ? 'selected' : ''}}>Bad</option>
                        <option value="3" {{$rating == 3 ? 'selected' : ''}}>Average</option>
                        <option value="4" {{$rating == 4 ? 'selected' : ''}}>Good</option>
                        <option value="5" {{$rating == 5 ? 'selected' : ''}}>Excellent</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>From Date</label>
                    <input type="text" class="form-control" id="from_date" name="from_date" value="{{ old('from_date',$from_date) }}" placeholder="{{date('d-m-Y')}}">
                </div> 
                <div class="col-md-2">
                    <label>To Date</label>
                    <input type="text" class="form-control" id="to_date" name="to_date" value="{{ old('to_date',$to_date) }}" placeholder="{{date('d-m-Y')}}">
                </div>         
            </div>
     </form>
     
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="table-responsive">
                <table id="suspend-table" class="table">
                    <thead>
                        <tr>
                            <th class="not-exported" width="200px;">No</th>
                            <th width="400px;">Customer Name*</th>
                            <th>Phone No</th>
                            <th width="400px;">Rating Count*</th>
                            <th width="300px;">Description</th>
                            <th width="300px;">Date</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($ratings)>0)
                        @foreach($ratings as $key=>$rating)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$rating->cust_name}}</td>
                            <td>{{$rating->phone_no}}</td>
                            <td>{{$rating->rating_count}}</td>
                            <td>{{$rating->description}}</td>
                            <td>{{date('d-m-Y H:i A',strtotime($rating->created_at))}}</td>
                            <td>
                                <form action="{{ route('rating.destroy',$rating->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                 <button type="submit" class="btn btn-sm btn-danger"><i class="cil-trash"></i></button></form>
                            </td>

                           
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
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}" ></script>

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

            var business_start_date=$('input[name="from_date"]').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
                autoclose: true,
            });

            var business_start_date=$('input[name="to_date"]').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
                autoclose: true,
            });



            $("select#rating").change(function(){
               $("#form").submit();
            });

            $("#from_date").change(function(){
               $("#form").submit();
            });

            $("#to_date").change(function(){
               $("#form").submit();
            });

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
