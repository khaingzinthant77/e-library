@extends('frontend.layouts.main')
@section('content')
<div class="content-wrapper clearfix">
<div class="container">
<div class="breadcrumb">
   <ul class="list-inline">
      <li><a href="http://lavdemo.cssfloat.net/eBook/public/en"><i class="fa fa-home" aria-hidden="true"></i></a></li>
      <li class="active">eBooks</li>
   </ul>
</div>
<section class="ebook-list">
   <div class="row">
      <div class="col-md-3 col-sm-12">
         <div class="ebook-list-sidebar clearfix">
            <div class="filter-section clearfix">
               <ul class="filter-category list-inline">
                  <h4>Category</h4>
                  @foreach($categories as $category)
                  <li class="">
                     <a href="{{route('category_list_view',$category->id)}}">
                     {{$category->name}}
                     </a>
                  </li>
                  @endforeach
               </ul>
            </div>
         </div>
      </div>
      <div class="col-md-9 col-sm-12">
         <div class="ebook-list-header clearfix">
            <div class="search-result-title pull-left">
               <h3>eBooks</h3>
               <span>{{$count}} Books found</span>
            </div>
            <div class="search-result-right pull-right">
               <ul class="nav nav-tabs">
                  <li class="view-mode active" id="grid">
                     <a href="#grid_tab" title="Grid view" class="grid_tab">
                     <i class="fa fa-th-large" aria-hidden="true"></i>
                     </a>
                  </li>
                  <li class="view-mode " id="list">
                     <a href="#list_tab" title="List view" class="list_tab">
                     <i class="fa fa-th-list" aria-hidden="true"></i>
                     </a>
                  </li>
               </ul>
               
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="ebook-list-result clearfix">
            <div class="tab-content">
               <div id="grid-view" class="tab-pane active">
                  <div class="row">
                     <div class="grid-ebooks separator">
                        @foreach($e_books as $key=>$e_book)
                        <a href="{{route('ebook_view_detail',$e_book->id)}}" class="ebook-card">
                           <div class="ebook-card-inner">
                              <div class="ebook-image clearfix">
                                 @if($e_book->is_feature)
                                 <ul class="ebook-ribbon list-inline">
                                    <li><span class="ribbon bg-green"><i class="fa fa-star" aria-hidden="true"></i> Featured</span></li>
                                 </ul>
                                 @endif
                                 <div class="image-holder">
                                    <img src="{{asset($e_book->cover_path.$e_book->cover_photo)}}">
                                 </div>
                                 <div class="hover-action">
                                 </div>
                              </div>
                              <div class="ebook-content clearfix">
                                 <span class="ebook-name div-ellipsis">
                                 {{$e_book->name}}
                                 </span>
                                 <span class="ebook-name div-ellipsis ebook-authors">
                                 Authors: 
                                 {{$e_book->author_name}}
                                 </span>
                              </div>
                             <!--  <div class="more-details-wrapper">
                                 <form method="POST" action="">
                                    <input type="hidden" name="_token" value="qVOzuJk2n3dULzbyGI98lG03t1LnGye4v5IcqBSu">
                                    <input type="hidden" name="_method" value="delete">   
                                    <button type="submit" class="btn btn-favorite" data-toggle="tooltip" data-placement="right" title="Remove From Favorite">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    </button>
                                 </form>
                                 <span class="ebook-rating">
                                 <i class="fa fa-star rated"></i>
                                 <i class="fa fa-star rated"></i>
                                 <i class="fa fa-star rated"></i>
                                 <i class="fa fa-star rated"></i>
                                 <i class="fa fa-star-o"></i>
                                 </span>
                                
                              </div> -->
                           </div>
                        </a>
                        @endforeach
                     </div>
                  </div>
               </div>
               <div id="list-view" class="tab-pane">
                  @foreach($e_books as $key=>$e_book)
                        <div class="ebook-card-list clearfix">
                           <a class="ebook-image pull-left" href="{{route('ebook_view_detail',$e_book->id)}}">
                              @if($e_book->is_feature == 1)
                              <ul class="ebook-ribbon list-inline">
                                 <li><span class="ribbon bg-green"><i class="fa fa-star" aria-hidden="true"></i> Featured</span></li>
                              </ul>
                              @endif
                              <div class="image-holder">
                                 <img src="{{asset($e_book->cover_path.$e_book->cover_photo)}}">
                              </div>
                           </a>
                           <div class="ebook-content clearfix">
                              <div class="ebook-content-inner">
                                 <a href="{{route('ebook_view_detail',$e_book->id)}}" class="ebook-name">
                                    <h5>
                                       {{$e_book->name}}
                                    </h5>
                                 </a>
                                 <p>
                                    Authors: 
                                    <a href="">{{$e_book->author_name}}</a>
                                 </p>
                                 
                                 <!-- <p>
                                    <span class="ebook-rating">
                                    <i class="fa fa-star rated"></i>
                                    <i class="fa fa-star rated"></i>
                                    <i class="fa fa-star rated"></i>
                                    <i class="fa fa-star rated"></i>
                                    <i class="fa fa-star rated"></i>
                                    </span>
                                 </p> -->
                                 <p>{{Str::limit($e_book->remark, 300, $end='.......')}}</p>
                              </div>
                              <div class="ebook-card-buttons">
                                 <!-- <form method="POST" action="">
                                    
                                    <input type="hidden" name="ebook_id" value="58">
                                    <button type="submit" class="btn btn-favorite" data-toggle="tooltip" data-placement="left" title="Add to Favorite">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    </button>
                                 </form> -->
                                 <a href="{{route('ebook_view_detail',$e_book->id)}}" class="btn">
                                 View Details
                                 </a>
                              </div>
                           </div>
                        </div>
                        @endforeach
               </div>
            </div>
         </div>
         <div class="pull-right">
            {!! $e_books->appends(request()->input())->links() !!}
         </div>
         
      </div>
   </div>
</section>
</div>
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
   $('a.list_tab').click(function(){
      // alert('hi');
       $('#grid-view').removeClass("active");
       $('#list-view').addClass('active');
       $('#list').addClass('active');
       $('#grid').removeClass('active');
       $(this).addClass("active");
   });

   $('a.grid_tab').click(function(){
       $('#grid-view').addClass("active");
       $('#list-view').removeClass('active');
       $('#list').removeClass('active');
       $('#grid').addClass('active');
       $(this).addClass("active");
   });
</script>
@endsection