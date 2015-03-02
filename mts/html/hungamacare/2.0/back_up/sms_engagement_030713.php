<?php
ob_start();
session_start();
$user_id=$_SESSION['usrId'];
$PAGE_TAG='bulk';
require_once("incs/common.php");

ini_set('display_errors','0');
require_once("incs/db.php");
require_once("language.php");
require_once("base.php");
$flag=0;
$_SESSION['authid']='true';
$service_info=$_REQUEST['service_info'];
$listservices=$_SESSION["access_service"];
$services = explode(",", $listservices);

$servicelistarray=Array ('TataDoCoMoMX'=>'Tata DoCoMo - Endless Music','RIATataDoCoMo'=>'Tata DoCoMo - Miss Riya','RIAUninor'=>'Uninor - Miss Riya','UninorSU'=>'Uninor - Sports Unlimited');
$serviceIdName=Array ('TataDoCoMoMX'=>'1001','RIATataDoCoMo'=>'1009','RIAUninor'=>'1409','UninorSU'=>'1408');
		
asort($servicelistarray);

$circle_info=array('DEL'=>'Delhi','GUJ'=>'Gujarat','WBL'=>'WestBengal','BIH'=>'Bihar','RAJ'=>'Rajasthan','UPW'=>'UP WEST','MAH'=>'Maharashtra','APD'=>'Andhra Pradesh','UPE'=>'UP EAST','ASM'=>'Assam','TNU'=>'Tamil Nadu','KOL'=>'Kolkata','NES'=>'NE','CHN'=>'Chennai','ORI'=>'Orissa', 'KAR'=>'Karnataka', 'HAY'=>'Haryana','PUN'=>'Punjab','MUM'=>'Mumbai','MPD'=>'Madhya Pradesh','JNK'=>'Jammu-Kashmir','PUB'=>"Punjab",'KER'=>'Kerala','HPD'=>'Himachal Pradesh','ALL'=>'ALL');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- include all required CSS & JS File start here -->
<?php 
require_once("main-header.php");
?>
<!-- include all required CSS & JS File end here -->
<script type="text/javascript" language="javascript">
    //--------------------------AJAX  Function--------------------------------------------------------------------------------
    function ajax() 
    {
	var ajax = null;
	if (window.XMLHttpRequest) 
	{
            try {
                ajax = new XMLHttpRequest();
                //alert("mozilla");
            }
            catch(e) {}
	}
	else if (window.ActiveXObject) 
	{
            try {
		
                ajax = new ActiveXObject("Msxm12.XMLHTTP");
                //alert("IE2");
            }
            catch (e)
            {
                try{
                    ajax = new ActiveXObject("Microsoft.XMLHTTP");
                    //alert("IE");
                }
                catch (e) {}
            }
	}
	return ajax;
    }
    
    var myAjax = ajax(); 
    
    function setCategory(circle){
        var url="category.php";
        var datastring = "circle="+circle;
        var myAjax = ajax(); 
        myAjax.onreadystatechange=function() {
            if (myAjax.readyState==4 && myAjax.status==200) {
                clearTimeout(xhrTimeout); 
                document.getElementById("category").innerHTML=myAjax.responseText;
            }
        }
        var url="category.php?circle="+circle;
        myAjax.open("GET",url,true);
        myAjax.send();
        // Timeout to abort in 5 seconds
        var xhrTimeout=setTimeout("ajaxTimeout();",10000);
    }
function checkfield(type) {
	$('#loading').hide();
	document.getElementById('alert_placeholder').style.display='inline';
	var circle=document.forms[type]["circle"].value;
	var message=document.forms[type]["message"].value;
	var service_info=document.forms[type]["service_info"].value;
	if (service_info==0) {
		 bootstrap_alert.warning('<?php echo JS_NOSERVICESELECTED;?>');
		 return false;
	} else if (circle==null || circle=="") {
		bootstrap_alert.warning('<?php echo 'Please select circle';?>');
		return false;
	}
else if(type=='form-entire_active_base')
	{   var dpd1=document.forms[type]["dpd1"].value;
		if(dpd1==null || dpd1=="")
		{
		bootstrap_alert.warning('<?php echo 'Please select date';?>');
			return false;
		}
	}
	else if(type=='form-call_hang_up')
	{	var category=document.forms[type]["category"].value;
		if(category==null || category=="") 
		{
		bootstrap_alert.warning('<?php echo 'Please select category';?>');
			return false;
		}
	}
if (message==null || message=="") {
		bootstrap_alert.warning('<?php echo 'Please enter message';?>');
		return false;
	}
	
	
	
$('#loading').show();
	hideMessageBox();
	//return false;
 return true;
}

