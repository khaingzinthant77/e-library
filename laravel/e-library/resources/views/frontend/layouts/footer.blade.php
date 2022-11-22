
            <footer class="footer">
               <div class="container">
                  <div class="footer-top p-tb-50 clearfix">
                     <div class="row">
                        <div class="col-md-3">
                           <a href="#" class="footer-logo">
                           <img src="{{asset('ebook_logo.png')}}" class="img-responsive" alt="footer-logo">
                           </a>
                           <div class="clearfix"></div>
                          <!--  <p class="footer-brief">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s</p> -->
                        </div>
                        <div class="col-sm-4 col-md-3 footer-two">
                           <h4 class="title">Contact Info</h4>
                           <p><strong>Address : </strong> No. 14/585, 4th Street, Paung Laung Quarter, Pyinmana.</p>
                           <p><strong>Mail us : </strong><a title="Mail to: yourmail@domain.com" href="mailto:yourmail@domain.com">rnd@linncomputer.com</a></p>
                           <p><strong>Phone : </strong>09-789799799</p>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-3">
                           <div class="links">
                              <h4 class="title">Popular Categories</h4>
                              <ul class="list-inline">
                                 
                                  @foreach(App\Helper\Helpers::popular_category() as $key=>$category)
                                   <li><a href="{{url('category_detail/'.$category->id)}}">{{$category->cat_name}}</a></li>
                                  @endforeach
                              </ul>
                           </div>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-3">
                           <div class="links">
                              <h4 class="title">Get to Know Us</h4>
                              <ul class="list-inline">
                                 <li><a href="http://lavdemo.cssfloat.net/eBook/public/en/about-us">About Us</a></li>
                                 <li><a href="http://lavdemo.cssfloat.net/eBook/public/en/privacy-policy">Privacy Policy</a></li>
                                 <li><a href="http://lavdemo.cssfloat.net/eBook/public/en/terms-conditions">Terms &amp; Conditions</a></li>
                                 <li><a href="http://lavdemo.cssfloat.net/eBook/public/en/help">Help</a></li>
                                 
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="footer-bottom p-tb-20 clearfix">
                  <div class="container">
                     <div class="copyright text-center">
                        Copyright © 2022. All rights reserved.
                     </div>
                  </div>
               </div>
            </footer>
            <a class="scroll-top" href="#">
            <i class="fa fa-angle-up" aria-hidden="true"></i>
            </a>
           <!--  <cookie-bar inline-template>
            <div class="cookie-bar-wrap" :class="{ show: show }">
               <div class="container d-flex">
                  <div class="col-xl-10 col-lg-12">
                     <div class="row">
                        <div class="cookie-bar">
                           <div class="cookie-bar-text">
                              By using our site you agree to our use of cookies to deliver a better site experience.
                           </div>
                           <div class="cookie-bar-action">
                              <button class="btn btn-primary btn-accept" @click="accept">
                              Got it
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </cookie-bar> -->