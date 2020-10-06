<?php
session_start();
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
$connect = mysqli_connect("localhost", "root", "", "testing");	
$test="SELECT * FROM info WHERE sn ='".$_SESSION['sn']."'";
$test2=mysqli_query($connect,$test);
if(isset($_POST["submit"]))
{
  $_SESSION['sn'] = mysqli_real_escape_string($connect,$_POST["sn"]);
 $_SESSION['pd']=$_POST["pd"];
 $_SESSION['acname'] =mysqli_real_escape_string($connect,$_POST["acname"]);
$_SESSION['supplier'] =mysqli_real_escape_string($connect,$_POST["supplier"]);
 $_SESSION['party'] = mysqli_real_escape_string($connect,$_POST["party"]);
 $_SESSION['place'] = mysqli_real_escape_string($connect,$_POST["place"]);
 $_SESSION['ld'] = mysqli_real_escape_string($connect,$_POST["ld"]);
$_SESSION['invoice'] =mysqli_real_escape_string($connect,$_POST["invoice"]);
$_SESSION['vehicle'] = mysqli_real_escape_string($connect,$_POST["vehicle"]);
$_SESSION['ch_wt'] = mysqli_real_escape_string($connect,$_POST["ch_wt"]);
 $_SESSION['mi_wt'] = mysqli_real_escape_string($connect,$_POST["mi_wt"]);
$_SESSION['shortage'] = mysqli_real_escape_string($connect,$_POST["shortage"]);
$_SESSION['data1'] =$_POST["data1"];
 $_SESSION['wt'] = $_POST["wt"];   
$_SESSION['qwt'] = $_POST["qwt"];
    $_SESSION['eqname']=$_POST['eqname'];
    

    $query = "INSERT INTO info(sn,pd,acname,supplier,party,place,ld,invoice,vehicle,ch_wt,mi_wt,shortage) VALUES('".$_SESSION["sn"]."','".$_SESSION["pd"]."','".$_SESSION["acname"]."','".$_SESSION["supplier"]."','".$_SESSION["party"]."','".$_SESSION["place"]."','".$_SESSION["ld"]."','".$_SESSION["invoice"]."','".$_SESSION["vehicle"]."','".$_SESSION["ch_wt"]."','".$_SESSION["mi_wt"]."','".$_SESSION["shortage"]."')";
    
if (!mysqli_query($connect,$query)) {
  echo("Error description: " . mysqli_error($connect));
}
 $query2 ="INSERT INTO report(sn,Q0) VALUES('".$_SESSION["sn"]."','".$_SESSION["data1"][0]."')";
       
     if (!mysqli_query($connect,$query2)) {
  echo("Error description: " . mysqli_error($connect));
     }
    
    for($i=0; $i<count($_POST["data1"]); $i++)
 {
         $j=$i+1;
        $query3 ="UPDATE report SET Q".$j."='".$_POST['data1'][$j]."' WHERE sn='".$_SESSION["sn"]."'";
        if (!mysqli_query($connect,$query3)) {
  echo("Error description: " . mysqli_error($connect));
     
 }
    
 
 }
    
    header('location:gnr.php');
}

if(isset($_POST['quality'])){
    unset($_SESSION['sn']);
    $_SESSION['sn']=$_POST['search'];
    header('location:quality-report.php');
}
 
    
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Quality-report</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/simple-sidebar.css">
    

	<style>
         @media print {
  body * {
    visibility: hidden;
font-weight:20px;
  }
  #printable, #printable * {
    visibility: visible;
    
  }
  #printable {
    position: absolute;
    left: 0;
    top: 0;
  }
             #heading{
                 visibility: visible;
             } 
             #add.btn,#btn,form#search input,form#delete input,button.btn-danger,button#insert{
            visibility: hidden;
             }
             #printable, #printable input,div.input-group-text{
                 font-weight: 700;
             }
             label.col-form-label{
                 font-weight: 800;
             }

        }
        body *{
            background-color: #eee;
        }

        #heading{
            visibility: hidden;
        }
        
        
	.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
	background: #dd3d36;    `  `   `   `   `   `   `   `   `   `   `
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>


</head>