function showCharacterCount(type)
{
 var text_max = 160;
var text_length=document.forms['form-'+type]["message"].value.length;
   var text_remaining = text_max - text_length;

        $('#textarea_'+type).html(text_remaining + ' characters remaining');
}
function hideMessageBox() {
	document.getElementById('error_box').style.display='none';
	document.getElementById('alert_placeholder').style.display='none';
}

function showMessageBox() {
	document.getElementById('error_box').style.display='inline';
	document.getElementById('alert_placeholder').style.display='inline';
}
	
function setDaysOption(service) { 
	if(service == '1001'){
           document.getElementById('select_days').innerHTML = "<select name='duration' id='duration' onclick='javascript:viewUploadhistory(this.value)'><option value='2 Days'>2 Days</option><option value='3 Days'>3 Days</option><option value='4 Days'>4 Days</option><option value='7 Days'>7 Days</option><option value='8 Days'>8 Days</option><option value='11 Days'>11 Days</option><option value='15 Days'>15 Days</option><option value='16 Days'>16 Days</option><option value='19 Days'>19 Days</option><option value='25 Days'>25 Days</option><option value='27 Days'>27 Days</option><option value='29 Days'>29 Days</option></select>"; 
        }else{
           document.getElementById('select_days').innerHTML = "<select name='duration' id='duration' onclick='javascript:viewUploadhistory(this.value)'><option value='3 Days'>3 Days</option><option value='7 Days'>7 Days</option><option value='15 Days'>15 Days</option></select>";
        }
}
function setTypeOption(service) { 
	if(service == '1001'){
           document.getElementById('select_type').innerHTML = "<select name='type' id='type' onclick='javascript:viewSmsHistory(this.value)'><option value='2 Days'>2 Days</option><option value='3 Days'>3 Days</option><option value='4 Days'>4 Days</option><option value='7 Days'>7 Days</option><option value='8 Days'>8 Days</option><option value='11 Days'>11 Days</option><option value='15 Days'>15 Days</option><option value='16 Days'>16 Days</option><option value='19 Days'>19 Days</option><option value='25 Days'>25 Days</option><option value='27 Days'>27 Days</option><option value='29 Days'>29 Days</option><option value='0-10 Mous'>10 Mou's</option><option value='10-30 Mous'>10 To 30 Mou's</option><option value='>30 Mous'>> 30 Mou's</option><option value='<7 Mous:5'><7 Mou's (5th Days)</option><option value='8-15 Mous:5'>8 To 15 Mou's ( 5th Days)</option><option value='>=16 Mous:5'>>=16 Mou's (5th Days)</option><option value='<7 Mous:12'><7 Mou's (12th Days)</option><option value='8-15 Mous:12'>8 To 15 Mou's ( 12th Days)</option><option value='>=16 Mous:12'>>=16 Mou's (12th Days)</option><option value='21 Days:21'>21st Days</option><option value='1-7 Mous:25/1-8'>1-7 Mou's (25th Days and 1-8 duration)</option><option value='8-15 Mous:25/1-8'>8 To 15 Mou's (25th Days and 1-8 duration)</option><option value='>=16 Mous:25/1-8'>>=16 Mou's (25th Days and 1-8 duration)</option><option value='1-7 Mous:25/9-15'>1-7 Mou's (25th Days and 9-15 duration)</option><option value='8-15 Mous:25/9-15'>8 To 15 Mou's (25th Days and 9-15 duration)</option><option value='>=16 Mous:25/9-15'>>=16 Mou's (25th Days and 9-15 duration)</option><option value='1-7 Mous:25/>=16'>1-7 Mou's (25th Days and >=16 duration)</option><option value='8-15 Mous:25/>=16'>8 To 15 Mou's (25th Days and >=16 duration)</option><option value='>=16 Mous:25/>=16'>>=16 Mou's (25th Days and >=16 duration)</option><option value='active_base'>Active base</option></select>"; 
        }else{
           document.getElementById('select_type').innerHTML = "<select name='type' id='type' onclick='javascript:viewSmsHistory(this.value)'><option value='3 Days'>3 Days</option><option value='7 Days'>7 Days</option><option value='15 Days'>15 Days</option><option value='0-10 Mous'>10 Mou's</option><option value='10-30 Mous'>10 To 30 Mou's</option><option value='>30 Mous'>> 30 Mou's</option><option value='active_base'>Active base</option></select>";
        }
}
function setMOUDaysWise(days) { 
if(days == '5' || days == '12'){
    document.getElementById('tr_MOU_type').style.display='table-row';
    document.getElementById('tr_MOU_Duration').style.display='none';
    document.getElementById('select_MOU').innerHTML = "<select name='duration' id='duration' onclick='javascript:viewUploadhistory(this.value)'><option value='<7 Mous'><7 Mou's</option><option value='8-15 Mous'>8 To 15 Mou's</option><option value='>=16 Mous'> >=16 Mou's</option></select>";
}else if(days == '21'){
    document.getElementById('tr_MOU_type').style.display='none';
    document.getElementById('tr_MOU_Duration').style.display='none';
}else if(days == '25'){
    document.getElementById('tr_MOU_type').style.display='table-row';
    document.getElementById('tr_MOU_Duration').style.display='table-row';
    document.getElementById('select_MOU').innerHTML = "<select name='duration' id='duration' onclick='javascript:viewUploadhistory(this.value)'><option value='1-7 Mous'>1-7 Mou's</option><option value='8-15 Mous'>8 To 15 Mou's</option><option value='>=16 Mous'> >=16 Mou's</option></select>";
}else{
    document.getElementById('tr_MOU_Duration').style.display='none';
    document.getElementById('tr_MOU_type').style.display='table-row';
    document.getElementById('select_MOU').innerHTML = "<select name='duration' id='duration' onclick='javascript:viewUploadhistory(this.value)'><option value='0-10 Mous'>10 Mou's</option><option value='10-30 Mous'>10 To 30 Mou's</option><option value='>30 Mous'>> 30 Mou's</option></select>";
}

}
function setMOUOption(service) { 
	if(service == '1001'){
          document.getElementById('tr_MOU_Days').style.display='table-row';
          document.getElementById('select_MOU').innerHTML = "<select name='duration' id='duration' onclick='javascript:viewUploadhistory(this.value)'><option value='0-10 Mous'>10 Mou's</option><option value='10-30 Mous'>10 To 30 Mou's</option><option value='>30 Mous'>> 30 Mou's</option></select>"; 
        }else{
            document.getElementById('tr_MOU_Days').style.display='none';
           document.getElementById('select_MOU').innerHTML = "<select name='duration' id='duration' onclick='javascript:viewUploadhistory(this.value)'><option value='0-10 Mous'>10 Mou's</option><option value='10-30 Mous'>10 To 30 Mou's</option><option value='>30 Mous'>> 30 Mou's</option></select>";
        }
}
function resestForm(type)
{
	var formname='form-'+type;
	document.getElementById(formname).reset();
}


