<?php
include_once("/var/www/html/kmis/services/hungamacare/config/dbConnectMTS.php");

// delete the prevoius record
$view_date1= date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y")));
$view_time1= date("h:i:s");

function getServiceName($service_id)
{
	switch($service_id)
	{
		case '1101':
			$service_name='MTSMU';
		break;
		case '1102':
			$service_name='MTS54646';
		break;
		case '1103':
			$service_name='MTVMTS';
		break;
		case '1111':
			$service_name = 'MTSDevo';
		break;
		case '1106':
			$service_name = 'MTSFMJ';
		break;
		case '1110':
			$service_name = 'RedFMMTS';
		break;
		case '1116':
			$service_name = 'MTSVA';
		break;
		case '11012':
			$service_name = 'MTSComedy';
		break;
		case '1113':
			$service_name = 'MTSMND';
		break;
	}
	return $service_name;
}


$circle_info=array('DEL'=>'Delhi','GUJ'=>'Gujarat','WBL'=>'WestBengal','BIH'=>'Bihar','RAJ'=>'Rajasthan','UPW'=>'UP WEST','MAH'=>'Maharashtra','APD'=>'Andhra Pradesh','UPE'=>'UP EAST','ASM'=>'Assam','TNU'=>'Tamil Nadu','KOL'=>'Kolkata','NES'=>'NE','CHN'=>'Chennai','ORI'=>'Orissa','KAR'=>'Karnataka','HAY'=>'Haryana','PUN'=>'Punjab','MUM'=>'Mumbai','MPD'=>'Madhya Pradesh','JNK'=>'Jammu-Kashmir','PUB'=>"Punjab",'KER'=>'Kerala','HPD'=>'Himachal Pradesh');

$service_array = array('MTSMU','MTS54646','MTVMTS','MTSDevo','MTSFMJ','RedFMMTS','MTSVA','MTSComedy','MTSMPD');

$getCurrentTimeQuery="select now()";

$timequery2 = mysql_query($getCurrentTimeQuery,$dbConn) or die(mysql_error());
$currentTime = mysql_fetch_row($timequery2);

$getDateFormatQuery="select date_format('".$currentTime[0]."','%Y-%m-%d %H')";

$dateFormatQuery = mysql_query($getDateFormatQuery,$dbConn) or die(mysql_error());
$DateFormat = mysql_fetch_row($dateFormatQuery);

if($_GET['time']) {
	echo $DateFormat[0] = $_GET['time'];
}

//echo $DateFormat[0] = '2013-02-26 13:00:00';

$DeleteQuery="delete from misdata.livemis where date='$DateFormat[0]' and service IN ('".implode("','",$service_array)."')";
$deleteResult12 = mysql_query($DeleteQuery,$LivdbConn) or die(mysql_error());

///////// start the code to insert the data of activation Docomo Endless and Tata Docomo endless, Dovomo MTV,Docomo Star club, Docomo 54646////////////////

// remove the 1005 FMJ id from this query : show wid 
$get_activation_query="select count(msisdn),circle,chrg_amount,service_id,event_type,plan_id from master_db.tbl_billing_success nolock ";
$get_activation_query .= " where response_time between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' and service_id in(1101,1102,1103,1111,1106, 1110,1116,1113) and event_type in('SUB','RESUB','TOPUP') group by circle,service_id,chrg_amount,event_type,plan_id";

