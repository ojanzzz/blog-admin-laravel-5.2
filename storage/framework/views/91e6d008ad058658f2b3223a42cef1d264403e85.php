<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Panel Administrator</title>

<link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('assets/css/datepicker3.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('assets/css/styles.css')); ?>" rel="stylesheet">
<meta name="robots" content="noindex,nofollow">
<!--Icons-->
<script src="<?php echo e(asset('assets/js/lumino.glyphs.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery-1.11.1.min.js')); ?>"></script>
<script type="text/javascript">
   $(document).ready(function(){
    $(".close-and-remove").fadeIn("slow");
  });
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>
<body>

<div class="clearfix"></div>
<div class="form-lg-sg-container">

<?php if(count($errors) > 0): ?>
<div class="notif">
<?php foreach($errors->all() as $error): ?>
<div class="notification">
<div class="close-and-remove alert bg-danger" role="alert">
<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> 
<?php echo e($error); ?> 
<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>
</div>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>

<?php if(Session::has('login_message')): ?>
<div class="notif">
<div class="notification">
<div class="close-and-remove alert bg-danger" role="alert">
<svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg> 
<?php echo e(Session::get('login_message')); ?>

<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>
</div>
</div>
</div>
<?php endif; ?>

<?php if(Session::has('logout_message')): ?>
<div class="notif">
<div class="notification">
<div class="close-and-remove alert bg-success" role="alert">
<svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg>
<?php echo e(Session::get('logout_message')); ?>

<a href="#" class="pull-right"><span class="click-and-remove glyphicon glyphicon-remove"></span></a>
</div>
</div>
</div>
<?php endif; ?>

<h1>Admin Login</h1><br>
<form method="post" action="/admin/login">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
<input type="email" name="email" value="" placeholder="Email" required="required">
<input type="password" name="password" value="" placeholder="Password">
<?php /* <div class="g-recaptcha" style="margin-bottom:10px;" data-sitekey="<?php echo e(env('RECAPTCHA_KEY')); ?>"></div> */ ?>
<input type="submit" name="login" class="login form-lg-sg-submit" value="Login">
</form>

<?php /* <div class="login-help">
<a href="<?php echo e(url('/admin/register')); ?>">Register</a> - <a href="#">Forgot Password</a>
</div> */ ?>

</div>

<?php echo $__env->make('admin.admin-js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>