<?php
header("Content-type: text/html; charset=utf-8");
function getDbConnect()
{
$con = mysql_connect("localhost","rbangcom_taobao","St568507123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("rbangcom_taobao", $con);
return $con;

}
function getTbOrders()
{
$con=getDbConnect();
$program_char = "utf8"; 
mysql_set_charset($program_char,$con);
$result = mysql_query("SELECT * FROM  `tb_orders`");
mysql_close($con);
return $result;
}

function setTrackingNumber($TbOrderNo,$TrackingCmp,$TrackingNumber)
{	
$con=getDbConnect();
$program_char = "utf8"; 
mysql_set_charset($program_char,$con);
$result = mysql_query("UPDATE `tb_orders` SET TrackingNumber='$TrackingNumber',TrackingCmp='$TrackingCmp' WHERE TbOrderNo='$TbOrderNo'");
mysql_close($con);
return $result;
}
function getTbtoken()
{
$con=getDbConnect();
$program_char = "utf8"; 
mysql_set_charset($program_char,$con);
$result = mysql_query("SELECT * FROM  `tb_token` ");
mysql_close($con);
while($row = mysql_fetch_array($result))
{
  $expritationDate=$row['expritationDate'];
  $token=$row['token'];
}
if (date("y-m-d h:i:s")>=$expritationDate)
{
	return "";
}
else
{
	return $token;
}
}

function insertToken($token,$expritationDate)
{
$con=getDbConnect();
$program_char = "utf8"; 
mysql_set_charset($program_char,$con);
$result = mysql_query("DELETE FROM `tb_token`");
$result = mysql_query("INSERT INTO `tb_token`(`tbUser`, `token`, `expritationDate`) VALUES ('forrest','$token','$expritationDate')");
mysql_close($con);
return $result;	
}


function dateadd($part, $n, $date)
{
switch($part)
{
case "y": $val = date("Y-m-d H:i:s", strtotime($date ." +$n year")); break;
case "m": $val = date("Y-m-d H:i:s", strtotime($date ." +$n month")); break;
case "w": $val = date("Y-m-d H:i:s", strtotime($date ." +$n week")); break;
case "d": $val = date("Y-m-d H:i:s", strtotime($date ." +$n day")); break;
case "h": $val = date("Y-m-d H:i:s", strtotime($date ." +$n hour")); break;
case "n": $val = date("Y-m-d H:i:s", strtotime($date ." +$n minute")); break;
case "s": $val = date("Y-m-d H:i:s", strtotime($date ." +$n second")); break;
}
return $val;
}
?>