$(".alert").alert();
$(".alert").alert('close');

bootstrap_alert = function() {}
bootstrap_alert.warning = function(message) {
            $('#alert_placeholder').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">&times;</a><span>'+message+'</span></div>')
        }
    

</script>
	<!-- Bootstrap CSS Toolkit styles -->
<link rel="stylesheet" href="css/jquery.fileupload-ui.css">
  <!--link href="http://www.eyecon.ro/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"-->
<link href="css/datepicker.css" rel="stylesheet">
</head>

<body onload="javascript:viewUploadhistory('3 Days');setDaysOption();">

<div class="navbar navbar-inner">
	<a href="#menu-bar" class="second"><button class="btn btn-primary"><i class="icon-align-justify"></i> Menu</button></a>
</div>

<div class="container">
    <div class="row">
	<div class="page-header">
	     <h1>SMS Configuration<small>&nbsp;&nbsp;</small></h1>
	</div>
	<div class="tab-pane active" id="pills-basic">
	     <div class="tabbable">
		 <ul class="nav nav-pills">
		    <li class="active"><a href="#active" onclick="javascript:viewUploadhistory('3 Days')" data-toggle="tab" data-act="No call since activation">No call since activation</a></li>
		    <li class=""><a href="#entire_active_base" onclick="javascript:viewUploadhistory('active_base')" data-toggle="tab" data-act="Entire Active base">Entire Active base</a></li>
		    <li class=""><a href="#mou" onclick="javascript:viewUploadhistory('0-10 Mous')" data-toggle="tab" data-act="Based on MOU's">Based on MOU's</a></li>
		    <li class=""><a href="#call_hang_up" onclick="javascript:viewUploadhistory('call_hang_up')" data-toggle="tab" data-act="Call Hang up">Call Hang up</a></li>
		    <li class=""><a href="#message_view" onclick="javascript:viewUploadhistory('message_view')" data-toggle="tab" data-act="message_view">View</a></li>
		</ul>
		<div class="tab-content">
		    <div id="active" class="tab-pane active">
			<form id="form-active" name="form-active" method="post" enctype="multipart/form-data">
			      <table class="table table-bordered table-condensed">
				    <tr>
					<td align="left" width="16%" height="32"><span>Service&nbsp;</span></td>
					<td><select name="service_info" id="service_info" onchange="setDaysOption(this.value)">
								<option value="0">Select Service</option>
								<?php foreach($servicelistarray as $s_id=>$s_val) {
								if(in_array($s_id,$services)) { ?>
								<option value="<?php echo $serviceIdName[$s_id];?>"><?php echo $s_val;?></option>
								<?php }	} ?>
					    </select>
                                        </td>
                                   </tr>
                                   <tr>
					<td align="left" width="16%" height="32"><span>Type&nbsp;</span></td>
					<td><div id="select_days" name="select_days"><select name="duration" id="duration" onclick="javascript:viewUploadhistory(this.value)"></select></div>
                                        </td>
                                   </tr>
				   <tr>
					<td width="16%" height="32" align="left">Circle</td>
					<td>
					    <select name="circle" id="circle" class="in">
						<option value="">Select circle</option>
						<?php foreach($circle_info as $circle_id=>$circle_val) { ?>
					        <option value=<?php echo $circle_id?>><?php echo $circle_val;?></option>
				<?php } ?>
					    </select>
                                        </td>
				   </tr>
				   <tr>
					<td align="left" width="16%" height="32">Message</td>
					<td>
					    <textarea name="message" id="message" cols="80" rows="4" maxlength="160" onkeyup="showCharacterCount('active')"></textarea>
					    <div id="textarea_active"></div>
					    <input id="upfor" type="hidden" value="no_call_activation" name="upfor"/>
                                            <button class="btn btn-primary" style="float:right;">Submit</button>
					</td>
				   </tr>
				
			     </table>
			</form>	
		   <div id="grid-active"></div>
	    </div>
	    <div id="entire_active_base" class="tab-pane">
	         <form id="form-entire_active_base" name="form-entire_active_base" method="post">
		       <table class="table table-bordered table-condensed">
			      <tr>
				  <td align="left" width="16%" height="32"><span>Service&nbsp;</span></td>
				  <td>
                                      <select name="service_info" id="service_info">
					      <option value="0">Select Service</option>
					      <?php foreach($servicelistarray as $s_id=>$s_val) {
					            if(in_array($s_id,$services)) { if($serviceIdName[$s_id]!='1513'){?>
					      <option value="<?php echo $serviceIdName[$s_id];?>"><?php echo $s_val;?></option>
					      <?php } }	} ?>
				     </select>
				</td>
			     </tr>
			      <tr>
				 <td width="16%" height="32" align="left">Circle</td>
				 <td>
				    <select name="circle" id="circle" class="in">
					   <option value="">Select circle</option>
					   <?php foreach($circle_info as $circle_id=>$circle_val) { ?>
					   <option value=<?php echo $circle_id?>><?php echo $circle_val;?></option>
				           <?php } ?>
			       	   </select>
                                 </td>
			     </tr>
		              <tr>
				  <td width="16%" height="32" align="left">Date</td>
				  <td>
				      <input type="text" value="" name="dpd1" id="dpd1" placeholder="Click to set date">(mm/dd/yyyy)
				  </td>
			      </tr>
			      <tr>
				  <td align="left" width="16%" height="32">Message</td>
				  <td>
				       <textarea name="message" id="message" cols="80" rows="4" maxlength="160" onkeyup="showCharacterCount('entire_active_base')"></textarea>
				       <div id="textarea_entire_active_base"></div>
				       <input id="upfor" type="hidden" value="entire_active_base" name="upfor">
				       <button class="btn btn-primary" style="float:right;">Submit</button>
				  </td>
			      </tr>
		     </table>
	        </form>
	        <div id="grid-entire_active_base"></div>									
             </div>
             <div id="mou" class="tab-pane">
	          <form id="form-mou" name="form-mou" method="post">
		       <table class="table table-bordered table-condensed">
			     <tr>
				 <td align="left" width="16%" height="32"><span>Service&nbsp;</span></td>
				  <td>
                                      <select name="service_info" id="service_info" onchange="setMOUOption(this.value)">
					     <option value="0">Select Service</option>
					     <?php foreach($servicelistarray as $s_id=>$s_val) {
					     if(in_array($s_id,$services)) { if($serviceIdName[$s_id]!='1513'){?>
					     <option value="<?php echo $serviceIdName[$s_id];?>"><?php echo $s_val;?></option>
					     <?php } }	} ?>
				      </select>
