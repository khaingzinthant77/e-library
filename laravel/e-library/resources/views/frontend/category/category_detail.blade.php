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
               <div class="ebook-list-header clearfix">
                  <div class="search-result-title pull-left">
                     <h3>eBooks</h3>
                     <span>{{$e_books->count()}} Books found</span>
                  </div>
                  <div class="search-result-right pull-right">
                     <ul class="nav nav-tabs">
                        <li class="view-mode active">
                           <a href="#" title="Grid view">
                           <i class="fa fa-th-large" aria-hidden="true"></i>
                           </a>
                        </li>
                        <li class="view-mode">
                           <?php 
                              $current_url = url()->current();
                              $id = substr($current_url, -1);
                              // dd($id);
                            ?>
                           <a href="{{route('category_list_view',$id)}}" title="List view">
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
                                    	@if($e_book->is_feature == 1)
                                       <ul class="ebook-ribbon list-inline">
                                          <li><span class="ribbon bg-green"><i class="fa fa-star" aria-hidden="true"></i> Featured</span></li>
                                       </ul>
                                       @endif
                                       <div class="image-holder">
                                          <img src="{{asset($e_book->cover_path.$e_book->cover_photo)}}">
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
                                    
                                 </div>
                              </a>
                              @endforeach
                           </div>
                        </div>
                     </div>
                     <div id="list-view" class="tab-pane ">
                     </div>
                  </div>
               </div>
               <div class="pull-right">
               </div>
               <!-- <section class="ad-wrapper clearfix">
                  <div class="row">
                     <div class="col-lg-12 col-sm-12">
                        Advertisement 2
                     </div>
                  </div>
               </section> -->
            </div>
         </div>
      </section>
   </div>
</div>
@endsection