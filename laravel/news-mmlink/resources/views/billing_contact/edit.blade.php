@extends('layouts.app')
@section('css')
<!-- ### link summernote for text editor### -->
<link href="{{ asset('/summernote/dist/summernote.css') }}" rel="stylesheet">
<link href="{{ asset('/frontend/theme/css/daterangepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('/frontend/theme/css/jquery-ui.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datepicker3.css') }}"/>
<link rel="stylesheet" type="text/css" href="<?php echo asset('/css/toggle-switch.css') ?>">
@endsection

@section('content')
    <h3 style="margin-left: 15px">Billing Contact Edit</h3>
    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('billing_contact.update',$data->id) }}">
                
    @csrf
    @method('PUT')
                
                <div class="form-group{{ $errors->has('contact_text') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Contact Text</label>

                    <div class="col-md-9">
                             <textarea class="form-control" id="summernote" style="height:300px" name="contact_text">{{ old('contact_text',$data->contact_text) }}</textarea>

                        @if ($errors->has('contact_text'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact_text') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-6">
                         <a class="btn btn-success unicode" href="{{route('billing_contact.index')}}"> Back</a>
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>

    </form>
    <input type="hidden" id="ctr_tocken" value="{{ csrf_token() }}" /> 

@endsection

@section('javascript')
<script src="{{asset('js/app.js')}}"></script>
<script src="{{ asset('summernote/dist/summernote.js') }}"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}" ></script>
<script type="text/javascript">

    $(document).ready(function() {
      
        $("#summernote").summernote({
            height: 300,                 // set editor height
                 minHeight: null,             // set minimum height of editor
                 maxHeight: null,             // set maximum height of editor
                 focus: true  ,
                styleTags: [
                  'p','pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6','br'
                ],
        }).on("summernote.enter", function(we, e) {
          $(this).summernote("pasteHTML", "<br><br>");
          e.preventDefault();
        });
    });

     $(document).ready(function(){
            var business_start_date=$('input[name="publish_date"]').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
                autoclose: true,
            });
        });

  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
    })


  })

  
</script>

@endsection