<!--			              <input name="duration" type="radio" id="duration" value="0-10 Mous" checked onclick="javascript:viewUploadhistory('0-10 Mous')">&nbsp;<span class="label label-important"> &lt; 10 Mou's</span>&nbsp;&nbsp;&nbsp;<input name="duration" type="radio" id="duration" value="10-30 Mous" onclick="javascript:viewUploadhistory('10-30 Mous')">&nbsp;<span class="label label-info">10 To 30 Mou's</span>&nbsp;&nbsp;&nbsp;
			              <input name="duration" type="radio" id="duration" value=">30 Mous" onclick="javascript:viewUploadhistory('>30 Mous')">&nbsp;<span class="label label-success">&gt; 30 Mou's</span>-->
				  </td>
			     </tr>
                               <tr id="tr_MOU_Days" name="tr_MOU_Days" style="display: none;">
				 <td align="left" width="16%" height="32"><span>Days&nbsp;</span></td>
				  <td>
                                      <select name="Days" id="Days" onchange="setMOUDaysWise(this.value)">
                                             <option value="others">Others</option>
					     <option value="5">5th Days</option>
                                             <option value="12">12th Days</option>
                                             <option value="21">21st Days</option>
                                             <option value="25">25th Days</option>
                                             
				      </select>
				  </td>
			     </tr>
                           <tr id="tr_MOU_Duration" name="tr_MOU_Duration" style="display: none;">
				 <td align="left" width="16%" height="32"><span>Duration&nbsp;</span></td>
				  <td>
                                      <select name="duration_date" id="duration_date">
                                             <option value="1-8">1-8 Days</option>
                                             <option value="9-15">9-15 Days</option>
                                             <option value=">=16">>=16 Days</option>
                                      </select>
				  </td>
			     </tr>
                              <tr id="tr_MOU_type" name="tr_MOU_type">
					<td align="left" width="16%" height="32"><span>Type&nbsp;</span></td>
					<td><div id="select_MOU" name="select_MOU"><select name="duration" id="duration" onclick="javascript:viewUploadhistory(this.value)"></select></div>
                                        </td>
                             </tr>
			     <tr>
				<td width="16%" height="32" align="left">Circle</td>
				<td>
				    <select name="circle" id="circle" class="in">
					  <option value="">Select circle</option>
					  <?php foreach($circle_info as $circle_id=>$circle_val) { ?>
					  <option value=<?php echo $circle_id?>><?php echo $circle_val;?></option>
				          <?php } ?>
				    </select>
                                </td>
			    </tr>
			    <tr>
				<td align="left" width="16%" height="32">Message</td>
				<td>
				   <textarea name="message" id="message" cols="80" rows="4" maxlength="160" onkeyup="showCharacterCount('mou')"></textarea>
				   <div id="textarea_mou"></div>
				   <input id="upfor" type="hidden" value="mou" name="upfor">
				   <button class="btn btn-primary" style="float:right;">Submit</button>
				</td>
			    </tr>
	       	     </table>
	       </form>
	       <div id="grid-mou"></div>									
         </div>
	 <div id="call_hang_up" class="tab-pane">
	    <form id="form-call_hang_up" name="form-call_hang_up" method="post">
		<table class="table table-bordered table-condensed">
		     <tr>
			<td align="left" width="16%" height="32"><span>Service&nbsp;</span></td>
			<td>
                            <select name="service_info" id="service_info">
				<option value="0">Select Service</option>
				<?php foreach($servicelistarray as $s_id=>$s_val) {
				if(in_array($s_id,$services)) { if($serviceIdName[$s_id]!='1513'){ ?>
				<option value="<?php echo $serviceIdName[$s_id];?>"><?php echo $s_val;?></option>
				<?php } }	} ?>
			    </select>
		      </td>
		    </tr>
		    <tr>
			<td width="16%" height="32" align="left">Circle</td>
			<td>
			   <select name="circle" id="circle" class="in" onchange="setCategory(this.value);">
				<option value="">Select circle</option>
				<?php foreach($circle_info as $circle_id=>$circle_val) { ?>
				<option value=<?php echo $circle_id?>><?php echo $circle_val;?></option>
				<?php } ?>
			  </select></td>
		   </tr>
		   <tr>
		       <td width="16%" height="32" align="left">Category</td>
		       <td>
			   <select name="category" id="category" class="in">
				 <option value="">Select category</option>
