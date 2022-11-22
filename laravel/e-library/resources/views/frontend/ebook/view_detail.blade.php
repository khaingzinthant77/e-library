@extends('frontend.layouts.main')
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">
@section('content')
<div class="content-wrapper clearfix">
   <div class="container">
      <div class="breadcrumb">
         <ul class="list-inline">
            <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li><a href="{{url('ebooks_list')}}">eBooks</a></li>
            <li class="active">{{$book_data->name}}</li>
         </ul>
      </div>
      <div class="ebook-details-wrapper">
         <div class="row m-b-20">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
               <div class="ebook-image">
               	@if($book_data->is_feature == 1)
                  <ul class="ebook-ribbon hidden-xs">
                     <li><span class="ribbon bg-green"><i class="fa fa-star" aria-hidden="true"></i> Featured</span></li>
                  </ul>
                  @endif
                  <div class="base-image">
                     <a class="base-image-inner" href="{{asset($book_data->cover_path.$book_data->cover_photo)}}">
                     <img src="{{asset($book_data->cover_path.$book_data->cover_photo)}}" alt="">
                     </a>
                  </div>
               </div>
               <div class="row" style="margin-top:10px;margin-left:10px;">
                  <form method="POST" action="{{route('add_ebook_list')}}">
                     @csrf
                     @method('POST')
                     <input type="hidden" name="ebook_id" value="{{$book_data->id}}">
                     @if($favourite != null)
                     <input type="hidden" name="fav_id" value="{{$favourite->id}}">
                     @else
                     <input type="hidden" name="fav_id" value="">
                     @endif

                     @if(auth()->user() != null)
                     <input type="hidden" name="member_id" value="{{auth()->user()->id}}">
                     @else
                     <input type="hidden" name="member_id" value="">
                     @endif
                     <button type="submit" class="btn btn-favorite" data-toggle="tooltip" data-placement="right" title="Add to Favorite">
                        @if($favourite == null)
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                        @else
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        @endif
                     </button>
                  </form>
                 <!--  <span class="ebook-rating">
                  <i class="fa fa-star rated"></i>
                  <i class="fa fa-star rated"></i>
                  <i class="fa fa-star rated"></i>
                  <i class="fa fa-star rated"></i>
                  <i class="fa fa-star-o"></i>
                  </span> -->
                 
               </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
               <div class="ebook-details">
                  <h2 class="ebook-name">
                    {{$book_data->name}}
                     <div class="clearfix"></div>
                  </h2>
                  <div class="ebook-statistics m-b-10">
                     <span class="ebook-rating">
                     <i class="fa fa-star rated"></i>
                     <i class="fa fa-star rated"></i>
                     <i class="fa fa-star rated"></i>
                     <i class="fa fa-star rated"></i>
                     <i class="fa fa-star rated"></i>
                     </span>
                     <span class="ebook-review pull-left">
                     ({{$book_data->rating_user}} User reviews)
                     </span>
                     <span class="ebook-view pull-left" data-toggle="tooltip" data-placement="top" title="Views">
                     <i class="fa fa-eye"></i> &nbsp; {{$book_data->read_count}}
                     </span>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="ebook-byinon m-b-10">
                     <span class="ebook-user pull-left">By 
                     <a href="{{url('author_detail/'.$book_data->author_id)}}">{{$book_data->author_name}}</a>
                     </span>
                     <span class="ebook-on pull-left"> Posted on <a href="#">{{date('M',strtotime($book_data->created_at))}} {{date('d',strtotime($book_data->created_at))}}, {{date('Y',strtotime($book_data->created_at))}}</a></span>
                     <div class="clearfix"></div>
                     <span class="ebook-incat pull-left ">
                     In Category -  
                     <a href="{{url('category_detail/'.$book_data->cat_id)}}">
                     {{$book_data->cat_name}}
                     </a>
                     </span>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="ebook-other m-b-10">
                     <span class="ebook-authors show"> 
                     <label>Authors:</label>
                     <a href="{{url('author_detail/'.$book_data->author_id)}}">{{$book_data->author_name}}</a>
                     </span>
                     
                     
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="ebook-brief">{{Str::limit($book_data->remark, 500, $end='.......')}}</div>
                  @if($ebook_count == 0)
                  <div class="clearfix">
                     <a href="{{route('rent_book',$book_data->id)}}" class="btn btn-success">Rent</a>
                  </div>
                  @endif
               </div>
            </div>
         </div>
         @if(auth()->user() != null)
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
               <div class="panel-group " id="ebook-files-preview" role="tablist" aria-multiselectable="true">
                  <!--Main File-->
                  <!--Files-->
                  <div class="panel panel-default">
                     <div class="panel-heading text-left" role="tab" id="heading-file-1">
                        <h4 class="panel-title">
                           <a role="button" data-toggle="collapse" data-parent="#ebook-files-preview" href="#collapse-file-1" aria-expanded="true" aria-controls="collapse-file-1">
                           File: {{$book_data->name}}
                           </a>
                        </h4>
                     </div>
                     <div id="collapse-file-1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-file-1">
                        <div class="panel-body" >
                           <!-- <iframe src="{{asset($book_data->file_path.$book_data->file_name)}}" width="100%" height="500"></iframe>  -->
                           <div id="pdffile" style="height: 800px;"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @endif
         <div class="row">
            <div class="col-md-12">
               <div class="tab ebook-tab clearfix">
                  <ul class="nav nav-tabs">
                     <li class="active" id="des">
                        <a data-toggle="tab" href="#description" class="desc">Description</a>
                     </li>
                     <li class=" " id="rev">
                        <a data-toggle="tab" href="#reviews_tab" class="reviews_tab">Reviews</a>
                     </li>
                     <!-- <li id="comment-tab" class=" ">
                        <a data-toggle="tab" href="#comments">Comments</a>
                     </li> -->
                  </ul>
                  <div class="tab-content">
                     <div id="description" class="description tab-pane fade in active">
                        <p>{{$book_data->remark}}</p>
                     </div>
                     <div id="reviews_tab" class="reviews_tab tab-pane fade in ">
                        <div class="row">
                           <div class="col-lg-8 col-md-7">
                              <div class="user-review clearfix">
                              	@foreach($rating_lists as $key=>$rating_list)
                                 <div class="comment">
                                    <div class="comment-details">
                                       <div class="col-lg-3">
                                          <h5 class="user-name">{{$rating_list->member_name}}</h5>
                                          <span class="ebook-rating">
                                          	@if($rating_list->rate_count == 5)
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star rated"></i>
	                                          @elseif($rating_list->rate_count == 4)
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star"></i>
	                                          @elseif($rating_list->rate_count == 3)
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star"></i>
	                                          <i class="fa fa-star"></i>

	                                          @elseif($rating_list->rate_count == 2)
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star "></i>
	                                          <i class="fa fa-star "></i>
	                                          <i class="fa fa-star "></i>

	                                          @elseif($rating_list->rate_count == 1)
	                                          <i class="fa fa-star rated"></i>
	                                          <i class="fa fa-star"></i>
	                                          <i class="fa fa-star"></i>
	                                          <i class="fa fa-star"></i>
	                                          <i class="fa fa-star"></i>
	                                          @else
	                                          <i class="fa fa-star"></i>
	                                          <i class="fa fa-star"></i>
	                                          <i class="fa fa-star"></i>
	                                          <i class="fa fa-star"></i>
	                                          <i class="fa fa-star"></i>
	                                          @endif
                                          </span>
                                          <?php 
                                              $now = new DateTime;
            										    $ago = new DateTime($rating_list->created_at);
            										    $diff = $now->diff($ago);

            										    $diff->w = floor($diff->d / 7);
            										    $diff->d -= $diff->w * 7;

            										    $string = array(
            										        'y' => 'year',
            										        'm' => 'month',
            										        'w' => 'week',
            										        'd' => 'day',
            										        'h' => 'hour',
            										        'i' => 'minute',
            										        's' => 'second',
            										    );
            										    foreach ($string as $k => &$v) {
            										        if ($diff->$k) {
            										            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            										        } else {
            										            unset($string[$k]);
            										        }
            										    }

            										    if (true) $string = array_slice($string, 0, 1);
            										    $data  = $string ? implode(', ', $string) . ' ago' : 'just now';
                                                       ?>
                                          <span class="time" data-toggle="tooltip" title="Nov 29, 2021">
                                         {{$data}}
                                          </span>
                                       </div>
                                      <!--  <div class="col-lg-9">
                                          <p class="user-text1">sadfsdf</p>
                                       </div> -->
                                       <div class="clearfix"></div>
                                    </div>
                                 </div>
                                 @endforeach
                                 <div class="pull-right">
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4 col-md-5">
                              <div class="rating">
                                 <div class="average-rating clearfix">
                                    <div class="average pull-left">
                                       <span>{{$book_data->rating_count}}</span>
                                    </div>
                                    <div class="pull-left">
                                       <span class="ebook-rating">
                                       <i class="fa fa-star rated"></i>
                                       <i class="fa fa-star rated"></i>
                                       <i class="fa fa-star rated"></i>
                                       <i class="fa fa-star rated"></i>
                                       <i class="fa fa-star rated"></i>
                                       </span>
                                       <span class="rate-of-average">
                                       {{$book_data->rating_count}} out of 5
                                       ({{$book_data->rating_user}} User reviews )
                                       </span>
                                    </div>
                                 </div>
                              </div>
                              <!-- <div class="review-form clearfix">
                                 <form method="POST" action="http://lavdemo.cssfloat.net/eBook/public/en/ebooks/58/reviews" class="clearfix">
                                    <input type="hidden" name="_token" value="7Qo9RaaudGou89kViohEizsScOLhULwRzdbZYtg8">
                                    <h3>Add a Review</h3>
                                    <span>
                                    Your Rating
                                    <span class="rating-required">*</span>
                                    </span>
                                    <div class="clearfix"></div>
                                    <fieldset class="rating">
                                       <input type="radio" id="star-5" name="rating" value="5">
                                       <label class="full" for="star-5" data-toggle="tooltip" title="5 star"></label>
                                       <input type="radio" id="star-4" name="rating" value="4">
                                       <label class="full" for="star-4" data-toggle="tooltip" title="4 star"></label>
                                       <input type="radio" id="star-3" name="rating" value="3">
                                       <label class="full" for="star-3" data-toggle="tooltip" title="3 star"></label>
                                       <input type="radio" id="star-2" name="rating" value="2">
                                       <label class="full" for="star-2" data-toggle="tooltip" title="2 star"></label>
                                       <input type="radio" id="star-1" name="rating" value="1">
                                       <label class="full" for="star-1" data-toggle="tooltip" title="1 star"></label>
                                    </fieldset>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="form-group ">
                                             <label for="reviewer-name">
                                             Name<span>*</span>
                                             </label>
                                             <input type="text" name="reviewer_name" class="form-control" id="reviewer-name" value="">
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="form-group ">
                                             <label for="comment">
                                             Your Review<span>*</span>
                                             </label>
                                             <textarea name="comment" class="form-control" id="comment" cols="30" rows="5"></textarea>
                                          </div>
                                       </div>
                                       <div class="clearfix"></div>
                                       <div class="col-md-12">
                                          <div class="form-group ">
                                             <img src="http://lavdemo.cssfloat.net/eBook/public/captcha/image?_=1707701353"
                                                style="cursor:pointer;width:180px;height:50px;"
                                                title="Update Code"
                                                onclick="this.setAttribute('src','http://lavdemo.cssfloat.net/eBook/public/captcha/image?_=1707701353?_='+Math.random());var captcha=document.getElementById('captcha');if(captcha){captcha.focus()}"
                                                >
                                             <input type="text" name="captcha" id="captcha" class="captcha-input">
                                          </div>
                                       </div>
                                       <button type="submit" class="btn btn-primary review-submit" data-loading>
                                       Add Review
                                       </button>
                                    </div>
                                 </form>
                              </div> -->
                           </div>
                        </div>
                     </div>
                   
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- <section class="ad-wrapper clearfix">
         <div class="row">
            <div class="col-lg-12 col-sm-12">
               Advertisement 2
            </div>
         </div>
      </section> -->
      <section class="ebook-slider-wrapper clearfix">
         <div class="section-header">
            <h3>Related eBooks</h3>
         </div>
         <div class="row">
            <div class="ebook-slider slick-arrow separator clearfix">
            	@foreach($books as $key=>$book)
               <div class="col-md-3">
                  <a href="{{route('ebook_view_detail',$book->id)}}" class="ebook-card">
                     <div class="ebook-card-inner">
                        <div class="ebook-image clearfix">
                           <ul class="ebook-ribbon list-inline">
                           </ul>
                           <div class="image-holder">
                              <img src="{{asset($book->cover_path.$book->cover_photo)}}">
                           </div>
                        </div>
                        <div class="ebook-content clearfix">
                           <span class="ebook-name div-ellipsis">
                           {{$book->name}}
                           </span>
                           <span class="ebook-name div-ellipsis ebook-authors">
                           Authors: 
                           {{$book->author_name}}
                           </span>
                        </div>
                        
                     </div>
                  </a>
               </div>
               @endforeach
            </div>
         </div>
      </section>
     
   </div>
