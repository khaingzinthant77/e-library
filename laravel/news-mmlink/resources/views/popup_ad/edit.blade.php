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
    <h3 style="margin-left: 15px">Popup Ad Edit</h3>
    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('popup_ads.update',$popupAd->id) }}">
                
    @csrf
    @method('PUT')
                <div class="form-group{{ $errors->has('half_or_full') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Image Size</label>

                    <div class="col-md-9">
                        <select class="form-control" id="half_or_full" name="half_or_full">
                            <option value="">All</option>
                            <option value="1" {{$popupAd->half_or_full == 1 ? 'selected' : ''}}>Full</option>
                            <option value="2" {{$popupAd->half_or_full == 2 ? 'selected' : ''}}>Half</option>
                        </select>
                        @if ($errors->has('popup_photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('popup_photo') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('popup_photo') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Popup Ad Photo</label>

                    <div class="col-md-9">
                        <input type="file" class="form-control" value="{{old('popup_photo')}}" name="popup_photo">@if ($errors->has('popup_photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('popup_photo') }}</strong>
                            </span>
                        @endif
                        <img src="{{ asset($popupAd->path . $popupAd->popup_img) }}" alt="" style="width: 220px; height: 220px;">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Description</label>

                    <div class="col-md-9">
                             <textarea class="form-control" id="summernote" style="height:300px" name="description">{{ old('description',$popupAd->description) }}</textarea>

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-6">
                         <a class="btn btn-success unicode" href="{{route('news.index')}}"> Back</a>
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
