<?php
session_start();
error_reporting(0);
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
$connect = mysqli_connect("localhost", "root", "", "testing");	
$query= "SELECT name,wt,rate FROM quality WHERE sn='".$_SESSION['sn']."'";

$test="SELECT * FROM info WHERE sn ='".$_SESSION['sn']."'";
$test2=mysqli_query($connect,$test);
$test34="SELECT payment FROM info WHERE sn ='".$_SESSION['sn']."'";
$test35=mysqli_query($connect,$test34);
$data34=mysqli_fetch_row($test35);
$s=mysqli_query($connect,$query);
$row=mysqli_num_rows($s);
if(isset($_POST["submit"]))
{
     
    for($i=0; $i<count($_POST["data4"]); $i++)
 {
        $query3 ="UPDATE quality SET rate='".$_POST['data4'][$i]."' WHERE sn='".$_SESSION['sn']."' AND name='".$_POST['data1'][$i]."'";
        if (!mysqli_query($connect,$query3)) {
  echo("Error description: " . mysqli_error($connect));
     
 }
    }
    $a="UPDATE info SET payment='".$_POST['total']."' WHERE sn='".$_SESSION['sn']."'";
    if (!mysqli_query($connect,$a)) {
  echo("Error description: " . mysqli_error($connect));
     
 }
    $ab="INSERT INTO account (sn,name,date,ob) VALUES( '".$_POST['sn']."','".$_POST['acname']."','".$_POST['pd']."','".$_POST['total']."') ON DUPLICATE KEY UPDATE ob =ob +'".$_POST['total']."'";
    if (!mysqli_query($connect,$ab)) {
  echo("Error description: " . mysqli_error($connect));
     
 }
    
   
    
   header('location:stock-summary.php');
 
 } 

