<?php
$reqName=strtoupper($_GET['rn']);
$msisdn=trim($_GET['msisdn']);
$test=trim($_GET['test']);
$RPid=trim($_GET['RPid']);
$serviceid_HUN=($_GET['hun_sid']);
$serviceid=($_GET['mts_sid']);
$date=date("dmY H:i:s");
$tranx_id=date("YmdHis");
$logDir="/var/www/html/billing_api/log/";
$logFile=date('dmY')."_logv1";
$logFilePath=$logDir.$logFile.".txt";
$filePointer=fopen($logFilePath,'a+');

$urltopost = "http://10.130.14.40:8080//cvp/chargingServlet";
switch($reqName)
{
	case 'QB':
		$data1="<RealTimeOperationRequest xmlns='xmltypes.cs.cvp.hp.com'>";
		$data1 .="<REQUEST_NAME>QB</REQUEST_NAME>";
		$data1 .="<MSISDN>$msisdn</MSISDN>";
		$data1 .="</RealTimeOperationRequest>";
	break;
	case 'TP':
		$data1="<RealTimeOperationRequest xmlns='xmltypes.cs.cvp.hp.com'>";
		$data1.="<SERVICE_ID>$serviceid</SERVICE_ID>";
		$data1.="<ISV_ID>4</ISV_ID>";
		$data1.="<REQUEST_NAME>EventSubscription</REQUEST_NAME>"; 
		$data1.="<REQUEST_TYPE>0</REQUEST_TYPE>";  
		$data1.="<MSISDN>$msisdn</MSISDN>";    
		$data1.="<RATE_PLAN_ID>$RPid</RATE_PLAN_ID>";
		$data1.="</RealTimeOperationRequest>";	
		break;
	default:
		$data1="<RealTimeOperationRequest xmlns='xmltypes.cs.cvp.hp.com'>";
		$data1.="<SERVICE_ID>$serviceid</SERVICE_ID>";
		$data1.="<ISV_ID>4</ISV_ID>";
		$data1.="<REQUEST_NAME>EventSubscription</REQUEST_NAME>"; 
		$data1.="<REQUEST_TYPE>0</REQUEST_TYPE>";  
		$data1.="<MSISDN>$msisdn</MSISDN>";    
		$data1.="<RATE_PLAN_ID>$RPid</RATE_PLAN_ID>";
		$data1.="</RealTimeOperationRequest>";
	break;
}


$resultData=postData($urltopost,$data1);

if($test==1)
{
	echo $urltopost."?".$data1;
	echo $resultData;
	exit;
}

$start_pos=strpos($resultData,"_CODE>");
$end_pos=strpos($resultData,"</RESULT_CODE>");
$response_code=substr($resultData,$start_pos+6,$end_pos-74);



$start_pos_desc=strpos($resultData,"<RESULT_DESC>");
$end_pos_desc=strpos($resultData,"</RESULT_DESC>");
$response_Desc=substr($resultData,$start_pos_decs+107,$end_pos_desc-107);


if($reqName=='QB' && ($response_code==2001 || $response_code==5030))
{
	$start_pos_qb=strpos($resultData,"<CUSTOMER_BALANCE>");
	$end_pos_qb=strpos($resultData,"</CUSTOMER_BALANCE>");
	$response_balance=substr($resultData,$start_pos_qb+18,$end_pos_qb-195);
}

if($response_code==2001 || $response_code==5030)
	$response_str='OK';
else
	$response_str='NOK';


if($reqName=='QB' && ($response_code==2001 || $response_code==5030))
	$response_str='OK';

$response_str1=$response_str."#".$response_code."#".$response_Desc."#".$tranx_id;
	if($reqName=='QB')
	$response_str1 .="#".$response_balance;

	echo $response_str1;

	fwrite($filePointer,$reqName."|".$data1."|".$response_str1."|".date("his")."\r\n");
	fclose($filePointer);


function postData($urltopost,$data1)
{
	$ch = curl_init ($urltopost);
	curl_setopt ($ch, CURLOPT_POST, true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $data1);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$returndata = curl_exec ($ch);
	return $returndata;
	exit;
}
?>
