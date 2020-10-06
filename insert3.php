<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "testing");
if(isset($_POST['eqname']))
   {
$query = "INSERT INTO quality(sn,acname,name,moisture,rejection,qwt,wt) VALUES('".$_POST['sn']."','".$_POST['acname']."','".$_POST['name']."', '".$_POST['moist']."','".$_POST['reject']."','".$_POST['qwt']."','".$_POST['wt']."')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
}
       for($i=0;$i<count($_POST['eqname']);$i++){
           
           $query2 ="INSERT INTO ex_quality(sn,acname,name,eqname,eqp,eqw) VALUES('".$_POST['sn']."','".$_POST['acname']."','".$_POST['name']."','".$_POST['eqname'][$i]."','".$_POST['eqp'][$i]."','".$_POST['eqwt'][$i]."')";
 $run=mysqli_query($connect, $query2);
 
      $query9="INSERT INTO stock(sn,rd,name,rec) VALUES('".$_POST['sn']."','".$_POST['rd']."','".$_POST['eqname'][$i]."','".$_POST['eqwt'][$i]."')";
        if (!mysqli_query($connect,$query9)) {
  echo("Error description: " . mysqli_error($connect));
    }
       }

 }
 ?>