@extends('frontend.layouts.main')
@section('content')
<div class="content-wrapper clearfix">
   <div class="container">
       <section class="ebook-list">
         <div class="row">
            <div class="col-md-3 col-sm-12">
               <div class="ebook-list-sidebar clearfix">
                  <div class="filter-section clearfix">
                     <ul class="filter-category list-inline">
                    
                        @foreach($categories as $key=>$category)
                        <li class="">
                           <a href="{{route('category_detail',$category->id)}}">
                           {{$category->name}}
                           </a>
                        </li>
                        @endforeach
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-9 col-sm-12">
               <div class="row">

            <div class="home-slider"
               data-autoplay="1"
               data-autoplay-speed="8000"
               data-arrows="1"
               >
                @foreach($sliders as $key=>$slider)
               
                  <div class="slide">
                     <?php 
                        $url = $slider->path.$slider->photo;
                      ?>
                     <div class="slider-image" style="background-image: url({{URL::asset($slider->path.$slider->photo)}});"></div>
                     <div class="display-table">
                        <div class="display-table-cell">
                           <div class="col-md-9 col-md-offset-1 col-sm-10 col-sm-offset-1">
                              <div class="slider-content clearfix">
                                 <div class="display-table">
                                    <div class="display-table-cell">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>
            </div>
         </div>
      </section>

      <div class="clearfix"></div>
      <section class="ebook-slider-wrapper clearfix">
         <div class="section-header">
            <h3>Featured eBooks</h3>
         </div>
         <div class="row">
            <div class="ebook-slider slick-arrow separator clearfix">
               @foreach($feature_books as $key=>$feature_book)
               <div class="col-md-3">
                  <a href="{{route('ebook_view_detail',$feature_book->id)}}" class="ebook-card">
                     <div class="ebook-card-inner">
                        <div class="ebook-image clearfix">
                           <ul class="ebook-ribbon list-inline">
                              <li><span class="ribbon bg-green"><i class="fa fa-star" aria-hidden="true"></i> Featured</span></li>
                           </ul>
                           <div class="image-holder">
                              <img src="{{asset($feature_book->cover_path.$feature_book->cover_photo)}}">
                           </div>
                        </div>
                        <div class="ebook-content clearfix">
                           <span class="ebook-name div-ellipsis">
                           {{$feature_book->book_name}}
                           </span>
                           <span class="ebook-name div-ellipsis ebook-authors">
                           Authors: 
                           {{$feature_book->author_name}}
                           </span>
                        </div>
                        
                     </div>
                  </a>
               </div>
               @endforeach
            </div>
         </div>
      </section>
      <section class="ebook-slider-wrapper clearfix">
         <div class="section-header">
            <h3>Popular eBooks</h3>
         </div>
         <div class="row">
            <div class="ebook-slider slick-arrow separator clearfix">
               @foreach($popular_books as $key=>$popular_book)
               <div class="col-md-3">
                  <a href="{{route('ebook_view_detail',$popular_book->id)}}" class="ebook-card">
                     <div class="ebook-card-inner">
                        <div class="ebook-image clearfix">
                           @if($popular_book->is_feature == 1)
                           <ul class="ebook-ribbon list-inline">
                              <li><span class="ribbon bg-green"><i class="fa fa-star" aria-hidden="true"></i> Featured</span></li>
                           </ul>
                           @endif
                           <div class="image-holder">
                              <img src="{{$popular_book->cover_path.$popular_book->cover_photo}}">
                           </div>
                        </div>
                        <div class="ebook-content clearfix">
                           <span class="ebook-name div-ellipsis">
                           {{$popular_book->name}}
                           </span>
                           <span class="ebook-name div-ellipsis ebook-authors">
                           Authors: 
                           {{$popular_book->author_name}}
                           </span>
                        </div>
                        
                     </div>
                  </a>
               </div>
               @endforeach
            </div>
         </div>
      </section>
      
      <section class="section-wrapper clearfix">
         <div class="section-header">
            <h3>Top Authors</h3>
         </div>
         <div class="top-authos m-t-20">
            <div class="row">
               @foreach($top_authors as $key=>$top_author)
               <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                  <div class="our-author">
                     <div class="picture">
                        <img class="img-fluid" src="{{asset($top_author->path.$top_author->photo)}}">
                     </div>
                     <div class="author-content">
                        <h4 class="name"><a href="{{url('author_detail/'.$top_author->id)}}" class="" aria-hidden="true">{{$top_author->author_name}}</a></h4>
                        <h5 class="total">
                           {{$top_author->total_book}} Books
                        </h5>
                     </div>
                     <ul class="social">
                        <li><a href="{{url('author_detail/'.$top_author->id)}}" class="" aria-hidden="true">View Details</a></li>
                     </ul>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </section>
      <section class="section-wrapper clearfix">
         <div class="section-header">
            <h3>Recent eBooks</h3>
         </div>
         <div class="recent-ebooks">
            <div class="row">
               <div class="grid-ebooks separator">
                  @foreach($latest_books as $key=>$latest_book)
                  <a href="{{route('ebook_view_detail',$latest_book->id)}}" class="ebook-card">
                     <div class="ebook-card-inner">
                        <div class="ebook-image clearfix">
                           @if($latest_book->is_feature == 1)
                           <ul class="ebook-ribbon list-inline">
                              <li><span class="ribbon bg-green"><i class="fa fa-star" aria-hidden="true"></i> Featured</span></li>
                           </ul>
                           @endif
                           <div class="image-holder">
                              <img src="{{$latest_book->cover_path.$latest_book->cover_photo}}">
                           </div>
                        </div>
                        <div class="ebook-content clearfix">
                           <span class="ebook-name div-ellipsis">
                           {{$latest_book->name}}
                           </span>
                           <span class="ebook-name div-ellipsis ebook-authors">
                           Authors: 
                           {{$latest_book->author_name}}
                           </span>
                        </div>
                        
                     </div>
                  </a>
                  @endforeach
               </div>
            </div>
         </div>
      </section>
      <!-- <a href="ebooks?category=business-finance" class="banner banner-lg" style="background-image: url(http://lavdemo.cssfloat.net/eBook/public/storage/media/Q3pZWfLOIwxPrn4ujgk1Lnm1PtjChlGPfXwUar79.jpeg);" target="_blank">
         <div class="overlay"></div>
         <div class="display-table">
            <div class="display-table-cell">
               <div class="banner-content">
                  <h2>Business eBook</h2>
                  <p>How to raise your business to the up level</p>
                  <span>
                  View All
                  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                  </span>
               </div>
            </div>
         </div>
      </a> -->
      <section class="category-tab clearfix">
         <div class="section-header clearfix">
            <h3 class="pull-left">Popular Categories</h3>
            <ul class="nav nav-tabs pull-right">
               @foreach($popular_categories as $key=>$popular_category)
               <li class="active">
                  <a data-toggle="tab" href="#tab-{{$key}}">{{$popular_category->name}}</a>
               </li>
               @endforeach
            </ul>
         </div>
         <div class="row">
            <div class="tab-content"> 
               @foreach($popular_categories as $key=>$popular_category)
               <div id="tab-{{$key}}" class="tab-pane fade in active">
                  <div class="tab-ebook-slider separator clearfix">
                     @foreach($popular_category->e_books as $key=>$e_book)
                     <div class="col-md-3">
                        <a href="{{url('ebook_view_detail/'.$e_book->id)}}" class="ebook-card">
                           <div class="ebook-card-inner">
                              <div class="ebook-image clearfix">
                                 <ul class="ebook-ribbon list-inline">
                                 </ul>
                                 <div class="image-holder">
                                    <img src="{{asset($e_book->cover_path.$e_book->cover_photo)}}">
                                 </div>
                              </div>
                              <div class="ebook-content clearfix">
                                 <span class="ebook-name div-ellipsis">
                                 Batman: {{$e_book->name}}
                                 </span>
                                 <span class="ebook-name div-ellipsis ebook-authors">
                                 Authors: 
                                 {{$e_book->author_name}}
                                 </span>
                              </div>
                              
                           </div>
                        </a>
                     </div>
                     @endforeach
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </section>
      
   </div>
</div>
@endsection
@section('js')
<script src="{{ asset('/assets/frontend/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
   
</script>
@endsection