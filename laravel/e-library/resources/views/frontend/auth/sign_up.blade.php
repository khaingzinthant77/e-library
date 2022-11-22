@extends('frontend.layouts.main')
@section('content')
<div class="content-wrapper clearfix">
   <div class="container">
      <div class="register-wrapper clearfix">
         <div class="col-lg-6 col-md-7 col-sm-10">
            <div class="row">
               <div class="form form-page no-lp-form-control form-overlay-layer">
                  <div class="top-overlay"></div>
                  <form method="POST" action="{{route('register')}}">
                     @csrf
                     @method('POST')
                   
                     <div class="form-inner clearfix">
                        <h3>Sign Up</h3>
                       
                        <div class="col-md-12">
                           <div class="form-group ">
                                 <label for="username">User Name<span>*</span></label>
                                 <input type="text" name="username" value="" class="form-control" id="username">
                              </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group ">
                                 <label for="ph_no">Phone<span>*</span></label>
                                 <input type="text" name="ph_no" value="" class="form-control" id="ph_no">
                              </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group ">
                              <label for="email">Email (optional)</label>
                              <input type="text" name="email" value="" class="form-control" id="email">
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group ">
                              <label for="password">Password<span>*</span></label>
                              <input type="password" name="password" class="form-control" id="password">
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group ">
                                 <label for="confirm-password">Confirm Password<span>*</span></label>
                                 <input type="password" name="password_confirmation" class="form-control" id="confirm-password">
                              </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                           <div class="checkbox">
                              <input type="checkbox" name="privacy_policy" id="privacy">
                              <label for="privacy">
                              I agree to the <a href="http://lavdemo.cssfloat.net/eBook/public/en/privacy-policy">privacy policy</a>
                              </label>
                           </div>
                           <div class="login-account pull-left p-t-15">
                              <span class="msg">Already have account?</span>
                              <a href="{{url('/sign_in')}}" id="show-signup" class="link">Sign In</a>
                           </div>
                           <button type="submit" class="btn btn-primary btn-register pull-right" data-loading>
                           Sign Up
                           </button>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection