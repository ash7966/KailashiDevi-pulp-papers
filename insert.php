<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "testing");

if(isset($_POST['eqname']) && $_POST['eqrate']){
        for($i=0;$i<count($_POST['eqrate']);$i++){
           
           $query3 = "UPDATE ex_quality set eqrate='".$_POST['eqrate'][$i]."' where sn='".$_SESSION['sn']."' AND acname='".$_SESSION['acname']."' AND eqname='".$_POST['eqname'][$i]."'";
            if(mysqli_query($connect, $query3)){
                
            }
 
  
       }
    echo 'Data Inserted';
    
    }

?>