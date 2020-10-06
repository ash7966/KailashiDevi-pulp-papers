<?php if(!isset($_SESSION)) { session_start(); }
error_reporting(0);
function makeconnection(){
	if(!$cn = mysqli_connect("localhost","root","","testing")){
		echo "<div style='background: #FEFCCD; width: auto; border: #f00000 dotted 1px; border-radius: 5px; color: #ff0000; font-weight: bold; font-size: 16px; text-align: center; padding: 10px; margin: 10px; z-index: 9999999'><span style='color: #0000ff;'>Error</span>: ". mysqli_connect_error() . "</div>";
	}
	return $cn;
}
$cn = makeconnection();
?>	