<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css')}}">

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page" style="background: url('{{ asset('uploads/default/loginbg.jpg')}}') no-repeat center center fixed;background-size: 100% 100%; ">
        <div class="login-box">
            <div class="login-logo">
                <a style="color: #fff" href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg text-bold">Sign in to start you session</p>

                <form action="{{ url('login_submit') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group has-feedback">
                        <label>Username or Email</label> <span class="text-red">*</span>
                        <input type="text" id="membername" class="form-control" name="email" value="{{ old('email') }}"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Password</label> <span class="text-red">*</span>
                        <input type="password" id="password" class="form-control" name="password" value="{{ old('password') }}">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label><input type="checkbox">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <p class="text-center">-- OR --</p>
                    <div class="col-xs-6 col-xs-12 text-center">
                        <a class="btn btn-danger btn-sm pull-left" href="{{ url('/resetpassword')}}">Reset Password</a><br>
                    </div>
                    {{-- <?php if($generalsetting->registration) { ?> --}}
                        <div class="col-xs-6">
                            <a class="btn btn-success btn-sm pull-right" href="{{ url('/register')}}" class="text-center">Register new Member</a>
                        </div>
                    {{-- <?php } ?> --}}
                </div>
            </div>
        </div>

       {{--  <?php if(config_item('demo')) { ?> --}}
        <div class="row">
            <div class="col-sm-4 col-md-offset-4">
                <div class="well text-center">
                    <strong>Login Panel</strong><br/>
                    <button class="btn btn-primary" id="admin">Admin</button>
                    <button class="btn btn-danger" id="librarian">Librarian</button>
                    <button class="btn btn-warning" id="member">Member</button>
                    <button class="btn btn-success" id="guest">Guest</button>
                </div>
            </div>
        </div>
        {{-- <?php } ?> --}}
        <!-- jQuery 3 -->
        <script src="<?= url('assets/plugins/jquery/dist/jquery.min.js')?>"></script>
        <!-- iCheck -->
        <script src="<?= url('assets/plugins/iCheck/icheck.min.js')?>"></script>
        <script src="<?= url('assets/plugins/toastr/toastr.min.js')?>"></script>

        <script type="text/javascript">
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
            });

            $('#admin').click(function() {
                $('#membername').val('admin');
                $('#password').val('123456');
                $('#password').attr('type','text');
            });

            $('#librarian').click(function() {
                $('#membername').val('librarian');
                $('#password').val('123456');
                $('#password').attr('type','text');
            });

            $('#member').click(function() {
                $('#membername').val('member');
                $('#password').val('123456');
                $('#password').attr('type','text');
            });

            $('#guest').click(function() {
                $('#membername').val('guest');
                $('#password').val('123456');
                $('#password').attr('type','text');
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
    </body>
</html>
