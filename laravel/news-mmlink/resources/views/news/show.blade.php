@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-md-6 text-left">
        <a class="btn btn-success unicode" href="{{route('news.index')}}" style="margin-left: 10px"> Back</a><br>
    </div>
    <div class="col-md-6">
        <div style="float: right; margin-right: 10px;">
            <p style="font-weight: bold;">{!! $news->publish_date !!}</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <img src="{{ asset('uploads/posts/' . $news->feature_photo) }}" alt="" style="width: 220px; height: 220px;">
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <h3 style="text-align: center;">
                {!! $news->title !!}
            </h3>
        </div>
        <br>
    </div>
    <br> 
    <div class="row">
        <div class="col-md-8 text-justify">
            <p>
                {!! $news->detail_description !!}
            </p>
        </div>
        <div class="col-md-4 text-center">
                <img src="{{ asset('uploads/posts/' . $news->detail_photo) }}" alt="" style="width: 220px; height: 220px;">
        </div>
    </div>      
</div>
 


        
       

@endsection


@section('javascript')


@endsection
