<?php session_start();error_reporting(0);include('includes/config.php');if(strlen($_SESSION['alogin'])==0){header('location:index.php');}else?>
<html>
<head>
<title>Stock-summary</title>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/simple-sidebar.css" />
<link rel="stylesheet" href="css/bootstrap-datepicker.css" />
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<style>@media print{body *{visibility:hidden}#section-to-print,#section-to-print *{visibility:visible}#section-to-print{position:absolute;left:0;top:0}.btn{display:none}#heading{visibility:visible}#section-to-print input{font-weight:700;}}#section-to-print{background-color:#eee}#heading{visibility:hidden}body{margin:0;padding:0}form#form{overflow:hidden}.box{width:1270px;padding:20px;background-color:#fff;border:1px solid #ccc;border-radius:5px;margin-top:25px;box-sizing:border-box}</style>
</head>
<body>
<div class="d-flex" id="wrapper">
<?php include('includes/leftbar.php');?>
<div id="page-content-wrapper">
<?php include('includes/header.php');?>
<div class="container box" id="section-to-print">
<div class="p-3" id="heading">
<h2 align="center">KAILASHIDEVI PULPS AND PAPER PRODUCTS</h2>
<h6 align="center">VILL:- LALPUR,KUNDA,JASPUR ROAD KASHIPUR,UDHAM SINGH NAGAR,UTTARAKHAND-244713</h6>
</div>
<h1 align="center">Stock Summary</h1>
<br />
<form class="row input-group" method="post" action="stock-summary.php">
<input class="form-control col col-3" id="mydate" type="date" name="date" value="">
<input type="submit" class="col col-2 btn btn-secondary ml-2" value="check" name="check">
</form>
<div class="table-responsive">
<br />
<?php $connection=mysqli_connect("localhost","root","","testing");if(isset($_POST["save"])){for($i=0;$i<count($_POST['name']);$i++){if($_POST['bal'][$i]==0){continue;}$a="UPDATE stock SET ob ='".$_POST['ob'][$i]."',total='".$_POST['total'][$i]."',con='".$_POST['con'][$i]."',bal='".$_POST['bal'][$i]."' WHERE rd='".$_SESSION['pd']."' AND name='".$_POST['name'][$i]."'";if(!mysqli_query($connection,$a)){echo("Error description: ".mysqli_error($connection));}}}if(isset($_POST['check'])){$query5="SELECT name,ROUND(SUM(ob),2) AS ob,ROUND(SUM(rec),2) AS rec,ROUND(SUM(total),2) AS total,ROUND(SUM(con),2) AS con,ROUND(SUM(bal),2) AS bal FROM stock WHERE rd <='".$_POST['date']."' GROUP BY name ";unset($_SESSION['pd']);echo "<script>document.getElementById('mydate').value='".$_POST['date']."'</script>";$query_run=mysqli_query($connection,$query5);}else{$query="SELECT name,ROUND(SUM(ob),2) AS ob,ROUND(SUM(rec),2) AS rec,ROUND(SUM(total),2) AS total,ROUND(SUM(con),2) AS con,ROUND(SUM(bal),2) AS bal FROM stock WHERE rd='".$_SESSION['pd']."' GROUP BY name ";$query_run=mysqli_query($connection,$query);}?>
<form action="stock-summary.php" method="post" id="form">
<table id="datatableid" class="table table-bordered table-striped">
<thead>
<tr>
<th scope="col"> Quality</th>
<th scope="col">Open Balance</th>
<th scope="col">Received</th>
<th scope="col"> Total </th>
<th scope="col"> Consumption </th>
<th scope="col"> Balance </th>
</tr>
</thead>
<?php if($query_run){foreach($query_run as $row){?>
<tbody>
<tr>
<td> <input type="text" name="name[]" class="form-control" value="<?php echo $row['name'];?>"> </td>
<td><input type="text" class="form-control ob" value="<?php echo $row['ob'];?>" name="ob[]"></td>
<td> <input type="text" value="<?php echo $row['rec'];?>" class="form-control ob" name=""> </td>
<td><input type="text" class="form-control total" value="<?php echo $row['total'];?>" name="total[]"></td>
<td><input type="text" class="form-control total" value="<?php echo $row['con'];?>" name="con[]"></td>
<td><input type="text" name="bal[]" class="form-control balance" value="<?php echo $row['bal'];?>" name="bal[]"></td>
</tr>
</tbody>
<?php }}else{echo "No Record Found";}?>
</table>
<div class="row form-group justify-content-center">
<input type="submit" name="save" value="Save" class="btn btn-secondary form-control col-2 m-1">
<input type="button" name="print" value="Print" class="btn btn-secondary form-control col-2 m-1" onclick="window.print()">
</div>
</form>
</div>
</div>
</div>
</div>
</body>
</html>
<script>$("#menu-toggle").click(function(e){e.preventDefault();$("#wrapper").toggleClass("toggled");});</script>
<script type="text/javascript" language="javascript">$(document).ready(function(){for(const iterator of document.querySelectorAll('input'))
{if(iterator.className=="form-control ob"){iterator.addEventListener('blur',(e)=>{var a=0;for(const iterator of e.target.parentElement.parentElement.querySelectorAll('input.ob','input.form-control'))
{a+=parseFloat(iterator.value);}
e.target.parentElement.parentElement.querySelector(".total",".form-control").value=a.toFixed(2);})}
if(iterator.className=="form-control total"){iterator.addEventListener('blur',(e)=>{var b=0;for(const iterator of e.target.parentElement.parentElement.querySelectorAll('input.total','input.form-control'))
{a=parseFloat(iterator.value);b+=a;}
e.target.parentElement.parentElement.querySelector(".balance",".form-control").value=(b-2*a).toFixed(2);})}}});</script>