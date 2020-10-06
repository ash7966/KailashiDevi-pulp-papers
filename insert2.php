<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "testing");
$sn = mysqli_real_escape_string($connect, $_POST["sn"]);
    $acname = mysqli_real_escape_string($connect, $_POST["acname"]);
    $name = mysqli_real_escape_string($connect, $_POST["name"]);
$qwt = mysqli_real_escape_string($connect, $_POST["qwt"]);
 $moist = mysqli_real_escape_string($connect, $_POST["moist"]);
    $reject = mysqli_real_escape_string($connect, $_POST["reject"]);
    $wt = mysqli_real_escape_string($connect, $_POST["wt"]);
if(isset($_POST["name"]))
{
    $sn = mysqli_real_escape_string($connect, $_POST["sn"]);
    $acname = mysqli_real_escape_string($connect, $_POST["acname"]);
    $name = mysqli_real_escape_string($connect, $_POST["name"]);
$qwt = mysqli_real_escape_string($connect, $_POST["qwt"]);
 $moist = mysqli_real_escape_string($connect, $_POST["moist"]);
    $reject = mysqli_real_escape_string($connect, $_POST["reject"]);
    $wt = mysqli_real_escape_string($connect, $_POST["wt"]);
 $query = "INSERT INTO quality(sn,acname,name,moisture,rejection,qwt,wt) VALUES('$sn','$acname','$name', '$moist','$reject','$qwt','$wt')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
    $query9="INSERT INTO stock(sn,rd,name,rec) VALUES('".$_POST['sn']."','".$_POST['rd']."','".$_POST['name']."','".$_POST['qwt']."')";
        if (!mysqli_query($connect,$query9)) {
  echo("Error description: " . mysqli_error($connect));
    }
    
}
 
/*
else if(isset($_POST["name"], $_POST["rate"]))
{
 $id = mysqli_real_escape_string($connect, $_POST["id"]);
 $name = mysqli_real_escape_string($connect, $_POST["name"]);
 $rate = mysqli_real_escape_string($connect, $_POST["rate"]);
 $query = "INSERT INTO product_list(id,name,rate) VALUES('$id','$name','$rate')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}*/
?>