<?php
error_reporting(0);
include ("/var/www/html/kmis/services/hungamacare/config/dbcon/dbConnect212.php");
if(isset($_REQUEST['date'])) { 
	$date= $_REQUEST['date'];
} else {
	$date= date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y")));
}
//Previous date
$getMsisdnId="select id from uninor_hungama.tbl_GUJ_recharge nolock where date(date_time)='".$date."' and recharge_flag in(1,11) and trxid!='' 
order by id ASC";
$result_id=mysql_query($getMsisdnId,$dbConn212);
$ReachargeList=array();
while(list($id1)=mysql_fetch_array($result_id))
{
$ReachargeList[]=$id1;
$aniPicked="update uninor_hungama.tbl_GUJ_recharge set recharge_flag=5 where id=".$id1;
if(mysql_query($aniPicked,$dbConn212))
	{
	}
	else
	{
	$error= mysql_error();
	}
}
$totalcount=count($ReachargeList);

if($totalcount>=1)
{
$allIds = implode(",", $ReachargeList);		

$get_allwinner = "select id,ANI,date(date_time) as date_time,trxid from uninor_hungama.tbl_GUJ_recharge nolock where id in($allIds)";
$data = mysql_query($get_allwinner, $dbConn212);
$numrows = mysql_num_rows($data);
if ($numrows==0) 
{ 
echo "NO Data to process";
}
else
{
while ($result_data = mysql_fetch_array($data))
{
	$ani=$result_data['ANI'];
	$EntryDate=$result_data['date_time'];
	$id=$result_data['id'];
	$trxid=$result_data['trxid'];
	
	$getStatus=mysql_query("select transactionId,response,response_time,request_time 
	from master_db.tbl_recharged nolock where status=1 and TRIM(LEADING '0' FROM transactionId)='".$trxid."'",$dbConn212);
	$isRecharge=mysql_num_rows($getStatus);
	if($isRecharge>=1)
	{
	$rechageStatus = mysql_fetch_array($getStatus);
	$TID=$rechageStatus['transactionId'];
	$response_time=$rechageStatus['response_time'];
	$response=$rechageStatus['response'];	

	$Update_status = "update uninor_hungama.tbl_GUJ_recharge set recharge_flag=2,recharge_response='".$response."',recharge_date_time='".$response_time."' where id='".$id."'";
	$result2 = mysql_query($Update_status,$dbConn212);
	}
	else
	{
	$Update_status = "update uninor_hungama.tbl_GUJ_recharge set recharge_flag=11 where id='".$id."'";
	$result2 = mysql_query($Update_status,$dbConn212);
	}

}
echo "Recharge Status Update done";	
}
}
else
{
echo "No Records Found";
}
mysql_close($dbConn212);
?>