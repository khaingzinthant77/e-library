<style type="text/css">
#nav {
  list-style: none inside;
  margin: 0;
  padding: 0;
  text-align: center;
}

#nav li {
  display: block;
  position: relative;
  float: left;
  /*background: #24af15;*/
  /* menu background color */
}

#nav li a {
  display: block;
  padding: 0;
  text-decoration: none;
  width: 200px;
  /* this is the width of the menu items */
  line-height: 35px;
  /* this is the hieght of the menu items */
  /*color: black;*/
  /* list item font color */
}

#nav li li a {
  font-size: 80%;
}


/* smaller font size for sub menu items */

/*#nav li:hover {
  background: black;
}*/


/* highlights current hovered list item and the parent list items when hovering over sub menues */

#nav ul {
  position: absolute;
  padding: 0;
  left: 0;
  display: none;
  /* hides sublists */
}

#nav li:hover ul ul {
  display: none;
}


/* hides sub-sublists */

#nav li:hover ul {
  display: block;
}


/* shows sublist on hover */

#nav li li:hover ul {
  display: block;
  /* shows sub-sublist on hover */
  margin-left: 200px;
  /* this should be the same width as the parent list item */
  margin-top: -35px;
  /* aligns top of sub menu with top of list item */
}
</style>
<div class="top-nav">
               <div class="container">
                  <div class="top-nav-wrapper clearfix">
                     <!-- <div class="top-nav-left pull-left">
                        <div class="dropdown supported_locales">
                           <a class="btn dropdown-toggle" href="#" id="supported_locales" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           <i class="fa fa-language" aria-hidden="true"></i>
                           English
                           <span class="caret"></span>
                           </a>
                           <ul class="dropdown-menu" aria-labelledby="supported_locales">
                              <li class=""><a href="http://lavdemo.cssfloat.net/eBook/public/ar" >Arabic</a></li>
                              <li class=""><a href="http://lavdemo.cssfloat.net/eBook/public/zh_CN" >Chinese (China)</a></li>
                              <li class="active"><a href="http://lavdemo.cssfloat.net/eBook/public/en" >English</a></li>
                              <li class=""><a href="http://lavdemo.cssfloat.net/eBook/public/ps" >Pashto</a></li>
                              <li class=""><a href="http://lavdemo.cssfloat.net/eBook/public/pt_BR" >Portuguese (Brazil)</a></li>
                           </ul>
                        </div>
                     </div> -->
                     <div class="top-nav-right pull-right">
                        <ul class="social-links list-inline">
                           <!-- <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                           <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                           <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                           <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                           <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                           <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                           <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li> -->
                           @if(auth()->user() == null)
                           <li><a href="{{url('/sign_in')}}">Sign In</a></li>
                           <li><a href="{{url('/sign_up')}}">Sign Up</a></li>
                           @else
                            <li><a href="">Hello, {{auth()->user()->name}}!</a></li>
                           @endif
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <section class="header-wrapper">
               <div class="header-inner">
                  <div class="container">
                     <button class="navbar-toggle visible-sm visible-xs pull-left" type="button">
                     <span class="top-bar icon-bar"></span>
                     <span class="middle-bar icon-bar"></span>
                     <span class="bottom-bar icon-bar"></span>
                     </button>
                     <a href="#" class="website-logo pull-left">
                     <img src="{{asset('ebook_logo.png')}}" alt="CynoInfotech">
                     </a>
                    <!--  <div id="myac-hl" class="profile-icon dropdown pull-right" >
                        <a class="btn dropdown-toggle" href="#" id="my-account-hl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="my-account-hl">
                           <li><a href="{{url('/sign_in')}}">Sign In</a></li>
                           <li><a href="{{url('/sign_up')}}">Sign Up</a></li>
                        </ul>
                     </div> -->
                    <ul id="nav" class="profile-icon dropdown pull-right" >
                       <li>
                           <a class="btn dropdown-toggle" href="#" id="my-account-hl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                              <span class="caret"></span>
                           </a>
                           @if(auth()->user() == null)
                            <ul class="dropdown-menu" aria-labelledby="my-account-hl">
                              <li style="text-align: center;"><a href="{{url('/sign_in')}}">Sign In</a></li>
                              <li style="text-align: center;"><a href="{{url('/sign_up')}}">Sign Up</a></li>
                           </ul>
                           @else
                           <ul class="dropdown-menu" aria-labelledby="my-account-hl">
                           <li style="text-align: center;">
                              <a href="{{url('member_ebooks')}}">
                              <i class="fa fa-home" aria-hidden="true"></i>
                              My Account</a>
                           </li>
                            <li style="text-align: center;">
                              <a href="{{url('favourite_list/'.auth()->user()->id)}}">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              My Favourite</a>
                           </li>
                           <!-- <li style="text-align: center;">
                              <a href="http://lavdemo.cssfloat.net/eBook/public/en/users/demo-user">
                              <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                              My Profile</a>
                           </li> -->
                          <!--  <li style="text-align: center;">
                              <a href="http://lavdemo.cssfloat.net/eBook/public/en/account/favorite">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              My Favorite
                              </a>
                           </li> -->
                           
                           <li style="text-align: center;">
                              <a href="{{url('/member_logout')}}">
                              <i class="fa fa-sign-out" aria-hidden="true"></i>
                              Logout
                              </a>
                           </li>
                          
                           <li role="separator" class="divider"></li>
                        </ul>
                           @endif
                        </li>
                      
                     </ul>
                     
                     <?php
                           $category_id = isset($_GET['category_id'])?$_GET['category_id']:'';
                           $keyword = isset($_GET['keyword'])?$_GET['keyword']:'';
                        ?>

                        
                     <div class="search-area pull-right">
                        <form action="{{route('cat_detail')}}" method="GET" id="search-box-form">
                           <div class="search-box hidden-sm hidden-xs">
                              <input type="text" name="keyword" class="search-box-input" placeholder="Search for ebooks..." value="{{ old('keyword',$keyword) }}">
                              <div class="search-box-button">
                                 <button class="search-box-btn btn btn-primary" type="submit">
                                 <i class="fa fa-search" aria-hidden="true"></i>
                                 </button>
                                 <select name="category_id" class="select search-box-select custom-select-black">
                                    <option value="" selected>Categories</option>
                                    
                                    @foreach(App\Helper\Helpers::getCategory() as $key=>$category)
                                    <option value="{{$category->id}}" {{ (old('category_id',$category_id)==$category->id)?'selected':'' }}>{{$category->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="mobile-search visible-sm visible-xs">
                              <div class="dropdown">
                                 <div class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                 </div>
                                 <div class="dropdown-menu">
                                    <div class="search-box">
                                       
                                       <div class="search-box-button">
                                          <button type="submit" class="search-box-btn btn btn-primary">
                                          <i class="fa fa-search" aria-hidden="true"></i>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </section>
            <div class="megamenu-wrapper hidden-sm hidden-xs">
               <div class="container">
                  <nav class="navbar navbar-default">
                     <div class="category-menu-wrapper pull-left hidden-sm visible">
                        <div class="category-menu-dropdown dropdown-toggle" data-toggle="dropdown">
                           <i class="fa fa-bars" aria-hidden="true"></i>
                           ALL Categories
                        </div>
                        
                     </div>
                     <ul class="nav navbar-nav">
                        <li class=" ">
                           <a href="{{url('/')}}" class="" target="_self">
                           Home
                           </a>
                           <ul class="dropdown-menu multi-level">
                           </ul>
                        </li>
                        <li class=" ">
                           <a href="{{url('/about_us')}}" class="" target="_self">
                           About Us
                           </a>
                           <ul class="dropdown-menu multi-level">
                           </ul>
                        </li>
                        <li class=" ">
                           <a href="{{url('ebooks_list')}}" class="" target="_self">
                           eBooks
                           </a>
                           <ul class="dropdown-menu multi-level">
                           </ul>
                        </li>
                        <!-- <li class=" ">
                           <a href="http://lavdemo.cssfloat.net/eBook/public/en/ebook/upload" class="" target="_self">
                           Upload eBook
                           </a>
                           <ul class="dropdown-menu multi-level">
                           </ul>
                        </li> -->
                        <!-- <li class=" ">
                           <a href="http://lavdemo.cssfloat.net/eBook/public/en/faq" class="" target="_self">
                           Faq
                           </a>
                           <ul class="dropdown-menu multi-level">
                           </ul>
                        </li> -->
                        <li class=" ">
                           <a href="{{url('contact_us')}}" class="" target="_self">
                           Contact Us
                           </a>
                           <ul class="dropdown-menu multi-level">
                           </ul>
                        </li>
                     </ul>
                  </nav>
               </div>
            </div>

<script type="text/javascript">
   

</script>