<!--						<option value='Category 1'>Category 1</option>
						<option value='Category 2'>Category 2</option>
						<option value='Category 3'>Category 3</option>
						<option value='Category 4'>Category 4</option>
						<option value='Category 5'>Category 5</option>-->
			   </select>
                       </td>
		    </tr>
		    <tr>
			<td align="left" width="16%" height="32">Message</td>
			<td>
			   <textarea name="message" id="message" cols="80" rows="4" maxlength="160" onkeyup="showCharacterCount('call_hang_up')"></textarea>
			   <div id="textarea_call_hang_up"></div>
			   <input id="upfor" type="hidden" value="call_hang_up" name="upfor">
			   <button class="btn btn-primary" style="float:right;">Submit</button>
			</td>
		    </tr>
	    </table>
	</form>
	<div id="grid-call_hang_up"></div>									
      </div>
      <div id="message_view" class="tab-pane">
	  <form id="form-message_view" name="form-message_view" method="post">
		<table class="table table-bordered table-condensed">
		     <tr>
			<td align="left" width="16%" height="32"><span>Service&nbsp;</span></td>
			<td>
                            <select name="service_info" id="service_info" onchange="setTypeOption(this.value)">
				<option value="0">Select Service</option>
				<?php foreach($servicelistarray as $s_id=>$s_val) {
				if(in_array($s_id,$services)) { ?>
				<option value="<?php echo $serviceIdName[$s_id];?>"><?php echo $s_val;?></option>
				<?php }	} ?>
			   </select>
			</td>
		     </tr>
		     <tr>
			<td>Type</td>
			<td>
                           <div id="select_type" name="select_type"><select name="type" id="type" onclick="javascript:viewSmsHistory(this.value)"></select></div>