<body>
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
   <?php include('includes/leftbar.php'); ?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <?php include('includes/header.php'); ?>

      <div class="container" id="printable">
          <div class=" p-3" id="heading">
        <h2 align="center">KAILASHIDEVI PULPS AND PAPER PRODUCTS</h2>
   <h6 align="center">VILL:- LALPUR,KUNDA,JASPUR ROAD KASHIPUR,UDHAM SINGH NAGAR,UTTARAKHAND-244713</h6>
           
       </div>
        <h3 class="m-4 row justify-content-center">Quality Report</h3>
        <div class="row">
            <form class="col input-group" id="search" method='post' action="quality-report.php">
       <input type="text" name='search' placeholder="Enter Serial No." class="form-control col col-3">
       <input type="submit" name="quality" value="search/clear" class="btn btn-secondary">
   </form>
        <form class="col input-group" id="delete" method='post' action="delete.php">
       <input type="text" name='sndelete' placeholder="Enter Serial No." class="form-control col col-3">
       <input type="submit" name="delete" value="Delete" class="btn btn-danger">
   </form>
        </div>
         
         <br>
          
          <form method="post" action="quality-report.php">
  <?php 
      if($_SESSION['sn']){
          foreach($test2 as $row)
          {  ?>
  <div class="form-group row border pt-2 pb-2">
     <label for="text" class="col-1 col-form-label">SR no.</label>
    <div class="col-4">
     
      <input id="text" name="sn" value="<?php echo $row['sn']; ?>" type="text" class="form-control" required="required">
    </div>
     <label for="text1" class="col-2 col-form-label">Report date</label>
    <div class="col-4">
      <input id="text1" name="pd" type="date" class="form-control" value="<?php echo $row['pd']; ?>" required="required">
    </div>
  </div>
  <div class="border p-3">
  <div class="form-group row">
    <label for="text2" class="col-3 col-form-label">Account Name</label> 
    <div class="col-8">
      <input id="text2" name="acname" value="<?php echo $row['acname']; ?>" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="text3" class="col-3 col-form-label">Supplier Name</label> 
    <div class="col-8">
      <input id="text3" name="supplier" value="<?php echo $row['supplier']; ?>" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="text4" class="col-3 col-form-label">Party Name</label> 
    <div class="col-8">
      <input id="text4" name="party" value="<?php echo $row['party']; ?>" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="text5" class="col-3 col-form-label">Place of loading</label> 
    <div class="col-8">
      <input id="text5" name="place" value="<?php echo $row['place']; ?>" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="text6" class="col-3 col-form-label">Date of loading</label> 
    <div class="col-8">
      <input id="text6" name="ld" type="date" value="<?php echo $row['ld']; ?>" class="form-control" required="required">
    </div>
  </div>
</div>
 <div class="border p-3">
  <div class="form-group row">
    <label for="text7" class="col-3 col-form-label">Invoice No.</label> 
    <div class="col-8">
      <input id="text7" name="invoice" value="<?php echo $row['invoice']; ?>" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="text8" class="col-3 col-form-label">Vehicle No.</label> 
    <div class="col-8">
      <input id="text8" name="vehicle" type="text" value="<?php echo $row['vehicle']; ?>" class="form-control" required="required">
    </div>
  </div>
</div>
 <div class="border p-3">
  <div class="form-group row">
    <label for="text9" class="col-3 col-form-label">Challan Wt.</label> 
    <div class="col-6">
      <div class="input-group">
        <input id="text9"  name="ch_wt" type="text" value="<?php echo $row['ch_wt']; ?>" class="form-control" required="required"> 
        <div class="input-group-append">
          <div class="input-group-text">Kg</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="text10" class="col-3 col-form-label">Mill Wt.</label> 
    <div class="col-6">
      <div class="input-group">
        <input id="text10" onblur="func1()" value="<?php echo $row['mi_wt']; ?>" name="mi_wt" type="text" class="form-control" required="required"> 
        <div class="input-group-append">
          <div class="input-group-text">Kg</div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="text11" class="col-3 col-form-label">Shortage</label> 
    <div class="col-6">
     <div class="input-group">
      <input id="text11" name="shortage" value="<?php echo $row['shortage']; ?>" type="text" class="form-control" required="required">
      <div class="input-group-append">
          <div class="input-group-text">Kg</div>
        </div>
        </div>
    </div>
  </div>  
  </div>
  <?php } }
              else
              {?>
                 <div class="form-group row border pt-2 pb-2">
     <label for="text" class="col-1 col-form-label">SR no.</label>
    <div class="col-4">
     
      <input id="text" name="sn" value="" type="text" class="form-control" required="required">
    </div>
     <label for="text1" class="col-2 col-form-label">Report date</label>
    <div class="col-4">
      <input id="text1" name="pd" type="date" class="form-control" value="" required="required">
    </div>
  </div>
  <div class="border p-3">
  <div class="form-group row">
    <label for="text2" class="col-3 col-form-label">Account Name</label> 
    <div class="col-8">
      <input id="text2" name="acname" value="" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="text3" class="col-3 col-form-label">Supplier Name</label> 
    <div class="col-8">
      <input id="text3" name="supplier" value="" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="text4" class="col-3 col-form-label">Party Name</label> 
    <div class="col-8">
      <input id="text4" name="party" value="" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="text5" class="col-3 col-form-label">Place of loading</label> 
    <div class="col-8">
      <input id="text5" name="place" value="" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="text6" class="col-3 col-form-label">Date of loading</label> 
    <div class="col-8">
      <input id="text6" name="ld" type="date" value="" class="form-control" required="required">
    </div>
  </div>
</div>
 <div class="border p-3">
  <div class="form-group row">
    <label for="text7" class="col-3 col-form-label">Invoice No.</label> 
    <div class="col-8">
      <input id="text7" name="invoice" value="" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="text8" class="col-3 col-form-label">Vehicle No.</label> 
    <div class="col-8">
      <input id="text8" name="vehicle" type="text" value="" class="form-control" required="required">
    </div>
  </div>
</div>
 <div class="border p-3">
  <div class="form-group row">
    <label for="text9" class="col-3 col-form-label">Challan Wt.</label> 
    <div class="col-6">
      <div class="input-group">
        <input id="text9"  name="ch_wt" type="text" value="" class="form-control" required="required"> 
        <div class="input-group-append">
          <div class="input-group-text">Kg</div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="form-group row">
    <label for="text10" class="col-3 col-form-label">Mill Wt.</label> 
    <div class="col-6">
      <div class="input-group">
        <input id="text10" onblur="func1()" value="" name="mi_wt" type="text" class="form-control" required="required"> 
        <div class="input-group-append">
          <div class="input-group-text">Kg</div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label for="text11" class="col-3 col-form-label">Shortage</label> 
    <div class="col-6">
     <div class="input-group">
      <input id="text11" name="shortage" value="" type="text" class="form-control" required="required">
      <div class="input-group-append">
          <div class="input-group-text">Kg</div>
        </div>
        </div>
    </div>
  </div>  
  </div>
                  
              <?php } ?>
  
  <div class="border p-3">
  <h4>Report</h4>
  <button type="button" name="add" id="add" class="btn btn-info mb-2">Add</button>
  <?php
      $as="SELECT name,qwt,wt,moisture,rejection FROM quality WHERE sn='".$_SESSION['sn']."'";
      $report=mysqli_query($connect,$as);
      if($_SESSION['sn'])
      {
      foreach($report as $row2){
    
?>
  <div class="container">
  <div class="report border p-3">
  <div class="row">
   <div class="form-group col-4">
       <input id="text12" name="data1[]" type="text" class="form-control" required="required" placeholder="Enter Quality" value="<?php echo $row2['name'];?>">
   </div>
      <div class="form-group col-4">
       <input id="wt" name="qwt[]" value="<?php echo $row2['qwt'];?>" type="text" class="form-control" required="required" placeholder="Weight">
   </div>
      
  </div>
  <div class="row">
  <div class="form-group col">
      <input id="text13" name="" type="text" class="form-control" required="required" value="Moisture">
  </div>
  <div class="form-group col"> 
      <div class="input-group">
        <input id="text14" onblur="func2()" name="" type="text" class="form-control"> 
        <div class="input-group-append">
          <div class="input-group-text">%</div>
      </div>
    </div>
  </div>
  <div class="form-group col">
      <div class="input-group">
        <input id="text15" name="data2[]" value="<?php echo $row2['moisture'];?>" type="text" class="form-control" required="required"> 
        <div class="input-group-append">
          <div class="input-group-text">Kg</div>
      </div>
    </div>
  </div> 
  </div>
  <div class="row">
  <div class="form-group col">
      <input id="text16" name="" type="text" class="form-control" required="required" value="Rejection">
  </div>
  <div class="form-group col"> 
      <div class="input-group">
        <input id="text17" onblur="func3()" name="" type="text" class="form-control"> 
        <div class="input-group-append">
          <div class="input-group-text">%</div>
      </div>
    </div>
  </div>
  <div class="form-group col">
      <div class="input-group">
        <input id="text18" name="data3[]" value="<?php echo $row2['rejection'];?>" onblur="func4()" type="text" class="form-control" required="required"> 
        <div class="input-group-append">
          <div class="input-group-text">Kg</div>
      </div>
    </div>
  </div> 
  </div> 
  
  <div class="row justify-content-end">
     <label for="textx" class="col-2">Net WT.</label>
      <div class="form-group col-4">
         <div class="input-group">
             <input name="wt[]" type="text" value="<?php echo $row2['wt'];?>" class="form-control total" id="textx">
           <div class="input-group-append">
          <div class="input-group-text">Kg</div>
      </div>
         </div>
          
      </div>
  </div>
  <div class="row">
    
  <div class="extra p-3">
    
     <?php $eq="SELECT eqname,eqp,eqw from ex_quality WHERE sn='".$_SESSION['sn']."' AND name='".$row2['name']."'"; 
            $eq_run=mysqli_query($connect,$eq);
          if($eq_run){
              foreach($eq_run as $row4){
                        
      ?>
      <div class="row">
          <div class="form-group col"><input id=""  type="text" class="form-control" required="required" value="<?php echo $row4['eqname']?>"></div>
         <div class="form-group col">
             <div class="input-group">
                 <input  onblur="func5()" name="eqp[]" type="text" class="form-control" value="<?php echo $row4['eqp']?>">
                     <div class="input-group-append"><div class="input-group-text">%</div>
                     </div>
                     </div>
                     </div>
        <div class="form-group col"><div class="input-group"><input id="eqw" type="text" class="form-control" value="<?php echo $row4['eqw']?>">
        <div class="input-group-append">
        <div class="input-group-text">Kg</div>
        </div>
        </div>
        </div>
  </div>
  <?php }
          } ?>

</div>
</div>
<?php } 
      } 
      else {
      ?>
      <div class="container"><div id="alert_message"></div>
      <div class="report border p-3">
          <button type="button" name="remove" id="btn" class="btn btn-danger mb-2">Remove</button>
          
  <div class="row">
   <div class="form-group col-4">
       <input id="text12" name="data1[]" type="text" class="form-control" required="required" placeholder="Enter Quality">
   </div>
      <div class="form-group col-4">
       <input id="wt" name="qwt[]" type="text" class="form-control" required="required" placeholder="Weight">
   </div>
      
  </div>
  <div class="row">
  <div class="form-group col">
      <input id="text13" name="" type="text" class="form-control" required="required" value="Moisture">
  </div>
  <div class="form-group col"> 
      <div class="input-group">
        <input id="text14" onblur="func2()" name="" type="text" class="form-control"> 
        <div class="input-group-append">
          <div class="input-group-text">%</div>
      </div>
    </div>
  </div>
  <div class="form-group col">
      <div class="input-group">
        <input id="text15" name="data2[]"  type="text" class="form-control" required="required"> 
        <div class="input-group-append">
          <div class="input-group-text">Kg</div>
      </div>
    </div>
  </div> 
  </div>
  <div class="row">
  <div class="form-group col">
      <input id="text16" name="" type="text" class="form-control" required="required" value="Rejection">
  </div>
  <div class="form-group col"> 
      <div class="input-group">
        <input id="text17" onblur="func3()" name="" type="text" class="form-control"> 
        <div class="input-group-append">
          <div class="input-group-text">%</div>
      </div>
    </div>
  </div>
  <div class="form-group col">
      <div class="input-group">
        <input id="text18" name="data3[]"  onblur="func4()" type="text" class="form-control" required="required"> 
        <div class="input-group-append">
          <div class="input-group-text">Kg</div>
      </div>
    </div>
  </div> 
  </div> 
  
  <div class="row justify-content-end">
     <label for="textx" class="col-2">Net WT.</label>
      <div class="form-group col-4">
         <div class="input-group">
             <input name="wt[]" type="text" class="form-control total" id="textx">
           <div class="input-group-append">
          <div class="input-group-text">Kg</div>
      </div>
         </div>
          
      </div>
  </div>
    <div class="row">
     <div class="input-group col col-3 justify-content-start p-3">
         <button type="button" class="add2 btn btn-secondary" id="btn">Add quality</button>
      </div>
  <div class="extra p-3">
      
  </div>
  

</div>
     <button type="button" name="insert" id="insert" class="btn btn-success mb-2">Insert</button>
      </div>
      
</div>
        <?php }?>
