<?php 

	$logPath = "/var/www/html/airtel/logs/airtelService/".$serviceId."/log_".date("Y-m-d").".txt";
	$logNewPath = "/var/www/html/airtel/logs/airtelService/".$serviceId."/reflog_".date("Y-m-d").".txt";
if($reqtype == 0) {
	header('Path=/airtelSubUnsub');
	header('Content-Type: UTF-8');
	switch($serviceId)
	{	
		case '1517':
			//$response="Welcome! Please enter customer's 10 digit mobile no.";	
			$response='Welcome to Spoken English.'."\n"."Reply"."\n"."3 for 30 Rs"."\n"."4 for 10 Rs"; 
			header("Menu code:".$response);
		break;
	}
	
	header('Freeflow: FC');
	header('charge: y');
	header('amount:30');
	header('Expires: -1');
	echo $response;
	$logData=$msisdn."#".$serviceId."#".$reqtype."#".$circle."#".$qry."#Response:Freeflow:FC#".$response."#".date("Y-m-d H:i:s")."\n";
	error_log($logData,3,$logPath);
	error_log($msisdn."#".$reqtype."#".$circle."#".date("Y-m-d H:i:s")."\n",3,$logNewPath);
}

if($reqtype == 3 || $reqtype == 4) {
	header('Path=/airtelSubUnsub');
	header('Content-Type: UTF-8');
	switch($serviceId)
	{	
		case '1517':
			$response="Welcome! Please enter customer's 10 digit mobile no.";	
			switch($reqtype)
			{
				case '3':
					$plan_id1=86;
				break;
				case '4':
					$plan_id1=87;
				break;
				default:
					$plan_id1=86;
				break;

			}
			$queryF = "INSERT INTO master_db.tbl_refer_ussdData VALUES ('','".$msisdn."','NA',NOW(),adddate(NOW(),3),'".$serviceId."','Retailer','".$userCircle."',".$plan_id1.")";
			mysql_query($queryF);
			header("Menu code:".$response);
		break;
	}
	
	header('Freeflow: FC');
	header('charge: y');
	header('amount:30');
	header('Expires: -1');
	echo $response;
	$logData=$msisdn."#".$serviceId."#".$reqtype."#".$circle."#".$qry."#Response:Freeflow:FC#".$response."#".date("Y-m-d H:i:s")."\n";
	error_log($logData,3,$logPath);
	error_log($msisdn."#".$reqtype."#".$circle."#".date("Y-m-d H:i:s")."\n",3,$logNewPath);
}

if((strlen($reqtype)>2) && $serviceId==1517 && $retData) {	
	header('Path=/airtelSubUnsub');
	header('Content-Type: UTF-8');	
	if($planid) 
	{
		if(strlen($reqtype)==10 || strlen($reqtype)==12) 
		{
			$getPlanId = "select plan_id from master_db.tbl_refer_ussdData where date(referDate)=date(now()) and service_id=1517 and ani=".$msisdn." and friendANI='NA' order by id desc limit 1";
			$userPlanId=mysql_query($getPlanId) or die( mysql_error());
			while($Planrow = mysql_fetch_array($userPlanId)) 
				$userplanId = $Planrow['plan_id'];
			switch($userplanId)
			{
				case '86':
					$msgText="30/15 days";
				break;
				case '87':
					$msgText="10/5 days";
				break;

			}
			switch($serviceId) 
			{				
				case '1517': 
					if($circle=="UPW") 
						$message = "Aptech certified Spoken English course apke mobile par ghar baithe. Rs. ".$msgText." for 90 days. Activate karne ke liye reply kare 1 se.";
					else
						$message = "Job aur padai mein tarakki ke liye seekhiye Spoken English apne mobile par! Subscribe karne ke liye reply mein bhejiye YES. Rs.".$msgText.". Aptech certified!";
					
				$response="Your Request to start Spoken English Service has been submitted successfully."; 
				$from="571811";
				$sndMsgQuery1 = "CALL master_db.SENDSMS('".$frndMDN."','".$message."','".$from."',4,'".$from."','RET')"; 
				break;
			}

		$getCircle1 = "select master_db.getCircle(".trim($frndMDN).") as circle";
		$userCircle2=mysql_query($getCircle1) or die( mysql_error() );
		while($row = mysql_fetch_array($userCircle2)) {
			$userCircle = $row['circle'];
		}
		if(!$userCircle)
			 $userCircle='UND'; 
		
		//$queryF = "INSERT INTO master_db.tbl_refer_ussdData VALUES ('','".$msisdn."','".$frndMDN."',NOW(),adddate(NOW(),3),'".$serviceId."','Retailer','".$userCircle."');";

		$updateUssdMdn="update master_db.tbl_refer_ussdData set friendANI=".$frndMDN." where ANI=".$msisdn." and date(referDate)=date(now()) and friendANI='NA' and service_id=1517 order by id desc limit 1";
		mysql_query($updateUssdMdn);		
		mysql_query($sndMsgQuery1); 
		header('Freeflow: FB');
		} 
		else 
		{
			switch($serviceId)
			{			
				case '1513': 
					$response="Please enter valid mobile number."; 
				break;
			}
		}
		header('Freeflow: FB');
		header('charge: y');
		header('amount:'.$amount);
		header('Expires: -1');
		header('Response:'.$response);
		echo $response;
		$logData=$msisdn."#".$frndMDN."#".$planid."#".$serviceId."#".$reqtype."#".$circle."#".$qry."#Response:Freeflow:FB#".$response."#".$sndMsgQuery1."#".$message. "#".date("Y-m-d H:i:s")."\n";
		error_log($logData,3,$logPath);
		error_log($msisdn."#".$reqtype."#".$circle."#".date("Y-m-d H:i:s")."\n",3,$logNewPath);
	}
} 

if($reqtype=='2')
{
	header('Path=/airtelSubUnsub');
	header('Content-Type: UTF-8');
	switch($serviceId) 
	{	
		case '1515': $response="Enter 10 digit number of your friend";									
			header('Menu code:'.$response);
		break;
		case '1513': $response="Enter 10 digit number of your friend";									
			header('Menu code:'.$response);
		break;
	}
	header('Freeflow: FC');
	header('charge: y');
	header('amount:30');
	header('Expires: -1');
	echo $response;
	$logData=$msisdn."#".$serviceId."#".$reqtype."#".$circle."#".$qry."#Response:Freeflow:FC#".$response."#".date("Y-m-d H:i:s")."\n";
	error_log($logData,3,$logPath);
	if($serviceId == '1517' || $serviceId == '1514') error_log($msisdn."#".$reqtype."#".$circle."#".date("Y-m-d H:i:s")."\n",3,$logNewPath);
}
mysql_close($dbConn);	

exit;
?>   