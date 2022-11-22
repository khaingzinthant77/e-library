@extends('frontend.layouts.main')
@section('content')
<div class="content-wrapper clearfix">
               <div class="container">
                  <div class="form-wrapper">
                     <div class="form form-page form-overlay-layer">
                        <div class="top-overlay"></div>
                        <form method="POST" action="{{route('sign_in')}}" class="login-form clearfix">
                          @csrf
                          @method('POST')
                           <div class="login form-inner clearfix">
                              <h3>Sign In</h3>
                              <div class="form-group ">
                                 <label for="phone">Phone<span>*</span></label>
                                 <input type="text" name="ph_no" value="" class="form-control" id="ph_no" placeholder="Phone" autofocus>
                                 <div class="input-icon">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                 </div>
                              </div>
                              <div class="form-group ">
                                 <label for="password">Password<span>*</span></label>
                                 <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                 <div class="input-icon">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                 </div>
                              </div>
                              <div class="clearfix"></div>
                              <button type="submit" class="btn btn-primary btn-center btn-login" data-loading>
                              Sign In
                              </button>
                              <div class="checkbox pull-left">
                                 <input type="hidden" value="0">
                                 <input type="checkbox" value="1" id="remember">
                                 <label for="remember">Remember me</label>
                              </div>
                              <a href="http://lavdemo.cssfloat.net/eBook/public/en/password/reset" class="forgot-password pull-right">
                              Forgot Password?
                              </a>
                              <div class="clearfix"></div>
                              <div class="login-account text-center">
                                 <span class="msg">Don&#039;t have an account yet ?</span>
                                 <a href="{{url('/sign_up')}}" id="show-signup" class="link">Sign Up</a>
                              </div>
                              <div class="clearfix"></div>
                              
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
@endsection