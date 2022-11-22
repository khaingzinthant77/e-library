@extends('frontend.layouts.main')
@section('content')
<div class="content-wrapper clearfix">
   <div class="container">
      <div class="breadcrumb">
         <ul class="list-inline">
            <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li><a href="{{url('ebooks_list')}}">eBooks</a></li>
            <li class="active">{{$cat_name}}</li>
         </ul>
      </div>
      <section class="ebook-list">
         <div class="row">
            <div class="col-md-3 col-sm-12">
               <div class="ebook-list-sidebar clearfix">
                  <div class="filter-section clearfix">
                     <ul class="filter-category list-inline">
                        <h4>Category</h4>
                        @foreach($categories as $key=>$category)
                        <li class="active">
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
                     <span>{{$e_books->count()}} Books found</span>
                  </div>
                  <div class="search-result-right pull-right">
                     <ul class="nav nav-tabs">
                        <li class="view-mode ">
                           <?php 
                              $current_url = url()->current();
                              $id = substr($current_url, -1);
                              // dd($id);
                            ?>
                           <a href="{{route('category_detail',$id)}}" title="Grid view">
                           <i class="fa fa-th-large" aria-hidden="true"></i>
                           </a>
                        </li>
                        <li class="view-mode active">
                           <a href="#" title="List view">
                           <i class="fa fa-th-list" aria-hidden="true"></i>
                           </a>
                        </li>
                     </ul>
                     
                  </div>
               </div>
               <div class="clearfix"></div>
               <div class="ebook-list-result clearfix">
                  <div class="tab-content">
                     <div id="grid-view" class="tab-pane ">
                        <div class="row">
                           <div class="grid-ebooks separator">
                           </div>
                        </div>
                     </div>
                     <div id="list-view" class="tab-pane active">
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
                                 <a href="http://lavdemo.cssfloat.net/eBook/public/en/ebooks/embed-code-demo-i39ae8s5" class="ebook-name">
                                    <h5>
                                       {{$e_book->name}}
                                    </h5>
                                 </a>
                                 <p>
                                    Authors: 
                                    <a href="http://lavdemo.cssfloat.net/eBook/public/en/authors/ricks-william">{{$e_book->author_name}}</a>
                                 </p>
                                 
                                 <p>
                                    <span class="ebook-rating">
                                    <i class="fa fa-star rated"></i>
                                    <i class="fa fa-star rated"></i>
                                    <i class="fa fa-star rated"></i>
                                    <i class="fa fa-star rated"></i>
                                    <i class="fa fa-star rated"></i>
                                    </span>
                                 </p>
                                 <p>{{Str::limit($e_book->remark, 300, $end='.......')}}</p>
                              </div>
                              <div class="ebook-card-buttons">
                                 
                                 <a href="{{route('ebook_view_detail',$e_book->id)}}" class="btn">
                                 View Details
                                 </a>
                              </div>
                           </div>
                        </div>
                        @endforeach
                        
                  </div>
               </div>
               <div class="pull-right">
               </div>
               
            </div>
         </div>
      </section>
   </div>
</div>
@endsection