</div>
@endsection

@section('js')
<script src="{{asset('assets/custom/js/pdfobject.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="<?= url('assets/plugins/toastr/toastr.min.js')?>"></script>
<script type="text/javascript">
    var e_book = <?php print_r(json_encode($book_data)) ?>;
   
    var options = {
        pdfOpenParams: { view: 'Fit', pagemode: 'none', scrollbar: '1', toolbar: '1', statusbar: '1', messages: '1', navpanes: '1' }
    };

    PDFObject.embed(window.location.origin+'/'+ e_book.file_path+e_book.file_name, "#pdffile");


	$('a.reviews_tab').click(function(){
	    $('#description').removeClass("active");
	    $('#reviews_tab').addClass('active');
	    $('#rev').addClass('active');
	    $('#des').removeClass('active');
	    $(this).addClass("active");
	});

	$('a.desc').click(function(){
	    $('#description').addClass("active");
	    $('#reviews_tab').removeClass('active');
	    $('#rev').removeClass('active');
	    $('#des').addClass('active');
	    $(this).addClass("active");
	});
    <?php 
        $success = session('success');
        $error   = session('error');
        if($success) { ?>
            toastr.success('<?=$success?>');
        <?php } elseif($error) { ?>
            toastr.error('<?=$error?>');
        <?php } ?>
</script>

@endsection