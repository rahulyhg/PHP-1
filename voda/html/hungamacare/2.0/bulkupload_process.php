<?php
session_start();
error_reporting(1);
require_once("incs/db.php");
require_once("language.php");
//check for existing session
if(empty($_SESSION['loginId_voda']))
{
echo "<div width=\"85%\" align=\"left\" class=\"txt\">
		<div class=\"alert alert-danger\">Your session has timed out. Please login again.</div></div>";
exit;
}
else
{
$uploadeby_voda=$_SESSION['loginId_voda'];
}

if(isset($_FILES['upfile']) && !empty($_FILES['upfile']['name']))
{
						$bulklimit=$_POST['bulklimit'];
						$orgfilename=$_FILES['upfile']['name'];
						 //check for valid file content start here 
						$lines = file($_FILES['upfile']['tmp_name']);
						$isok;
						$count=0;
						foreach ($lines as $line_num => $mobno) 
						{
						$mno=trim($mobno);
						if(!empty($mno))
						{
						if(is_numeric($mno) && strlen($mno)==10) {
						$isok=1;
						$count++;
							} else {
						$isok=2;
						break;
						  }
						}
						  }
						if($isok==2)
						{
						echo "<div width=\"85%\" align=\"left\" class=\"txt\">"; ?>
						<div class="alert alert-danger"><?php echo FILEUPLOADEERROR;?></div></div>
						<?php
						exit;
						}
						//else if($count>20000)
						else if($count>$bulklimit)
						{
echo "<div width=\"85%\" align=\"left\" class=\"txt\">
<div class=\"alert alert-danger\">Please upload file of less than ".number_format($bulklimit)." numbers otherwise it will not process.</div></div>";
						exit;
						}
	 
	 //check for valid file content end here
		$newamount = "";
		$subservice=$_POST['subservice'];
		$channel=$_POST['channel'];

		if(trim($channel)=='')
		{
			$channel=$_POST['channel_dec'];
		}
		if($subservice)
		{
			$channel=$channel."-9xm";
		}			
			$serviceId=trim($_REQUEST['service_info']);
			$uploadedFor=trim($_REQUEST['upfor']);
			$channelDec=trim($_REQUEST['channel_dec']);
			$remoteAdd=trim($_SERVER['REMOTE_ADDR']);
			if(!$channelDec)
				$channelDec='NA';

		if($_REQUEST['lang']) $lang=$_REQUEST['lang'];
			else $lang="01";
			
		$planId=trim($_REQUEST['price']);
		$planData = explode("-",$planId);
		if(count($planData)==2) {
			$planId = $planData[0];
			$getAmount = $planData[1];
		}

		if(!$planId) $planId="";		
			if($uploadedFor == 'deactive') {
				$deQuery="select plan_id from master_db.tbl_plan_bank where sname=".$_REQUEST['service_info']." and S_id=".$serviceId." limit 1";
				$planIdData = mysql_query($deQuery,$dbConn);
				list($planId) = mysql_fetch_array($planIdData);
			}

			$selMaxId="select max(batch_id)+1 from vodafone_hungama.bulk_upload_history";
			$qryBatch = mysql_query($selMaxId,$dbConn);
			list($batchId) = mysql_fetch_array($qryBatch);
			
			$selAmount="select iAmount from master_db.tbl_plan_bank where plan_id=".$planId;
			$qryAmount = mysql_query($selAmount,$dbConn);
			list($getAmount) = mysql_fetch_array($qryAmount);

			$SafeFile = explode(".", $_FILES['upfile']['name']);
			
			$makFileName = str_replace(" ","_",$SafeFile[0])."_".$batchId."_".$serviceId."_".$planId."_".$getAmount."_".$channel."_".$channelDec."_".$uploadedFor.".".$SafeFile[1];

			$dbMakFileName = str_replace(" ","_",$SafeFile[0])."_".$batchId."_".$serviceId."_".$planId."_".$getAmount."_".$channel."_".$channelDec."_".$uploadedFor;
			
			$makLckFileName = str_replace(" ","_",$SafeFile[0])."_".$batchId."_".$serviceId."_".$planId."_".$getAmount."_".$channel."_".$channelDec."_".$uploadedFor.".lck";

			$uploaddir = "../bulkuploads/".$serviceId."/";
			if(!is_dir($uploaddir))
			{
				mkdir($uploaddir);
				chmod($uploaddir,0777);
			}
			$uploadlogdir = "../bulkuploads/".$serviceId."/log/";
			if(!is_dir($uploadlogdir))
			{
				mkdir($uploadlogdir);
				chmod($uploadlogdir,0777);
			}


			$path = $uploaddir.$makFileName;
			$lckpath = $uploaddir.$makLckFileName;
			
			if(move_uploaded_file($_FILES['upfile']['tmp_name'], $path))
			{
				$succCount=0;
				$failCount=0;
				$file_size=$count;
				$thisTime = date("Y-m-d H:i:s");
				$dbaccess='Voda';
				$msg = "File uploaded successfully.";
					//$fp = fopen($path, "r") or die("Couldn't open $filename");
							
						
				$Uploadquery="insert into vodafone_hungama.bulk_upload_history(batch_id, service_type, channel, price_point, file_name, added_by, added_on, upload_for,status,operator,total_file_count,service_id,ip,language) values('".$batchId."', '".$serviceType."', '".$channel."', '".$planId."', '".$dbMakFileName."', '".$uploadeby_voda."', '".$thisTime."', '".$_POST[upfor]."',0,'".$dbaccess."','".$file_size."','".$serviceId."', '".$remoteAdd."','".$lang."')";
					
				$queryIns = mysql_query($Uploadquery,$dbConn); 
					
					$fileData1=file($path);
					$sizeOfFile=count($fileData1);

					$filetowriteFp=fopen($path,'w+');
					for($k=0;$k<$sizeOfFile;$k++)
					{
					if(trim($fileData1[$k])!='')
					fwrite($filetowriteFp,trim($fileData1[$k])."#".$batchId."#".$serviceId."#".$planId."#".$getAmount."#".$channel."#".$channelDec."#".$uploadedFor."\r\n");
					}
					fclose($filetowriteFp);
					
					$lckFile=fopen($lckpath,'w+');
					fclose($lckFile);
		

				$msg = $orgfilename." has been successfully uploaded. Generated Reference ID is ".$batchId;
				echo "<div width=\"85%\" align=\"left\" class=\"txt\"><div class=\"alert alert-success\">$msg</div></div>";
				
				
			} else { 
				
                echo "<div width=\"85%\" align=\"left\" class=\"txt\">
				<div class=\"alert alert-danger\">There seem to be error in the contents of the file. Please check the file you selected for upload.</div></div>";
				}
				
			
}
	
	exit;
?>