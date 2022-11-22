@extends('frontend.layouts.main')
@section('content')
<div class="content-wrapper clearfix">
               <div class="container">
                  <div class="breadcrumb">
                     <ul class="list-inline">
                        <li><a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="active">Contact</li>
                     </ul>
                  </div>
                  <section class="contact-wrapper">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-8">
                                 <div class="form form-page form-overlay-layer no-lp-form-control">
                                    <div class="top-overlay"></div>
                                    <form method="POST" action="{{route('contact_mail')}}" class="clearfix">
                                        @csrf
                                        @method('POST')     
                                       <div class="form-inner clearfix">
                                          <h3>PLEASE GET IN TOUCH</h3>
                                          <div class="col-md-6">
                                            
                                             <div class="form-group ">
                                                <label for="email">Email<span>*</span></label>
                                                <input type="text" name="email" class="form-control" id="email" value="">
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                            
                                             <div class="form-group ">
                                                <label for="subject">Subject<span>*</span></label>
                                                <input type="text" name="subject" class="form-control" id="subject" value="">
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <div class="form-group ">
                                                <label for="message">Message<span>*</span></label>
                                                <textarea name="message" cols="30" rows="10" id="message"></textarea>
                                             </div>
                                            
                                             <button type="submit" class="btn btn-primary btn-submit pull-right" data-loading>
                                             Submit
                                             </button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="contact-right clearfix">
                                    <div class="contact-info">
                                       <div class="contact-text">
                                        
                                          <p>&nbsp;</p>
                                          <h4>Phone</h4>
                                          09-789799799
                                       </div>
                                    </div>
                                    <div class="contact-info">
                                       <div class="contact-text">
                                          <h4>Email</h4>
                                          rnd@linncomputer.com
                                       </div>
                                    </div>
                                    <div class="contact-info">
                                       <div class="contact-text">
                                          <h4>Address</h4>
                                         	No. 14/585, 4th Street, Paung Laung Quarter, Pyinmana.
                                       </div>
                                       <div class="contact-text">Phone No &ndash;09-789799799</div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
               </div>
            </div>
@endsection