<!--			<input name="type" type="radio" id="type" value="3 Days" checked onclick="javascript:viewSmsHistory('3 Days')">&nbsp;<span class="label label-important">3 Days</span>&nbsp;&nbsp;&nbsp;<input name="type" type="radio" id="type" value="7 Days" onclick="javascript:viewSmsHistory('7 Days')">&nbsp;<span class="label label-info">7 Days</span>&nbsp;&nbsp;&nbsp;
			<input name="type" type="radio" id="type" value="15 Days" onclick="javascript:viewSmsHistory('15 Days')">&nbsp;<span class="label label-success">15 Days</span>
			<input name="type" type="radio" id="type" value="2 Days" onclick="javascript:viewSmsHistory('2 Days')">&nbsp;<span class="label label-success">2 Days</span>
                        <input name="type" type="radio" id="type" value="4 Days" onclick="javascript:viewSmsHistory('4 Days')">&nbsp;<span class="label label-success">4 Days</span>
                        <input name="type" type="radio" id="type" value="6 Days" onclick="javascript:viewSmsHistory('6 Days')">&nbsp;<span class="label label-success">6 Days</span>
			<input name="type" type="radio" id="type" value="0-10 Mous" checked onclick="javascript:viewSmsHistory('0-10 Mous')">&nbsp;<span class="label label-important"> &lt; 10 Mou's</span>&nbsp;&nbsp;&nbsp;<input name="type" type="radio" id="type" value="10-30 Mous" onclick="javascript:viewSmsHistory('10-30 Mous')">&nbsp;<span class="label label-info">10 To 30 Mou's</span>&nbsp;&nbsp;&nbsp;
			<input name="type" type="radio" id="type" value=">30 Mous" onclick="javascript:viewSmsHistory('>30 Mous')">&nbsp;<span class="label label-success">&gt; 30 Mou's</span>
			<input name="type" type="radio" id="type" value="active_base" checked onclick="javascript:viewSmsHistory('active_base')">&nbsp;<span class="label label-important">Active base</span>&nbsp;&nbsp;&nbsp;<input name="type" type="radio" id="type" value="call_hang_up" onclick="javascript:viewSmsHistory('call_hang_up')">&nbsp;<span class="label label-info">Call hang up</span>&nbsp;&nbsp;&nbsp;
			-->
			</td>
		    </tr>
	     </table>
	 </form>
	<div id="grid-message_view"></div>									
    </div>
   </div><!-- /.tab-content -->
  </div><!-- /.tabbable -->
 </div>

	<!--div class="well well-small"><?php echo FILE_UPLOAD_MESSAGE;?></div-->
  <div class="alert alert-danger" style='display:none' id="error_box"></div>
  <div id = "alert_placeholder"></div>
  <div id="loading"><img src="assets/img/loading-circle-48x48.gif" border="0" /></div> 
  <div id="grid-view_upload_history"></div> 

