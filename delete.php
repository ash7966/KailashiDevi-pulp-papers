<?php
$connect = mysqli_connect("localhost", "root", "", "testing");
if(isset($_POST["delete"]))
{
    $check="SELECT sn from info where sn='".$_POST['sndelete']."'";
    $check_run=mysqli_query($connect,$check);
    $row=mysqli_num_rows($check_run);
    
    if($row>0){
        
        $query = "DELETE FROM info WHERE sn = '".$_POST["sndelete"]."'";
 if (!mysqli_query($connect,$query)) {
  echo("Error description: " . mysqli_error($connect));
}
    

$query2 = "DELETE FROM account WHERE sn = '".$_POST["sndelete"]."'";
 if (!mysqli_query($connect,$query2)) {
  echo("Error description: " . mysqli_error($connect));
}
    $query3 = "DELETE FROM quality WHERE sn = '".$_POST["sndelete"]."'";
 if (!mysqli_query($connect,$query3)) {
  echo("Error description: " . mysqli_error($connect));
}
    $query4 = "DELETE FROM ex_quality WHERE sn = '".$_POST["sndelete"]."'";
 if (!mysqli_query($connect,$query4)) {
  echo("Error description: " . mysqli_error($connect));
}
    $query5 = "DELETE FROM stock WHERE sn = '".$_POST["sndelete"]."'";
 if (!mysqli_query($connect,$query5)) {
  echo("Error description: " . mysqli_error($connect));
}
        echo "<script>alert('Data deleted');
        window.location.replace('quality-report.php');</script>";
    }
    
    else{
        echo "<script>alert('Data not found');
        window.location.replace('quality-report.php'); </script>";
    }
    
    
 
    

}
?>