<div class="form-group row mt-3">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary" id="btn">Submit</button>
    </div>
  </div>
  <div class="form-group row mt-3">
    <div class="offset-4 col-8">
      <button name="print" type="" class="btn btn-primary" onclick="window.print()" id="btn">Print</button>
    </div>

</div>
              </div>
</form>
       
  </div>
                
        
    
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
    </div>
  <!-- Bootstrap core JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
      $(document).ready(function(){
      
      $(document).on('click','#insert',function(e){
          console.log(20);
          var sn=$('#text').val();
          var rd=$('#text1').val();
          var acname=$('#text2').val();
          var name=$('#text12').val();
          var qwt=$('#wt').val();
          var moist=$('#text15').val();
          var reject=$('#text18').val();
          var wt=$('#textx').val();
          var eqname=new Array();
          var eqp=new Array();
          var eqwt=new Array();
            var i=0,j=0,k=0; 
          
             
              
          
         /* $('input[name^="eqname"]').each(function() {
            eqname[i]=$(this).val();
              i++;
});    
          eqname.forEach(function(a){ console.log(a);});*/
          
          
                      
                      for(const a of e.target.parentElement.querySelectorAll('input.eqname')){
                          eqname[i]=a.value;
                          i++;
                          }
          for(const a of e.target.parentElement.querySelectorAll('input.eqp')){
                          eqp[j]=a.value;
                          j++;
                          }
          for(const a of e.target.parentElement.querySelectorAll('input.eqwt')){
                          eqwt[k]=a.value;
                          k++;
                          }
          eqp.forEach(function(a){ console.log(a);});
                          
if(eqname != '' && eqwt != '')
   {
    $.ajax({
     url:"insert3.php",
     method:"POST",
     data:{sn:sn,acname:acname,name:name,qwt:qwt,moist:moist,reject:reject,wt:wt,eqname:eqname,eqp:eqp,eqwt:eqwt,rd:rd},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 3000);
   }
   else if(name != '' && qwt != '')
   {
    $.ajax({
     url:"insert2.php",
     method:"POST",
     data:{sn:sn,acname:acname,name:name,qwt:qwt,moist:moist,reject:reject,wt:wt,eqname:eqname,eqp:eqp,eqwt:eqwt,rd:rd},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 3000);
   }
    else
   {
    alert("Both Fields is required");
   }
          });
          
                
      });
                    

   /*var name = $('#data2').text();
   var address = $('#data3').text();
   var contact = $('#data4').text();*/
   
      
         
      document.querySelector('button#add').addEventListener('click',(e)=>{
          var html = '<div class="report border p-3"><button type="button" name="remove" id="btn" class="btn btn-danger mb-2">Remove</button><div class="row"><div class="form-group col-4"><input id="text12" name="data1[]" type="text" class="form-control" required="required" placeholder="Enter Quality"> </div><div class="form-group col-4">    <input id="wt" name="qwt[]" type="text" class="form-control" required="required" placeholder="Weight"></div></div>  <div class="row"><div class="form-group col"><input id="text13" name="" type="text" class="form-control" required="required" value="Moisture"></div><div class="form-group col"><div class="input-group">       <input id="text14" onblur="func2()" name="" type="text" class="form-control"><div class="input-group-append"><div class="input-group-text">%</div> </div></div></div><div class="form-group col"><div class="input-group">        <input id="text15" name="data2[]"  type="text" class="form-control" required="required"><div class="input-group-append"><div class="input-group-text">Kg</div></div></div></div></div><div class="row"><div class="form-group col"><input id="text16" name="" type="text" class="form-control" value="Rejection"></div><div class="form-group col"><div class="input-group"><input id="text17" onblur="func3()" name="" type="text" class="form-control"><div class="input-group-append"><div class="input-group-text">%</div></div></div></div><div class="form-group col"><div class="input-group">       <input id="text18" name="data3[]"  onblur="func4()" type="text" class="form-control" required="required"><div class="input-group-append"><div class="input-group-text">Kg</div> </div></div></div></div><div class="row justify-content-end">     <label for="textx" class="col-2">Net WT.</label><div class="form-group col-4">         <div class="input-group"><input name="wt[]" type="text" class="form-control total" id="textx"><div class="input-group-append"><div class="input-group-text">Kg</div>     </div> </div></div></div><div class="row"><div class="input-group col col-3 justify-content-start p-3"><button type="button" id="btn" class="add2 btn btn-secondary">Add quality</button></div><div class="extra p-3"></div></div> <button type="button" name="insert" id="insert" class="btn btn-success mb-2">Insert</button></div>';
          
          $(e.target.parentElement.querySelector('div.container')).prepend(html);
            
         for(const iterator of document.querySelectorAll('button.btn-danger')){
          iterator.addEventListener('click', (e)=>{
              console.log(30);
              e.target.parentElement.remove();
              
          })
      }
          
          document.querySelector('button.add2').addEventListener('click', (e)=>{
             var html3='<div class="row">';
            html3 +='<button type="button" id="btn" class="btn text-danger">X</button><div class="form-group col"><input id="" name="eqname[]" type="text" class="form-control eqname" required="required" value="" placeholder="Enter Quality"></div>';
          html3 += '<div class="form-group col"><div class="input-group"><input id="eqp" onblur="func5()" name="eqp[]" type="text" class="form-control eqp" required="required"><div class="input-group-append"><div class="input-group-text">%</div></div></div></div>';
        html3 +='<div class="form-group col"><div class="input-group"><input id="eqw" name="eqw[]"  onblur="" type="text" class="form-control eqwt" required="required"><div class="input-group-append"><div class="input-group-text">Kg</div></div></div></div>';
  html3 +='</div>';
             $(e.target.parentElement.parentElement.querySelector('div.extra')).prepend(html3);
         
     document.querySelector('button.text-danger').addEventListener('click', (e)=>{
              
              $(e.target.parentElement).remove();
              
          });
     });
          function func5()
      {
          var a=parseFloat(document.getElementById('textx').value);
          var b=parseFloat(document.getElementById('eqp').value);
          document.getElementById('eqw').value=Number((a*(b/100)).toFixed(2));
          
      } 
          
      });
      
      
      function func1()
      {
          var a=parseFloat(document.getElementById('text9').value);
          var b=parseFloat(document.getElementById('text10').value);
          document.getElementById('text11').value=Number((a-b).toFixed(2));
      }
      function func2()
      {
          var a=parseFloat(document.getElementById('wt').value);
          var b=parseFloat(document.getElementById('text14').value);
          if(b>0){
              document.getElementById('text15').value=Number((a*(b/100)).toFixed(2));
          }
          else{
              document.getElementById('text15').value=0;
          }
          
          
      }
      function func3()
      {
          var a=parseFloat(document.getElementById('wt').value);
          var b=parseFloat(document.getElementById('text17').value);
          if(b>0){
              document.getElementById('text18').value=Number((a*(b/100)).toFixed(2));
          }
          else{
              document.getElementById('text18').value=0;
          }
          
          
          
      }
      function func4()
      {
          var a=parseFloat(document.getElementById('wt').value);
          var b=parseFloat(document.getElementById('text15').value);
          var c=parseFloat(document.getElementById('text18').value);
          document.getElementById('textx').value=Number((a-b-c).toFixed(2));
          
      }
      function func5()
      {
          var a=parseFloat(document.getElementById('textx').value);
          var b=parseFloat(document.getElementById('eqp').value);
          document.getElementById('eqw').value=Number((a*(b/100)).toFixed(2));
          
      }
      
      for(const iterator of document.querySelectorAll('button.btn-danger')){
          iterator.addEventListener('click', (e)=>{
              console.log(30);
              e.target.parentElement.remove();
              
          })
      }
      
      document.querySelector('button.add2').addEventListener('click', (e)=>{
             var html2='<div class="row">';
            html2 +='<button type="button" id="btn" class="btn text-danger">X</button><div class="form-group col"><input id="" name="eqname[]" type="text" class="form-control eqname" required="required" value="" placeholder="Enter Quality"></div>';
          html2 += '<div class="form-group col"><div class="input-group"><input id="eqp" onblur="func5()" name="eqp[]" type="text" class="form-control eqp" required="required"><div class="input-group-append"><div class="input-group-text">%</div></div></div></div>';
        html2 +='<div class="form-group col"><div class="input-group"><input id="eqw" name="eqw[]"  onblur="" type="text" class="form-control eqwt" required="required"><div class="input-group-append"><div class="input-group-text">Kg</div></div></div></div>';
  html2 +='</div>';
             $(e.target.parentElement.parentElement.querySelector('div.extra')).prepend(html2);
         
     document.querySelector('button.text-danger').addEventListener('click', (e)=>{
              
              $(e.target.parentElement).remove();
              
          }); 
          
        
      });
          
      
  </script>
</body>
</html>