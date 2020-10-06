<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "testing");

if(isset($_POST['name'])){
        
           
           $query3 = "UPDATE quality set rate='".$_POST['rate']."' where sn='".$_SESSION['sn']."' AND acname='".$_SESSION['acname']."' AND name='".$_POST['name']."'";
            if(mysqli_query($connect, $query3))
        {
            echo 'Data Inserted';
                }
            }
    


?>