$query = mysql_query($get_activation_query, $dbConn) or die(mysql_error());
$numRows = mysql_num_rows($query);
if ($numRows > 0)
{
	while(list($count,$circle,$charging_amt,$service_id,$event_type,$plan_id) = mysql_fetch_array($query))
	{
		if($plan_id == '29' && $service_id=='1101') $service_id='11012';
		$service_name=getServiceName($service_id);
		if($circle_info[strtoupper($circle)]=='')
			$circle_info[strtoupper($circle)]='Other';
		
		if($event_type=='SUB')
		{
			$revenue=$charging_amt*$count;
			$activation_str="Activation_".$charging_amt;
			if($plan_id == 11 && $service_id == 1106) {
				$activation_str="Activation_Ticket_20"; //.$mode; 
			} elseif($plan_id == 12 && $service_id == 1106) {
				$activation_str="Activation_Ticket_15"; //.$mode; 
			} elseif($plan_id == 13 && $service_id == 1106) {
				$activation_str="Activation_Ticket_10"; //.$mode; 
			} elseif($plan_id == 19 && $service_id == 1106) {
				$activation_str="Activation_Ticket_5"; //.$mode; 
			} else {
				$activation_str="Activation_".$charging_amt;
			}
			
			$insert_data="insert into misdata.livemis(Date,Service,Circle,Type,Value,Revenue) values(date_format('$DateFormat[0]','%Y-%m-%d %H'), '$service_name','".$circle_info[strtoupper($circle)]."','$activation_str','$count',$revenue)";
		}

		elseif($event_type=='RESUB')
		{
			$charging_str="Renewal_".$charging_amt;
			if($plan_id == 11 && $service_id == 1106) {
				$charging_str="Renewal_Ticket_20"; //.$mode; 
			} elseif($plan_id == 12 && $service_id == 1106) {
				$charging_str="Renewal_Ticket_15"; //.$mode; 
			} elseif($plan_id == 13 && $service_id == 1106) {
				$charging_str="Renewal_Ticket_10"; //.$mode; 
			} elseif($plan_id == 19 && $service_id == 1106) {
				$charging_str="Renewal_Ticket_5"; //.$mode; 
			} else {
				$charging_str="Renewal_".$charging_amt;
			}

			$revenue=$charging_amt*$count;
			$insert_data="insert into misdata.livemis(Date,Service,Circle,Type,Value,Revenue) values(date_format('$DateFormat[0]','%Y-%m-%d %H'), '$service_name','".$circle_info[strtoupper($circle)]."','$charging_str','$count',$revenue)";
		}
		elseif($event_type=='TOPUP')
		{
			$charging_str="TOPUP_".$charging_amt;
			$revenue=$charging_amt*$count;
			$insert_data="insert into misdata.livemis(Date,Service,Circle,Type,Value,Revenue) values(date_format('$DateFormat[0]','%Y-%m-%d %H'), '$service_name','".$circle_info[strtoupper($circle)]."','$charging_str','$count',$revenue)";
		}

		$queryIns = mysql_query($insert_data,$LivdbConn);
		$event_type='';
		$activation_str='';
		$charging_amt='';
		$insert_data='';
		$charging_str='';
		$queryIns='';
	}
}

/////////// End the code to insert the data of activation Docomo Endless and Tata Docomo endless, Dovomo MTV,Docomo Star club , Docomo 54646//////////

//////////////////////////////////Start the code to activation Record mode wise //////////////////////////////////////////////////////////

 $get_mode_activation_query= "select count(msisdn),circle,service_id,event_type,mode,plan_id from master_db.tbl_billing_success nolock ";
 $get_mode_activation_query .=" where response_time between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' and service_id in(1101,1102,1103,1111,1106,1110,1116,1113) and event_type in('SUB') group by circle,service_id,event_type,mode order by event_type,plan_id";

$db_query = mysql_query($get_mode_activation_query, $dbConn) or die(mysql_error());
$numRows1 = mysql_num_rows($db_query);
if ($numRows1 > 0)
{
	while(list($count,$circle,$service_id,$event_type,$mode,$plan_id) = mysql_fetch_array($db_query))
	{
		if($plan_id == '29' && $service_id=='1101') $service_id='11012';
		$service_name=getServiceName($service_id);
		if($circle_info[strtoupper($circle)]=='')
			$circle_info[strtoupper($circle)]='Other';
		$activation_str1="Mode_Activation_".$mode;

		if($plan_id == 11 && $service_id == 1106) {
			$activation_str1="Mode_Activation_Ticket_20".$mode; 
		} elseif($plan_id == 12 && $service_id == 1106) {
			$activation_str1="Mode_Activation_Ticket_15".$mode; 
		} elseif($plan_id == 13 && $service_id == 1106) {
			$activation_str1="Mode_Activation_Ticket_10".$mode; 
		} elseif($plan_id == 19 && $service_id == 1106) {
			$activation_str1="Mode_Activation_Ticket_5".$mode; 
		} else {
			$activation_str1="Mode_Activation_".$mode;
		}
		
		$insert_data1="insert into misdata.livemis(Date,Service,Circle,Type,Value,Revenue) values(date_format('$DateFormat[0]','%Y-%m-%d %H'), '$service_name','".$circle_info[strtoupper($circle)]."','$activation_str1','$count',0)";		
		$queryIns = mysql_query($insert_data1,$LivdbConn);
		$service_name='';
		$event_type='';
		$activation_str1='';
		$insert_data1='';
		$queryIns='';
		$mode='';
	}
}

//////////////////////////////////End the code to activation Record mode wise ////////////////////////////////////////////////////////////


