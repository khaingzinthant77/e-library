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
    <h3 style="margin-left: 15px">Post Create</h3>
    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('news.store') }}">
      {!! csrf_field() !!}
      <div class="form-group {{ $errors->has('post_category')?'has-error':''}}">
                            <label class="col-md-2 control-label">Post Category</label>
                            <div class="col-md-9">
                            <select class="form-control select2bs4" id="post_category" name="post_category">
                              <option>Select Post Category</option>
                              <option value="1">News</option>
                              <option value="2">Event</option>
                             <!--  <option value="3">Loan</option> -->
                            </select>
                            {{$errors->first('post_category','<small>:message</small>')}}
                        </div>
      </div>

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Post Title</label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
        </div>

         <div class="form-group{{ $errors->has('feature_photo') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Feature Photo</label>

                    <div class="col-md-9">
                        <input type="file" class="form-control" value="{{old('feature_photo')}}" name="feature_photo">@if ($errors->has('feature_photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('feature_photo') }}</strong>
                            </span>
                        @endif
                    </div>
         </div>

          <div class="form-group{{ $errors->has('detail_photo') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Detail Photo</label>

                    <div class="col-md-9">
                        <input type="file" class="form-control" name="detail_photo">@if ($errors->has('detail_photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('detail_photo') }}</strong>
                            </span>
                        @endif
                    </div>
          </div>

           <div class="form-group{{ $errors->has('detail_description') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Detail Description</label>

                    <div class="col-md-9">
                             <textarea class="form-control" id="summernote" style="height:300px" name="detail_description">{{ old('detail_description') }}</textarea>

                        @if ($errors->has('detail_description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('detail_description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            <div class="form-group{{ $errors->has('publish_date') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Publish Date</label>

                    <div class="col-md-9">
                        <input type="text" class="form-control" id="publish_date" name="publish_date" value="{{ old('publish_date') }}" placeholder="01-06-2021">

                        @if ($errors->has('publish_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('publish_date') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>

            <div class="form-group{{ $errors->has('publish_date') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">Post Publish</label>
                    <div class="col-md-9">
                         <label class="switch" style="margin-top: 9px;">
                            <input data-size ="small" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" value="1" name="status">
                            <span class="slider round"></span>
                        </label>
                    </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-6">
                   <a class="btn btn-success unicode" href="{{route('news.index')}}"> Back</a>
                    <button type="submit" class="btn btn-primary">
                        Save
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
