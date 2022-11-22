<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, member-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?=url('assets/plugins/bootstrap/dist/css/bootstrap.min.css')?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?=url('assets/dist/css/AdminLTE.min.css')?>">

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page" style="background: url('<?= url('uploads/default/loginbg.jpg')?>') no-repeat center center fixed;background-size: 100% 100%; ">
        <div class="login-box">
            <div class="login-logo">
                 <a style="color: #fff" href="<?=url('/')?>"><b>{{ config('app.name', 'Laravel') }}</b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg text-bold">Please provide your registered valid username or email to get reset password.</p>

                <form action="<?= url('/resetpassword')?>" method="post">
                    <div class="form-group has-feedback">
                        <label>Username or Email</label> <span class="text-red">*</span>
                        <input type="text" class="form-control" name="username_or_email" value="<?= old('username_or_email')?>"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <a type="submit" href="<?= url('login')?>" class="btn btn-danger btn-block">Back to Login</a>
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block">Send Email</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- jQuery 3 -->
        <script src="<?= url('assets/plugins/jquery/dist/jquery.min.js')?>"></script>
    </body>
</html>
