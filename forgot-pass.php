<?php
session_start();
include('includes/config.php');
if(isset($_POST['forgot-password']))
{
$email=$_POST['username'];
$s="select password from users where name='$email'";
	
	$q=mysqli_query($cn,$s);
	$r=mysqli_num_rows($q);
	$data=mysqli_fetch_array($q);
	mysqli_close($cn);
	if($r>0)
	{
		echo "<script>alert('Your password is ".$data[0]."');</script>";
	}
	else
	{
	echo "<script>alert('No user of this Username');</script>";
	}
}

?> <!doctype html> <html lang=en class=no-js> <head> <meta charset=UTF-8> <meta http-equiv=X-UA-Compatible content="IE=edge"> <meta name=viewport content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"> <meta name=description content> <meta name=author content> <link rel=stylesheet href=css/font-awesome.min.css> <link rel=stylesheet href=css/bootstrap.min.css> <link rel=stylesheet href=css/style.css> <link rel=stylesheet href=css/simple-sidebar.css> <script src=js/jquery.min.js></script> <script src=js/bootstrap.min.js></script> </head> <body> <div class=container-fluid> <div class="row no-gutter"> <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div> <div class="col-md-8 col-lg-6"> <div class="login d-flex align-items-center py-3"> <div class=container> <h2 class="text text-uppercase">Kailashidevi pulps &amp; paper products</h2> <br> <form method=post action=forgot-pass.php> <h1>Forgot Password?</h1> <div class=form-group> <label for=username>Username</label> <input type=text name=username class="form-control col-5"> </div> <div class=form-group> <input type=submit name=forgot-password value=Submit class="form-submit-button btn btn-primary"> </div> <div class=form-group> <input type=button value=login class="form-submit-button btn btn-primary" onclick="window.open('index.php','_self')"> </div> </form> </div> </div> </div> </div> </div> </body>