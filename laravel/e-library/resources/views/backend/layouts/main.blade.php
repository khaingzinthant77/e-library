<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/Ionicons/css/ionicons.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/iconmoon/style.css') }}">
      <!-- All Controllers css files Load Here -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/chartjs/Chart.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/skin-blue.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/custom/css/style.css') }}">
      <!-- jQuery 3 -->
      <script src="{{ asset('assets/plugins/jquery/dist/jquery.min.js')}}"></script>
      <!-- All Controllers Js files Load Here -->
      <script src="{{ asset('assets/plugins/chartjs/Chart.min.js')}}"></script>
      <link rel="shortcut icon" type="image/x-icon" href="https://library.greensoftbd.xyz/uploads/images/f35ff8f9eb9768fcef25be8c7fe37ddd789a17cf16f6cfe9dc9c1fee656b4c30b18d8462b7f198e04e438b84d46b29bacdd2d4ebe37d70f04d66c88565a9e061.jpg">
      <script type="text/javascript">
         var THEME_BASE_URL = "https://library.greensoftbd.xyz/";
      </script>
      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         @include('backend.layouts.header')
         @include('backend.layouts.aside')
         @yield('content')  
         @include('backend.layouts.footer')
         <div class="control-sidebar-bg"></div>
      </div>
      
      <!-- jQuery UI 1.11.4 -->
      <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="{{ asset('assets/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
      <script src="{{ asset('assets/plugins/toastr/toastr.min.js')}}"></script>
      <!-- All Controllers Js files Load Here -->
      <link rel="stylesheet" href="{{ asset('/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
      <script src="{{ asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
      <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
      <script src="{{ asset('assets/plugins/fastclick/lib/fastclick.js')}}"></script>
      <script src="{{ asset('assets/dist/js/adminlte.min.js')}}"></script>
      <script src="{{ asset('assets/custom/js/custom.js')}}"></script>
      <script type="text/javascript">
         $.widget.bridge('uibutton', $.ui.button);
         $('[data-toggle="tooltip"]').tooltip();
         
         
         $( document ).ready(function() {
             if ($.fn.DataTable) {
                 $('#example1').DataTable({
                     'pageLength':15,
                     'ordering': false
                 });
         
                 $('.mainpermission').DataTable({
                     paging: false
                 });
             }
         });
         
      </script>
       {{-- Custom Scripts --}}
      @yield('js')
   </body>
</html>