///////////////////////////// Start code to insert the Pending Base date into the database Docomo Endless Music///////////////////////////////////

$get_pending_base="select count(ani),circle,'1101' as service_name from mts_radio.tbl_radio_subscription where status=11 and plan_id!='29' group by circle 
union
select count(ani),circle,'11012' as service_name from mts_radio.tbl_radio_subscription where status=11 and plan_id='29' group by circle 
union
select count(ani),circle,'1102' as service_name from mts_hungama.tbl_jbox_subscription where status=11 group by circle 
union
select count(ani),circle,'1103' as service_name from mts_mtv.tbl_mtv_subscription where status=11 group by circle
union
select count(ani),circle,'1111' as service_name from dm_radio.tbl_digi_subscription where status=11 group by circle
union
select count(ani),circle,'1106' as service_name from mts_starclub.tbl_jbox_subscription where status=11 group by circle
union
select count(ani),circle,'1110' as service_name from mts_redfm.tbl_jbox_subscription where status=11 group by circle
union
select count(ani),circle,'1116' as service_name from mts_voicealert.tbl_voice_subscription where status=11 group by circle
union
select count(ani),circle,'1113' as service_name from mts_mnd.tbl_character_subscription1 where status=11 group by circle";

$pending_base_query = mysql_query($get_pending_base, $dbConn) or die(mysql_error());

$numRows12 = mysql_num_rows($pending_base_query);
if ($numRows12 > 0)
{
	while(list($count,$circle,$service_id) = mysql_fetch_array($pending_base_query))
	{
		if($circle_info[strtoupper($circle)]=='')
			$circle_info[strtoupper($circle)]='Other';
		$service_name=getServiceName($service_id);
		$insert_pending_base="insert into misdata.livemis(Date,Service,Circle,Type,Value,Revenue) values(date_format('$DateFormat[0]','%Y-%m-%d %H'),'$service_name' ,'".$circle_info[strtoupper($circle)]."','Pending_Base','$count',0)";
		$queryIns_pending = mysql_query($insert_pending_base,$LivdbConn);
		$insert_pending_base='';
		$queryIns_pending='';
		$count='';
		$circle='';
		$service_id='';

	}
}

//////////////////////////////////// end code to insert the active base date into the database Docomo Endless Music/////////////////////////////

////////// start code to insert the active base date into the database Docomo Endless Music///////////////////////////////////////////////////

$get_active_base="select count(ani),circle,'1101' as service_name from mts_radio.tbl_radio_subscription where status=1 and plan_id!=29 group by circle 
union
select count(ani),circle,'11012' as service_name from mts_radio.tbl_radio_subscription where status=1 and plan_id=29 group by circle 
union
select count(ani),circle,'1102' as service_name from mts_hungama.tbl_jbox_subscription where status=1 group by circle 
union
select count(ani),circle,'1103' as service_name from mts_mtv.tbl_mtv_subscription where status=1 group by circle 
union
select count(ani),circle,'1111' as service_name from dm_radio.tbl_digi_subscription where status=1 group by circle
union
select count(ani),circle,'1106' as service_name from mts_starclub.tbl_jbox_subscription where status=1 group by circle
union
select count(ani),circle,'1110' as service_name from mts_redfm.tbl_jbox_subscription where status=1 group by circle
union
select count(ani),circle,'1116' as service_name from mts_voicealert.tbl_voice_subscription where status=1 group by circle
union
select count(ani),circle,'1113' as service_name from mts_mnd.tbl_character_subscription1 where status=1 group by circle";

$active_base_query = mysql_query($get_active_base, $dbConn) or die(mysql_error());
$numRows = mysql_num_rows($active_base_query);
if ($numRows > 0)
{
	while(list($count,$circle,$service_id) = mysql_fetch_array($active_base_query))
	{
		if($circle_info[strtoupper($circle)]=='')
			$circle_info[strtoupper($circle)]='Other';
		$service_name=getServiceName($service_id);
		$insert_data2="insert into misdata.livemis(Date,Service,Circle,Type,Value,Revenue) values(date_format('$DateFormat[0]','%Y-%m-%d %H'),'$service_name' ,'".$circle_info[strtoupper($circle)]."','Active_Base','$count',0)";
		$queryIns = mysql_query($insert_data2, $LivdbConn);
	}
}

////////////////////////// end code to insert the active base date into the database Docomo Endless Music//////////////////////////////////////

/////////////////////////////////// Start code to insert the Deactivation Base into the MIS database Docomo endless Music//////////////////////

