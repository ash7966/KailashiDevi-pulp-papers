<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}

$connect = mysqli_connect("localhost", "root", "", "testing");
if($_SESSION['from']=='' && $_SESSION['to']==''){
    $query="SELECT Distinct(name),ROUND(Sum(ob),2) as ob FROM account WHERE name='".$_SESSION['acname']."' AND date<='".$_SESSION['pd']."'";
$s=mysqli_query($connect,$query);
$row=mysqli_fetch_row($s);
  
}
else{
    $query="SELECT Distinct(name),ROUND(Sum(ob),2) as ob FROM account WHERE name='".$_SESSION['acname']."' AND date<= '".$_SESSION['from']."'";
$s=mysqli_query($connect,$query);
$row=mysqli_fetch_row($s);
}


if(isset($_POST['submit'])){
    
    unset($_SESSION['acname']);
    $_SESSION['acname']=$_POST['acname'];
    unset($_SESSION['from']);
    unset($_SESSION['to']);
    $_SESSION['from']=$_POST['from'];
    $_SESSION['to']=$_POST['to'];
    header('location:ledger.php');
    
}
if(isset($_POST['save'])){
   
    
    
    $query7="INSERT into info(sn,acname,pd,cr) VALUES('".rand(1000,16453)."','".$_SESSION['acname']."','".$_POST['crdate']."','".$_POST['total-cr']."')";
    if(!mysqli_query($connect,$query7)) {
  echo ("Error description: " . mysqli_error($connect));
 }

}
   
    ?> <html> <head> <title>Ledger</title> <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css"> <link rel="stylesheet" href="css/bootstrap.min.css" /> <link rel="stylesheet" href="css/simple-sidebar.css" /> <link rel="stylesheet" href="css/bootstrap-datepicker.css" /> <script src="js/jquery.min.js"></script> <script src="js/bootstrap.min.js"></script> <script src="js/jquery.dataTables.min.js"></script> <script src="js/dataTables.bootstrap.min.js"></script> <script src="js/bootstrap-datepicker.js"></script> <style>@media print{body *{visibility:hidden}#section-to-print,#section-to-print *{visibility:visible}#section-to-print input,table td{font-weight:700;}#section-to-print{position:absolute;left:0;top:0}.btn,form#search input{display:none}input[type='text']{border:0}div.extra,tr.extra{display:none}#section-to-print,#section-to-print input{font-weight:700;} h1#ledger{visibility: hidden;}}#section-to-print{background-color:#eee}.extra{visibility:visible}body{margin:0;padding:0}.box{width:1270px;padding:20px;background-color:#fff;border:1px solid #ccc;border-radius:5px;margin-top:25px;box-sizing:border-box}.container table td,input[type='text']{font-size:.8rem}</style> </head> <body> <div class="d-flex" id="wrapper"> <?php include('includes/leftbar.php'); ?> <div id="page-content-wrapper"> <?php include('includes/header.php'); ?> <div class="container box" id="section-to-print"> <h1 align="center" id="ledger">LEDGER</h1> <br /> <form class="container" method="post" action="ledger.php"> <div class="row"> <label class="col col-1">From</label> <?php if($_SESSION['from']=='' && $_SESSION['to']=='')
{?> <input class="form-control col col-2" id="mydate1" type="date" name="from"> <label class="col col-1 ml-2">To</label> <input class="form-control col col-2" id="mydate2" type="date" name="to"> <?php }
           
           else{?> <input class="form-control col col-2" id="mydate1" type="date" name="from" value="<?php echo $_SESSION['from']?>" required> <label class="col col-1 ml-2">To</label> <input class="form-control col col-2" id="mydate2" type="date" name="to" value="<?php echo $_SESSION['to']?>" required> <?php }?> </div> <br> <div class="row extra"> <input type="text" name='acname' placeholder="Enter Acc. name" class="form-control col col-3"> <input type="submit" name="submit" value="search" class="btn btn-secondary"> </div> </form> <br> <br /> <br /> <form action="ledger.php" method="post"> <table class="table"> <legend><?php echo $_SESSION['acname'];?></legend> <thead> <tr class="row"> <th scope="col" class="col-sm-2">Date</th> <th scope="col" class="col-sm-3">Particulars</th> <th scope="col" class="col-sm-2">Truck No.</th> <th scope="col" class="col-sm-1">Weight</th> <th scope="col" class="col-sm-1">AMT.(Dr.)</th> <th scope="col" class="col-sm-1">AMT.(Cr.)</th> <th scope="col" class="col-sm-2">Balance</th> </tr> </thead> <tbody> <tr class="row"> <td scope="col" class="col-sm-2"></td> <td scope="col" class="col-sm-4">Opening Balance</td> <td scope="col" class="col-sm-1"></td> <td scope="col" class="col-sm-1"></td> <td scope="col" class="col-sm-1"></td> <td scope="col" class="col-sm-1"></td> <td scope="col" class="col-sm-2"><input type="text" value="<?php echo $row[1]; $bal=$row[1]?>" class="form-control ob" readonly></td> </tr> <?php
      if($_SESSION['from']=='' && $_SESSION['to']==''){
          $query2="SELECT sn,pd,vehicle,mi_wt,payment,cr FROM info where acname='".$_SESSION['acname']."'  ORDER BY pd, sn ASC";
      $query2_run=mysqli_query($connect,$query2);
      }
      else{
          $query2="SELECT sn,pd,vehicle,mi_wt,payment,cr FROM info where acname='".$_SESSION['acname']."' AND pd>= '".$_SESSION['from']."' AND pd <= '".$_SESSION['to']."' ORDER BY pd, sn ASC";
      $query2_run=mysqli_query($connect,$query2);
      }
      
       if($query2_run)
{       //$pay=0;
     foreach($query2_run as $row2){
        
      ?> <tr class="row"> <?php if($row2['cr']>0)
        {?> <td scope="col" class="col-sm-2 ld"><?php echo $row2['pd']; ?></td> <td scope="col" class="col-sm-4 ld">Payment</td> <td scope="col" class="col-sm-1 ld"></td> <td scope="col" class="col-sm-1 ld"></td> <td scope="col" class="col-sm-1 ld"></td> <td scope="col" class="col-sm-1 ld"><?php echo $row2['cr']; ?></td> <td scope="col" class="col-sm-2 ld"><input type="text" class="form-control bal-2" value="<?php echo ($bal-$row2['cr']);
                $bal=$bal+$pay-$row2['cr'];?>" readonly></td> <?php }
                else
                {
                    //$pay=$row2['payment'];
                ?> <td scope="col" class="col-sm-2 ld"><?php echo $row2['pd']; ?></td> <td scope="col" class="col-sm-3"> <?php $query3="SELECT name,wt,rate FROM quality WHERE acname='".$_SESSION['acname']."' AND sn=(SELECT sn FROM info WHERE info.pd='".$row2['pd']."' and info.sn='".$row2['sn']."')";
          $run=mysqli_query($connect,$query3);
          foreach($run as $array){
              if($array['rate']==0){ ?> <p><?php echo ($array['name']." : "); ?> </p> <?php }
              else{ ?> <p><?php echo ($array['name']." : ". $array['wt']." x ".$array['rate']."=".$array['wt']*$array['rate']); ?> </p> <?php  }
         
             $eq="SELECT eqname,eqp,eqw,eqrate from ex_quality WHERE sn='".$row2['sn']."' AND name='".$array['name']."' ";
                    $eq_run=mysqli_query($connect,$eq);
              if($eq_run){
                  foreach($eq_run as $quality)
                  {
                      echo ($quality['eqname']. ": ".$quality['eqp']."% : ".$quality['eqw']." x ".$quality['eqrate']."=".$quality['eqw']*$quality['eqrate']);
                      echo "<br>";
                  }
                  echo '<br>';
              }
          
          ?> <?php }
           $query4="SELECT ROUND(SUM(moisture),2) as moisture,ROUND(SUM(rejection),2) as rejection FROM quality WHERE acname='".$_SESSION['acname']."' AND sn=(SELECT sn FROM info WHERE info.pd='".$row2['pd']."')";
          $run2=mysqli_query($connect,$query4);
          foreach($run2 as $array2){ ?> <p>Moisture: <?php echo $array2['moisture'];?> &nbsp; Rejection: <?php echo $array2['rejection'];?> </p> <?php 
          }
          ?> </td> <td scope="col" class="col-sm-2"><?php echo $row2['vehicle']; ?></td> <td scope="col" class="col-sm-1"><?php echo $row2['mi_wt']; ?></td> <td scope="col" class="col-sm-1"><?php echo $row2['payment']; ?></td> <td scope="col" class="col-sm-1"></td> <td scope="col" class="col-sm-2"><input type="text" class="form-control bal" readonly value="<?php echo $bal+$row2['payment']; $bal +=$row2['payment']; ?>"></td> </tr> <?php 
}
}
       }?> <tr class="row extra"> <td scope="col" class="col-sm-3"><input type="date" class="form-control" name="crdate"></td> <td scope="col" class="col-sm-2">Amount Credit</td> <td scope="col" class="col-sm-2"><input type="text" name="total-cr" value="" class="form-control total-cr"></td> <td scope="col" class="col-sm-1"></td> <td scope="col" class="col-sm-1"></td> <td scope="col" class="col-sm-1"></td> <td scope="col" class="col-sm-2"></td> </tr> </tbody> </table> <input type="submit" value="save" name="save" class="btn btn-secondary"> </form> <button name="print" type="button" class="btn btn-primary m-1" id="btn" onclick="window.print()">Print</button> </div> </div> </div> </body> </html> <script>$("#menu-toggle").click(function(a){a.preventDefault();$("#wrapper").toggleClass("toggled")});</script>