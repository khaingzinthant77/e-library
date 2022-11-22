@extends('frontend.layouts.main')
@section('content')
<div class="content-wrapper clearfix">
   <div class="container">
      <div class="breadcrumb">
         <ul class="list-inline">
            <li><a href="http://lavdemo.cssfloat.net/eBook/public/en"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li><a href="http://lavdemo.cssfloat.net/eBook/public/en/authors">Authors</a></li>
            <li class="active">{{$authors->name}}</li>
         </ul>
      </div>
      <section class="ebook-list">
         <div class="row">
            <div class="col-md-4 col-sm-12">
               <div class="ebook-list-sidebar user-details clearfix">
                  <div class="user-details-section clearfix">
                     <div class="image-placeholder">
                        <img src="{{asset($authors->path.$authors->photo)}}">
                     </div>
                     <h4>{{$authors->name}}</h4>
                     <div class="details-section">
                        <p>{{$authors->personal_data}}</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-8 col-sm-12">
               <div class="ebook-list-header clearfix">
                  <div class="search-result-title pull-left">
                     <h3>Books by {{$authors->name}}</h3>
                     <span>{{$count}} Books found</span>
                  </div>
                 <!--  <div class="search-result-right pull-right">
                     <ul class="nav nav-tabs">
                        <li class="view-mode active">
                           <a href="#" title="Grid view">
                           <i class="fa fa-th-large" aria-hidden="true"></i>
                           </a>
                        </li>
                        <li class="view-mode ">
                           <a href="http://lavdemo.cssfloat.net/eBook/public/en/authors/ricks-william?viewMode=list" title="List view">
                           <i class="fa fa-th-list" aria-hidden="true"></i>
                           </a>
                        </li>
                     </ul>
                  </div> -->
               </div>
               <div class="clearfix"></div>
               <div class="ebook-list-result clearfix">
                  <div class="tab-content">
                     <div id="grid-view" class="tab-pane active">
                        <div class="row">
                           <div class="grid-ebooks separator">
                           	@foreach($e_books as $key=>$e_book)
                              <a href="{{url('ebook_view_detail/'.$e_book->id)}}" class="ebook-card">
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
                                       <i class="fa fa-lock has-error" aria-hidden="true" ></i>
                                      {{$e_book->book_name}}
                                       </span>
                                       <span class="ebook-name div-ellipsis ebook-authors">
                                       Authors: 
                                       {{$e_book->author_name}}
                                       </span>
                                    </div>
                                    <!-- <div class="more-details-wrapper">
                                       <form method="POST" action="">
                                          <input type="hidden" name="_token" value="7Qo9RaaudGou89kViohEizsScOLhULwRzdbZYtg8">
                                          <input type="hidden" name="ebook_id" value="1">
                                          <button type="submit" class="btn btn-favorite" data-toggle="tooltip" data-placement="right" title="Add to Favorite">
                                          <i class="fa fa-heart-o" aria-hidden="true"></i>
                                          </button>
                                       </form>
                                       <span class="ebook-rating">
                                       <i class="fa fa-star rated"></i>
                                       <i class="fa fa-star rated"></i>
                                       <i class="fa fa-star rated"></i>
                                       <i class="fa fa-star rated"></i>
                                       <i class="fa fa-star rated"></i>
                                       </span>
                                       
                                    </div> -->
                                 </div>
                              </a>
                              @endforeach
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- <div class="pull-right">
                  <nav>
                     <ul class="pagination">
                        <li class="page-item disabled" aria-disabled="true" aria-label="pagination.previous">
                           <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                        <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                        <li class="page-item"><a class="page-link" href="http://lavdemo.cssfloat.net/eBook/public/en/authors/ricks-william?page=2">2</a></li>
                        <li class="page-item">
                           <a class="page-link" href="http://lavdemo.cssfloat.net/eBook/public/en/authors/ricks-william?page=2" rel="next" aria-label="pagination.next">&rsaquo;</a>
                        </li>
                     </ul>
                  </nav>
               </div> -->
            </div>
         </div>
      </section>
   </div>
</div>
@endsection