if(isset($_POST['quality'])){
    unset($_SESSION['sn']);
    $_SESSION['sn']=$_POST['search'];
    header('location:gnr.php');
}
?> <!doctype html> <html lang=en class=no-js> <head> <meta charset=UTF-8> <meta http-equiv=X-UA-Compatible content="IE=edge"> <meta name=viewport content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"> <title>GNR-Sheet</title> <link rel=stylesheet href=css/font-awesome.min.css> <link rel=stylesheet href=css/bootstrap.min.css> <link rel=stylesheet href=css/dataTables.bootstrap.min.css> <link rel=stylesheet href=css/bootstrap-social.css> <link rel=stylesheet href=css/bootstrap-select.css> <link rel=stylesheet href=css/fileinput.min.css> <link rel=stylesheet href=css/awesome-bootstrap-checkbox.css> <link rel=stylesheet href=css/style.css> <link rel=stylesheet href=css/simple-sidebar.css> <style>@media print{body *{visibility:hidden}#printable,#printable *{visibility:visible}#printable{position:absolute;left:0;top:0}#heading{visibility:visible}#btn,form#search input,button#insert{visibility:hidden}#printable,#printable input,div.input-group-text{font-weight:700;} label.col-form-label{
                 font-weight: 800;
             }
} #printable{background-color:#eee}#heading{visibility:hidden}.errorWrap{padding:10px;margin:0 0 20px 0;background:#dd3d36;color:#fff;-webkit-box-shadow:0 1px 1px 0 rgba(0,0,0,.1);box-shadow:0 1px 1px 0 rgba(0,0,0,.1)}.succWrap{padding:10px;margin:0 0 20px 0;background:#5cb85c;color:#fff;-webkit-box-shadow:0 1px 1px 0 rgba(0,0,0,.1);box-shadow:0 1px 1px 0 rgba(0,0,0,.1)}</style> </head> <body> <div class=d-flex id=wrapper> <?php include('includes/leftbar.php'); ?> <div id=page-content-wrapper> <?php include('includes/header.php'); ?> <div class=container id=printable> <div class=p-3 id=heading> <h2 align=center>KAILASHIDEVI PULPS AND PAPER PRODUCTS</h2> <h6 align=center>VILL:- LALPUR,KUNDA,JASPUR ROAD KASHIPUR,UDHAM SINGH NAGAR,UTTARAKHAND-244713</h6> </div> <h3 class="m-4 row justify-content-center">GNR Sheet</h3> <form class="row input-group" id=search method=post action=gnr.php> <input type=text name=search placeholder="Enter Serial no." class="form-control col col-3"> <input type=submit name=quality value=search/reset class="btn btn secondary"> </form> <br> <form method=post action=gnr.php> <?php 
      if($_SESSION['sn']){
          foreach($test2 as $row)
          {  ?> <div class="form-group row border pt-2 pb-2"> <label for=text class="col-1 col-form-label">SR no.</label> <div class=col-4> <input id=text name=sn value=<?php echo $row['sn']; ?> type=text class=form-control required=required> </div> <label for=text1 class="col-2 col-form-label">Report date</label> <div class=col-4> <input id=text1 name=pd type=date class=form-control value=<?php echo $row['pd']; ?> required=required> </div> </div> <div class="border p-3"> <div class="form-group row"> <label for=text2 class="col-3 col-form-label">Account Name</label> <div class=col-8> <input id=text2 name=acname value="<?php echo $row['acname']; ?>" type=text class=form-control required=required> </div> </div> <div class="form-group row"> <label for=text3 class="col-3 col-form-label">Supplier Name</label> <div class=col-8> <input id=text3 name=supplier value="<?php echo $row['supplier']; ?>" type=text class=form-control required=required> </div> </div> <div class="form-group row"> <label for=text4 class="col-3 col-form-label">Party Name</label> <div class=col-8> <input id=text4 name=party value="<?php echo $row['party']; ?>" type=text class=form-control required=required> </div> </div> <div class="form-group row"> <label for=text5 class="col-3 col-form-label">Place of loading</label> <div class=col-8> <input id=text5 name=place value="<?php echo $row['place']; ?>" type=text class=form-control required=required> </div> </div> <div class="form-group row"> <label for=text6 class="col-3 col-form-label">Date of loading</label> <div class=col-8> <input id=text6 name=ld type=date value=<?php echo $row['ld']; ?> class=form-control required=required> </div> </div> </div> <div class="border p-3"> <div class="form-group row"> <label for=text7 class="col-3 col-form-label">Invoice No.</label> <div class=col-8> <input id=text7 name=invoice value=<?php echo $row['invoice']; ?> type=text class=form-control required=required> </div> </div> <div class="form-group row"> <label for=text8 class="col-3 col-form-label">Vehicle No.</label> <div class=col-8> <input id=text8 name=vehicle type=text value=<?php echo $row['vehicle']; ?> class=form-control required=required> </div> </div> </div> <div class="border p-3"> <div class="form-group row"> <label for=text9 class="col-3 col-form-label">Challan Wt.</label> <div class=col-6> <div class=input-group> <input id=text9 name=ch_wt type=text value=<?php echo $row['ch_wt']; ?> class=form-control required=required> <div class=input-group-append> <div class=input-group-text>Kg</div> </div> </div> </div> </div> <div class="form-group row"> <label for=text10 class="col-3 col-form-label">Mill Wt.</label> <div class=col-6> <div class=input-group> <input id=text10 onblur=func1() value=<?php echo $row['mi_wt']; ?> name=mi_wt type=text class=form-control required=required> <div class=input-group-append> <div class=input-group-text>Kg</div> </div> </div> </div> </div> <div class="form-group row"> <label for=text11 class="col-3 col-form-label">Shortage</label> <div class=col-6> <div class=input-group> <input id=text11 name=shortage value=<?php echo $row['shortage']; ?> type=text class=form-control required=required> <div class=input-group-append> <div class=input-group-text>Kg</div> </div> </div> </div> </div> </div> <?php } }
              else {?> <div class="form-group row border pt-2 pb-2"> <label for=text class="col-1 col-form-label">SR no.</label> <div class=col-4> <input id=text name=sn value type=text class=form-control required=required> </div> <label for=text1 class="col-2 col-form-label">Report date</label> <div class=col-4> <input id=text1 name=pd type=date class=form-control value required=required> </div> </div> <div class="border p-3"> <div class="form-group row"> <label for=text2 class="col-3 col-form-label">Account Name</label> <div class=col-8> <input id=text2 name=acname value type=text class=form-control required=required> </div> </div> <div class="form-group row"> <label for=text3 class="col-3 col-form-label">Supplier Name</label> <div class=col-8> <input id=text3 name=supplier value type=text class=form-control required=required> </div> </div> <div class="form-group row"> <label for=text4 class="col-3 col-form-label">Party Name</label> <div class=col-8> <input id=text4 name=party value type=text class=form-control required=required> </div> </div> <div class="form-group row"> <label for=text5 class="col-3 col-form-label">Place of loading</label> <div class=col-8> <input id=text5 name=place value type=text class=form-control required=required> </div> </div> <div class="form-group row"> <label for=text6 class="col-3 col-form-label">Date of loading</label> <div class=col-8> <input id=text6 name=ld type=date value class=form-control required=required> </div> </div> </div> <div class="border p-3"> <div class="form-group row"> <label for=text7 class="col-3 col-form-label">Invoice No.</label> <div class=col-8> <input id=text7 name=invoice value type=text class=form-control required=required> </div> </div> <div class="form-group row"> <label for=text8 class="col-3 col-form-label">Vehicle No.</label> <div class=col-8> <input id=text8 name=vehicle type=text value class=form-control required=required> </div> </div> </div> <div class="border p-3"> <div class="form-group row"> <label for=text9 class="col-3 col-form-label">Challan Wt.</label> <div class=col-6> <div class=input-group> <input id=text9 name=ch_wt type=text value class=form-control required=required> <div class=input-group-append> <div class=input-group-text>Kg</div> </div> </div> </div> </div> <div class="form-group row"> <label for=text10 class="col-3 col-form-label">Mill Wt.</label> <div class=col-6> <div class=input-group> <input id=text10 onblur=func1() value name=mi_wt type=text class=form-control required=required> <div class=input-group-append> <div class=input-group-text>Kg</div> </div> </div> </div> </div> <div class="form-group row"> <label for=text11 class="col-3 col-form-label">Shortage</label> <div class=col-6> <div class=input-group> <input id=text11 name=shortage value type=text class=form-control required=required> <div class=input-group-append> <div class=input-group-text>Kg</div> </div> </div> </div> </div> </div> <?php } ?> <div class="border p-3"> <h4>Report</h4> <?php 
      if($_SESSION['sn']){
          foreach($s as $row)
          {  ?> <div class="container border p-3"><div id="alert_message"></div> <div class=row> <div class="form-group col-4"> <input id=text12 name=data1[] type=text class="form-control name" required=required value="<?php echo $row['name']; ?>"> </div> <div class="form-group col-4"> <div class=input-group> <input id=wt name=qwt[] type=text class="form-control wt" required=required value="<?php echo $row['wt']; ?>"> <div class=input-group-append> <div class=input-group-text>Kg</div> </div> </div> </div> </div> <?php $eq="SELECT eqname,eqp,eqw,eqrate from ex_quality WHERE sn='".$_SESSION['sn']."' AND name='".$row['name']."'"; 
            $eq_run=mysqli_query($connect,$eq);
           $eq_row=mysqli_num_rows($eq_run);
          if($eq_row>0){
             
              
              foreach($eq_run as $row4){
                        
      ?> <div class=row> <div class="form-group col"><input id name=eqname[] type=text class="form-control eqname" required=required value="<?php echo $row4['eqname']?>"></div> <div class="form-group col"> <div class=input-group> <input name=eqp[] type=text class=form-control required=required value=<?php echo $row4['eqp']?>> <div class=input-group-append><div class=input-group-text>%</div> </div> </div> </div> <div class="form-group col"><div class=input-group><input id=eqw type=text class="form-control wt" required=required value=<?php echo $row4['eqw']?>> <div class=input-group-append> <div class=input-group-text>Kg</div> </div> </div> </div> <div class="form-group col-3"> <div class=input-group> <input name=data7[] type=text class="form-control rate" id=text19 placeholder=Rate value=<?php echo $row4['eqrate']?> required> <div class=input-group-append> <div class=input-group-text>Rs.</div> </div> </div> </div> </div> <?php } 
                      
          } else{ ?> <div class="row justify-content-end"> <label for=text19 class=col-1>Rate</label> <div class="form-group col-4"> <div class=input-group> <input name=data4[] type=text class="form-control rate2" id=text19 value=<?php echo $row['rate']?> required> <div class=input-group-append> <div class=input-group-text>Rs.</div> </div> </div> </div> </div> <?php }?><div class="row justify-content-end"><button type="button" name="insert" id="insert" class="btn btn-success mb-2">Insert</button></div> </div> <?php  }
          
          
      } else { ?> <div class="container border p-3"> <div class=row> <div class="form-group col-4"> <input id=text12 name=data1[] type=text class=form-control required=required value> </div> <div class="form-group col-4"> <div class=input-group> <input id=wt name=qwt[] type=text class="form-control wt" required=required value> <div class=input-group-append> <div class=input-group-text>Kg</div> </div> </div> </div> </div> <div class="row justify-content-end"> <label for=text19 class=col-1>Rate</label> <div class="form-group col-4"> <div class=input-group> <input name=data4[] type=text class="form-control rate2" id=text19 required> <div class=input-group-append> <div class=input-group-text>Rs.</div> </div> </div> </div> </div> </div> <?php }?> <div class="row justify-content-end"> <label for=text21 class=col-1>Total</label> <div class="form-group col-4"> <div class=input-group> <input name="total" type=text class="form-control total" id=text21 value="<?php echo $data34[0] ?>"> <div class=input-group-append> <div class=input-group-text>Rs.</div> </div> </div> </div> </div> </div> <div class="form-group row mt-3"> <div class="offset-4 col-8"> <button name=submit type=submit class="btn btn-primary m-1" id=btn>Submit</button> <button id="btn" name=print type=button class="btn btn-primary m-1" id=btn onclick=window.print()>Print</button> </div> </div> </form> </div> </div> </div> <script src=js/jquery.min.js></script> <script src=js/bootstrap.min.js></script> <script>$("#menu-toggle").click(function(e){e.preventDefault();$("#wrapper").toggleClass("toggled");});function func2()
{var a=parseFloat(document.getElementById('text10').value);var b=parseFloat(document.getElementById('text14').value);document.getElementById('text15').value=Number((a*(b/100)).toFixed(2));}
function func3()
{var a=parseFloat(document.getElementById('text10').value);var b=parseFloat(document.getElementById('text17').value);document.getElementById('text18').value=Number((a*(b/100)).toFixed(2));}
var c=0;
    
    
    
