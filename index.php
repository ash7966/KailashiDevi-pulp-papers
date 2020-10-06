<?php session_start();include('includes/config.php');if(isset($_POST['login'])){$status='1';$email=$_POST['username'];$password=$_POST['password'];$s="select * from users where name='$email' and Password='$password'";$q=mysqli_query($cn,$s);$r=mysqli_num_rows($q);$data=mysqli_fetch_array($q);mysqli_close($cn);if($r>0){$_SESSION["username"]=$_POST["username"];$_SESSION['alogin']="1";header('location:quality-report.php');}else{echo "<script>alert('Invalid User Name or Password');</script>";}}?>
<!doctype html>
<html lang=en class=no-js>
<head>
<meta charset=UTF-8>
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=viewport content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name=description content>
<meta name=author content>
<link rel=stylesheet href=css/font-awesome.min.css>
<link rel=stylesheet href=css/bootstrap.min.css>
<link rel=stylesheet href=css/style.css>
<link rel=stylesheet href=css/simple-sidebar.css>
<script src=js/jquery.min.js></script>
<script src=js/bootstrap.min.js></script>
</head>
<body>
<div class=container-fluid>
<div class="row no-gutter">
<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
<div class="col-md-8 col-lg-6">
<div class="login d-flex align-items-center py-3">
<div class=container>
<h2 class="text text-uppercase">Kailashidevi pulps &amp; paper products</h2>
<br>
<div class=row>
<div class="col-md-9 col-lg-8 mx-auto">
<h3 class="login-heading mb-4">Welcome back!</h3>
<form method=post action=index.php>
<div class=form-label-group>
<input type=text name=username id=inputEmail class=form-control placeholder=username autofocus>
<label for=inputEmail>Username</label>
</div>
<div class=form-label-group>
<input type=password name=password id=inputPassword class=form-control placeholder=Password required>
<label for=inputPassword>Password</label>
</div>
<input class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" name=login value=login type=submit>
<br>
<a href=forgot-pass.php>Forgot password?</a>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</body>