</div>
</div>
<!-- Footer section start here-->
  <?php
 require_once("footer.php");
  ?>
<!-- Footer section end here-->
  <script src="assets/js/jquery.pageslide.js"></script>
  <script>
  
$('#loading').hide();
	$('#grid-active').hide();
	$('#grid-active').html('');
        
	function viewUploadhistory(a) {
		document.getElementById('alert_placeholder').style.display='none';
		$('#grid-view_upload_history').hide();
		$('#grid-view_upload_history').html('');
		$('#loading').show();
		$.fn.GetUploadHistory(a);
		//$('#loading').hide();
       	};
	
		function viewSmsHistory(a) {
		var service_info=document.forms['form-message_view']["service_info"].value;
		if(service_info==0)
		{
		$('#grid-view_upload_history').hide();
		$('#grid-view_upload_history').html('');
		document.getElementById('alert_placeholder').style.display='inline';
		bootstrap_alert.warning('<?php echo 'Please select service.';?>');
		return false;
		}
		else
		{
		document.getElementById('alert_placeholder').style.display='none';
		$('#grid-view_upload_history').hide();
		$('#grid-view_upload_history').html('');
		$('#loading').show();		
		$.fn.GetSMSHistory(a,service_info);
		//$('#loading').hide();
		}
       	};
		