for(const iterator of document.querySelectorAll('input.rate'))
{iterator.addEventListener('blur',(e)=>{console.log(20);{var b=parseFloat(e.target.parentElement.parentElement.parentElement.querySelector('input.wt').value);a=parseFloat(iterator.value); c+=a*b;console.log(a);e.target.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('#text21').value=c.toFixed(2);}})}   
for(const iterator of document.querySelectorAll('input.rate2'))
{
    
    iterator.addEventListener('blur',(e)=>{
    var b=iterator.parentElement.parentElement.parentElement.parentElement.querySelector('input.wt').value;
                                           //b=parseFloat(iterator.parentElement.parentElement.parentElement.querySelector('input.wt').value);
                                           a=parseFloat(iterator.value);c+=a*b;e.target.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('#text21').value=c.toFixed(2);
                                           
                                          });
    
       
}
    
    
         $(document).on('click', '#insert',function(e){
    
          
          var eqname=new Array();
             var eqrate=new Array();
          var i=0,j=0; 
          
                  
                      
                      for(const a of e.target.parentElement.parentElement.querySelectorAll('input.eqname')){
                          eqname[i]=a.value;
                          i++;
                          }
             for(const a of e.target.parentElement.parentElement.querySelectorAll('input.rate')){
                          eqrate[j]=a.value;
                          j++;
                          }
             if(eqname==''){
                 var name=e.target.parentElement.parentElement.querySelector('input.name').value;
            var rate=e.target.parentElement.parentElement.querySelector('input.rate2').value;
             var qwt=e.target.parentElement.parentElement.querySelector('input.wt').value;
             }
             
   if(eqname != '' && eqrate != '')
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{eqname:eqname,eqrate:eqrate},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 3000);
   } 
             
     else if(name != '' && rate != '')
   {
    $.ajax({
     url:"insert4.php",
     method:"POST",
     data:{name:name,qwt:qwt,rate:rate},
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
    
    
    
    </script> </body> </html>