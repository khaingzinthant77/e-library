@extends('backend.layouts.main')
@section('content')
    <div class="content-wrapper">
            <section class="content-header">
               <h1>Dashboard</h1>
               <ol class="breadcrumb">
                  <li><a href="https://library.greensoftbd.xyz/dashboard/index"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                  <li class="active">Dashboard</li>
               </ol>
            </section>
            <section class="content">
               <div class="box box-mytheme">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="box-body" style="width: 100%">
                           <canvas id="canvas" width="600" height="200"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-6">
                     <div class="box box-mytheme">
                        <div class="box-header">
                           <i class="fa fa-comments-o"></i>
                           <h3 class="box-title">Chat</h3>
                        </div>
                        <div class="box-body chat mainchatbox" id="chat-box">
                           <div class="text-center">
                              <button class="btn btn-xs btn-mytheme loadmore"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Load More</button>
                           </div>
                           <div class="chatboxmessage">
                              <!-- chat item -->
                              <div class="item chatID" data-chatid="1">
                                 <img src="https://library.greensoftbd.xyz/uploads/member/default.png" alt="member image" class="offline">
                                 <p class="message">
                                    <a href="#" class="name">
                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 28 Jul 2020 22:06</small>
                                    Admin                                    </a>
                                    Hello                                
                                 </p>
                              </div>
                              <div class="item chatID" data-chatid="2">
                                 <img src="https://library.greensoftbd.xyz/uploads/member/default.png" alt="member image" class="offline">
                                 <p class="message">
                                    <a href="#" class="name">
                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 28 Jul 2020 22:06</small>
                                    Admin                                    </a>
                                    Good Morning Everyone                                
                                 </p>
                              </div>
                              <!-- chat item -->
                           </div>
                        </div>
                        <!-- /.chat -->
                        <div class="box-footer">
                           <div class="input-group">
                              <input class="form-control" type="text" id="chatmessage" name="chatmessage" placeholder="Type Message...">
                              <div class="input-group-btn">
                                 <button type="button" class="btn btn-mytheme" id="chatmessagesend"><i class="fa fa-send"></i></button>
                                 <button type="button" class="btn btn-danger" id="chatmessagerefresh"><i class="fa fa-refresh fa-spin"></i></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="box box-mytheme">
                        <form action="https://library.greensoftbd.xyz/dashboard/quickmail" method="post">
                           <div class="box-header">
                              <i class="fa fa-envelope"></i>
                              <h3 class="box-title">Quick Email</h3>
                           </div>
                           <div class="box-body">
                              <div class="form-group">
                                 <input type="email" class="form-control" name="email" placeholder="Email">
                              </div>
                              <div class="form-group">
                                 <input type="text" class="form-control" name="subject" placeholder="Subject">
                              </div>
                              <div class="form-group">
                                 <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                              </div>
                           </div>
                           <div class="box-footer clearfix">
                              <button type="submit" class="pull-right btn btn-default" id="sendEmail"> Send <i class="fa fa-arrow-circle-right"></i></button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </section>
    </div> 
@endsection
@section('js')
    <script type="text/javascript">
        var dashboard_provide_message = "Please provide message";
        var dashboard_income          = [0,0,0,0,50000,0,70000,0,50000,25000,40000,0];
        var dashboard_expense         = [0,100000,0,50000,0,0,50000,0,80000,40000,0,0];
    </script> 
    <script type="text/javascript">
         if ($.fn.datepicker) {
             $('.datepicker').datepicker({
                 autoclose: true,
                 format : 'dd-mm-yyyy',
             });
         }
         var globalFilebrowse = "File Browse";
      </script>
    <script src="{{ asset('assets/custom/js/dashboard.js')}}"></script>
@endsection