$.fn.GetUploadHistory = function(type) {
$('#loading').show();
		$.ajax({
	     
						url: 'viewsms_engagement_history.php',
					    data: 'type='+type,
						//data: $('#form-'+act).serialize() + '&action=del&username=<?php echo $username;?>',
						type: 'get',
						cache: false,
						dataType: 'html',
						success: function (abc) {
							$('#grid-view_upload_history').html(abc);
     						$('#loading').hide();
						}
						
					});
						
					$('#grid-view_upload_history').show();
	
};

$.fn.GetSMSHistory = function(type,service_info) {
$('#loading').show();
		$.ajax({
						url: 'sms_engagement_process_history.php',
					    data: 'type='+type+'&service_info='+service_info,
						type: 'get',
						cache: false,
						dataType: 'html',
						success: function (abc) {
							$('#grid-view_upload_history').html(abc);
     						$('#loading').hide();
						}
						
					});
						
					$('#grid-view_upload_history').show();
	
};

$("form#form-active").submit(function(){ 
var isok = checkfield('form-active');
if(isok)
{
document.getElementById('alert_placeholder').style.display='none';
 $('#loading').show();
	var formData = new FormData($("form#form-active")[0]);
    $.ajax({
        url: 'bulkupload_process_sms_engagement.php',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
   	document.getElementById('grid-active').style.display='inline';
	document.getElementById('grid-active').innerHTML=data;
	resestForm('active');    
	viewUploadhistory('3 Days');
	        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
	}
	else
	{
	return false;
	}
});

$("form#form-entire_active_base").submit(function(){ 
var isok = checkfield('form-entire_active_base');
if(isok)
{
document.getElementById('alert_placeholder').style.display='none';
 $('#loading').show();
	var formData = new FormData($("form#form-entire_active_base")[0]);
    $.ajax({
        url: 'bulkupload_process_sms_engagement.php',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
   	document.getElementById('grid-entire_active_base').style.display='inline';
	document.getElementById('grid-entire_active_base').innerHTML=data;
	resestForm('entire_active_base');  
	viewUploadhistory('active_base');
	        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
	}
	else
	{
	return false;
	}
});
$("form#form-mou").submit(function(){ 
var isok = checkfield('form-mou');
if(isok)
{
document.getElementById('alert_placeholder').style.display='none';
 $('#loading').show();
	var formData = new FormData($("form#form-mou")[0]);
    $.ajax({
        url: 'bulkupload_process_sms_engagement.php',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
   	document.getElementById('grid-mou').style.display='inline';
	document.getElementById('grid-mou').innerHTML=data;
	resestForm('mou');   
	viewUploadhistory('0-10 Mous');
	        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
	}
	else
	{
	return false;
	}
});
$("form#form-call_hang_up").submit(function(){ 
var isok = checkfield('form-call_hang_up');
if(isok)
{
document.getElementById('alert_placeholder').style.display='none';
 $('#loading').show();
	var formData = new FormData($("form#form-call_hang_up")[0]);
    $.ajax({
        url: 'bulkupload_process_sms_engagement.php',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
   	document.getElementById('grid-call_hang_up').style.display='inline';
	document.getElementById('grid-call_hang_up').innerHTML=data;
	resestForm('call_hang_up');
	viewUploadhistory('call_hang_up');
	        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
	}
	else
	{
	return false;
	}
});
$(".second").pageslide({ direction: "right", modal: true });
</script>
	<script>
		$(function(){
			window.prettyPrint && prettyPrint();
			$('#dp1').datepicker({
				format: 'mm-dd-yyyy'
			});
		
			var startDate = new Date(2012,1,20);
			var endDate = new Date(2012,1,25);
		    // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1').datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          }).data('datepicker');
 	});
	</script>
    <script src="js/bootstrap-datepicker.js"></script>

<!-- added for file uplaod using bootstarp api-->
</body>
</html>