$get_deactivation_base="select count(ani),circle,'1101' as service_name from mts_radio.tbl_radio_unsub 
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' and plan_id!=29 group by circle
union
select count(ani),circle,'11012' as service_name from mts_radio.tbl_radio_unsub 
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' and plan_id=29 group by circle
union
select count(ani),circle,'1102' as service_name from mts_hungama.tbl_jbox_unsub 
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle
union
select count(ani),circle,'1103' as service_name from mts_mtv.tbl_mtv_unsub 
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle
union
select count(ani),circle,'1111' as service_name from dm_radio.tbl_digi_unsub
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle
union
select count(ani),circle,'1106' as service_name from mts_starclub.tbl_jbox_unsub
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle
union
select count(ani),circle,'1110' as service_name from mts_redfm.tbl_jbox_unsub
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle
union
select count(ani),circle,'1116' as service_name from mts_voicealert.tbl_voice_unsub
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle
union
select count(ani),circle,'1113' as service_name from mts_mnd.tbl_character_unsub1
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle";

$deactivation_base_query = mysql_query($get_deactivation_base, $dbConn) or die(mysql_error());
$numRows = mysql_num_rows($deactivation_base_query);
if ($numRows > 0)
{
	while(list($count,$circle,$service_id) = mysql_fetch_array($deactivation_base_query))
	{
		if($circle_info[strtoupper($circle)]=='')
			$circle_info[strtoupper($circle)]='Other';
		$service_name=getServiceName($service_id);
		$insert_data3="insert into misdata.livemis(Date,Service,Circle,Type,Value,Revenue) values(date_format('$DateFormat[0]','%Y-%m-%d %H'),'$service_name','".$circle_info[strtoupper($circle)]."','Deactivation_2','$count',0)";
		$queryIns = mysql_query($insert_data3, $LivdbConn);
	}
}

////////////////////////////////////////////// end code to insert the Deactivation base into the MIS database Docomo endless Music//////////////////////



////////////////////////////////// start code to insert the Deactivation Base into the MIS database Docomo Endless Music//////////////////////

$get_deactivation_base="select count(ani),circle,'1101' as service_name,unsub_reason from mts_radio.tbl_radio_unsub 
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR ) and '$DateFormat[0]' and plan_id!=29 group by circle,unsub_reason
union
select count(ani),circle,'11012' as service_name,unsub_reason from mts_radio.tbl_radio_unsub 
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR ) and '$DateFormat[0]' and plan_id=29 group by circle,unsub_reason
union
select count(ani),circle,'1002' as service_name,unsub_reason from mts_hungama.tbl_jbox_unsub 
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle,unsub_reason
union
select count(ani),circle,'1003' as service_name,unsub_reason from mts_mtv.tbl_mtv_unsub 
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle,unsub_reason
union
select count(ani),circle,'1111' as service_name,unsub_reason from dm_radio.tbl_digi_unsub
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle,unsub_reason
union
select count(ani),circle,'1106' as service_name,unsub_reason from mts_starclub.tbl_jbox_unsub
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle,unsub_reason
union
select count(ani),circle,'1110' as service_name,unsub_reason from mts_redfm.tbl_jbox_unsub
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle,unsub_reason
union
select count(ani),circle,'1116' as service_name,unsub_reason from mts_voicealert.tbl_voice_unsub
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle,unsub_reason
union
select count(ani),circle,'1113' as service_name,unsub_reason from mts_mnd.tbl_character_unsub1
where unsub_date between DATE_SUB('$DateFormat[0]', INTERVAL 1 HOUR) and '$DateFormat[0]' group by circle,unsub_reason";

$deactivation_base_query = mysql_query($get_deactivation_base, $dbConn) or die(mysql_error());
$numRows = mysql_num_rows($deactivation_base_query);
if ($numRows > 0)
{
	while(list($count,$circle,$service_id,$unsub_reason) = mysql_fetch_array($deactivation_base_query))
	{
		if($circle_info[strtoupper($circle)]=='')
			$circle_info[strtoupper($circle)]='Other';
		$service_name=getServiceName($service_id);
		$deactivation_str1="Mode_Deactivation_".$unsub_reason;

		$insert_data4="insert into misdata.livemis(Date,Service,Circle,Type,Value,Revenue) values(date_format('$DateFormat[0]','%Y-%m-%d %H'), '$service_name','".$circle_info[strtoupper($circle)]."','$deactivation_str1','$count',0)";
		$queryIns = mysql_query($insert_data4, $LivdbConn);
	}
}
echo "generated";
mysql_close($dbConn);
// end 

?>
