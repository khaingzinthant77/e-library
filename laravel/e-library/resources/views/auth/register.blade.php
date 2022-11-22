<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>e-Library</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?= url('assets/plugins/bootstrap/dist/css/bootstrap.min.css')?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= url('assets/dist/css/AdminLTE.min.css')?>">
        <link rel="stylesheet" href="<?= url('assets/custom/css/style.css')?>">

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page" style="background: url('<?= url('uploads/default/loginbg.jpg')?>') no-repeat center center fixed;background-size: 100% 100%; ">
        <div class="login-box">
            <div class="login-logo">
                 <a style="color: #fff" href="<?= url('/')?>"><b>e-Library</b></a>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg text-bold">Please provide valid information to successfully active your account.</p>
                <form method="POST" action="{{ route('register_member') }}">
                        @csrf
                        @method('POST')
                    <div class="form-group">
                        <label>Name</label> <span class="text-red">*</span>
                        <input type="text" class="form-control" name="name" value="{{ old('name')}}"/>
                    </div>
                    <div class="form-group ">
                        <label>Phone</label> <span class="text-red">*</span>
                        <input type="text" class="form-control" name="phone" value="<?= old('phone')?>"/>
                    </div>

                    <div class="form-group ">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}"/>
                    </div>
                    
                   
                    <div class="form-group">
                        <label>Password</label> <span class="text-red">*</span>
                        <input type="text" class="form-control" name="password" value="<?= old('password')?>"/>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <a type="submit" href="<?=url('login')?>" class="btn btn-danger btn-block">Back to Login</a>
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- jQuery 3 -->
        <script src="<?=url('assets/plugins/jquery/dist/jquery.min.js')?>"></script>
        <script src="<?=url('assets/plugins/bootstrap/dist/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript">
  
        </script>
        <script src="<?=url('assets/custom/js/fileupload.js')?>"></script>
    </body>
</html>

