<?php
include("session.php");
error_reporting(0);
//include database connection file
include("db.php");
$today=date("Y-m-d");
$displaydate;
$errorcode=array('unknown','busy','far_end_disconnect','error.connection.nor','noanswer');
$rand_keys = array_rand($errorcode, 2);
/*
if($_POST['action'] == 1) {
	$StartDate = date("Y-m-d",strtotime($_POST['obd_form_startdate']));
		$displaydate=$StartDate;
		
$sql_getmsisdnlist = mysql_query("select a.ANI as ANI,date(a.date_time) as date_time,a.DNIS as DNIS,a.circle as circle,a.operator as operator, b.customer_name as customer_name,b.town as town,b.verification_done as verification_done,b.memebership_card_dp as memebership_card_dp,b.memebership_card_rv as memebership_card_rv,c.amount as amount from newseleb_hungama.tbl_max_bupa_details as a LEFT JOIN newseleb_hungama.msdn_info as b ON  a.ANI=b.mobile_no LEFT JOIN newseleb_hungama.tbl_mnd_recharge as c
     ON a.ANI = c.mdn  WHERE  date(a.date_time) = '$StartDate'");

	}
	else
	{
	$sql_getmsisdnlist = mysql_query("select a.ANI as ANI,date(a.date_time) as date_time,a.DNIS as DNIS,a.circle as circle,a.operator as operator, b.customer_name as customer_name,b.town as town,b.verification_done as verification_done,b.memebership_card_dp as memebership_card_dp,b.memebership_card_rv as memebership_card_rv,c.amount as amount from newseleb_hungama.tbl_max_bupa_details as a LEFT JOIN newseleb_hungama.msdn_info as b ON  a.ANI=b.mobile_no LEFT JOIN newseleb_hungama.tbl_mnd_recharge as c
     ON a.ANI = c.mdn  WHERE  date(a.date_time) = '$today'");	
$displaydate=$today;
 }  
 */
 

 $sql_getmsisdnlist = mysql_query("select * from hul_hungama.tbl_hul_subdetails limit 970");
 
 
	$totalrecord=mysql_num_rows($sql_getmsisdnlist);
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin</title>
	<!--meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /-->
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script language="javascript" type="text/javascript" src="datetimepicker/datetimepicker.js"></script>
	
	<!--style media="all" type="text/css">@import "popup/css/styles.css";</style-->
	<STYLE>
 .ttip {border:1px solid black;font-size:12px;layer-background-color:lightyellow;background-color:lightyellow;width:200px;height:100px}
</STYLE>
<script>
//Set the tool tip message you want for each link here.
     var tip=new Array
       tip[0]="OBD Duration- 40 sec <br>OBD Text-<br> Helloooo Vannakam , I hope this Diwali - Good life Club gave you a new experience. As usual I am ur Aishwarya , now let us see the spls of this Entertainer masti pack ka. MUSIC means automatically Raja Sir will come into your mind, exactly one & only Maestro Illayaraja from his beautiful collections we brings you the top most best of best. I knew ur heart is awaiting to listen to his beautiful romantic spray	< Illayaraja Song Play > . So give me miss call 8512054646 & Listen to your one and only Maestro Collections....."
       tip[1]="OBD Duration- 53 sec <br>OBD Text-<br>Let us travel for long journey ! Journey 1 - 1980's < Song Play >, Journey 2	- 1990's < Song Play >; Final Journey its our generation 21st centaury < Song Play>..In our life also if we have a rewind button it will awesome , whether it will come or not no one knows. But our Good Life Club Aishwarya brings you the A Journey of Retro to New, then what for you waiting give me a miss call to '8512054646'."
	    tip[2]="OBD Duration- 35 sec <br>OBD Text-<br>Good Life Club proudly presents the Biography of Popular Celebrities , presented by your Aishwarya < Rajnikanth Biography Play abt Career, childhood etc >...So wanna to listen the more celebrities ka history. As I say always give me miss call '8512054646', know your one & only stars ka life journey."
           tip[3]="OBD Duration- 38 sec <br>OBD Text-<br>One New Arrival Song < New Song >, One Beautiful Romantic song < Love Song> then obviously  Old is Gold < Retro Song >,,,,No were you can listen a mixture of new to oldies in a single slot, good life club exclusively brings you this collection. I am your Aishwarya, so now you know what you have to do. Any how let me brief u give me a miss call '8512054646'..So enjoy the non-stop collections...."
           tip[4]="OBD Duration- 55 sec <br>OBD Text-<br>To start this day with most beautiful things Good life Club wishes you, I am ur Aishwarya let us see the topic of the day , funny things plays a important role in our day today life . < Goundamani/ Santhanam Comedy Clips > all time favourite comedians best of best comedies exclusively for you. So give me a Miss call '8512054646'. Start your day with a big smile."
                tip[5]="OBD Duration- 33 sec <br>OBD Text-<br>Hi Hi Hi !!! I knew what you might be thinking , why Aishwarya is more excited today.. Yaah I am going to enjoy your favourite stars ka Movie dialogues along with you < Movie Dialogue > So now you more eagerly awaiting to listen more stars ka Dialogues right. Just give me a miss call to '8512054646' & enjoy maadi."
          tip[6]="OBD Duration- 30 sec <br>OBD Text-<br>< Song Play > This song will be in your heart playlist 4 ever like this Good life club brings you the Evergreen Spls I am your Aishwarya now you know what you have to do , give me miss call ' 8512054646'. Sure this Everlasting songs will stays in your heart forever."
          tip[7]="OBD Duration- 29 sec <br>OBD Text-<br>Our South indian Heroine Vidya Balan going to get married soon with a popular business man...Yeh is that true ? Yah re also there marriage going to be in Tamilian culture. Aishwarya from Good life club brings you the more interesting info's give me miss call '8512054646' . Check out your favourite star ka update."
       
	      tip[8]="OBD Duration- 47 sec <br>OBD Text-<br>In Kollywood shooting spot many interesting things happening daily from that let us see some interesting news, Our Super Star Rajnikanth Kochadayan its almost in finish stage, after this project he decided to act in Maniratnam banner after long gap both will re-joining. So Mani is more involved in creating innovative script for rajni, bcz its should be next block buster movie like Dalapathi. So we all have good treat from Mani and Super star soon, < Dalapathi Song >. So wanna listen to now and then happening interesting news. Give me a call '8512054646', then turn your ears to listen some interesting news of Kollywood."
		  
          tip[9]="OBD Duration- 45 sec <br>OBD Text-<br>First Cum first, I knew you thinking what will be that New, Whatever Good life club releases it will be new only from that you are going to see New Arrivals of Kollywood. NEW means always something interesting < New Arrival Song >. Tamil Movie Industry ka world Famous star Kamal Hassan much expected movie VISHWAROOPAM ka Audio launch reveal soon. To know more about the shooting spot news get in touch with me Aishwarya from Good life club. Give me miss call '8512054646' Listen to the rocking songs."
		  
   tip[10]="OBD Duration- 32 sec <br>OBD Text-<br>Come on ! Come on ! I can see your excitement in knowing the topic of the day , lets see . Aishwarya from Good life club brings you the STAR PAGE < Star Trivia >. Like this if you woud like to see your own star ka profile give me miss call '8512054646'."
       tip[11]="OBD Duration- 21 sec <br>OBD Text-<br>Cinema Cinema Cinema Kamal Ka Vishwaroopam movie he has introduced a new technology in indian cinema screens 'AURA 3D'. What you mean by that , so wanna to know more about the news give me miss call '8512054646' . For you exclusively Good life club Aishwarya directly we brings you the Kollywood News."
	    tip[12]="OBD Duration- 29 sec <br>OBD Text-<br>Gossips are more interesting info to know, so lets see who's gossips for the day from your Good life Club. Vijay ka Thuppakai movie has been viewed twice in screen by Superstar, y he has seen the movie twice ? So want to know more about that then give me miss call '8512054646'. Know more about the in & out facts from your Aishwarya."
		
		tip[13]="OBD Duration- 28 sec <br>OBD Text-<br>Our South Indian star, Vidya Balan, married a business tycoon... Really..!!! Do you know who he is? Do you know how many stars were invited to her wedding..? Your Good Life Club has all this information.. Give a missed call to Me, Aishwarya on 8512054646. Stay updated with all the happenings in Kollywood"
           tip[14]="OBD Duration- 38 sec <br>OBD Text-<br>Stop saying about a thIng always in only one angle , if u say dat in different modulation how will it sound ? With a new style we brings you some info with our Bosskey, wanna to know whats that ? Now listen < Bosskey Pettai> . Good life club presents you the Movie review with a teasing mode. To listen non-stop , just give a miss call to Aishwarya 8512054646."
   tip[15]="OBD Duration- 20 sec <br>OBD Text-<br>Did you know, a popular heroine dubbed for Shreya in Super star Rajnikant's film Sivaji.. You don't know? Dont worry I know her... And i have many such trivia's waiting for you... Catch me Aishwarya by just giving a missed call on 8512054646"
           tip[16]="OBD Duration- 28 sec <br>OBD Text-<br>Hello and Good Day! This is your very own Aishwayra bringing something special today... I wish to spice up your life with some latest foot taping music that will surely make you crazy for more!!! Join me now!!! Simply give a missed call on 8512054646"
           tip[17]="OBD Duration- 31 sec <br>OBD Text-<br>(Laughing) hello!! Sorry I really can't stop myself.. Sometimes these silly comedy lines can make you laugh for hours... Such silly and funny moments make our mood lighter... and this is what i have for  you today! Give a missed call on 8512054646 right away"
          tip[18]="OBD Duration- 37 sec <br>OBD Text-<br>(Excited) hey you know what..? I have a mixed bag ready for you day... Get all what you need... Gossip, Trivia, Movie Clips, Funny one liners, and a lot more music...  From Latest to legendary we have it all.. So my dear friend, i am waiting for your missed call"
        tip[19]="OBD Duration- 46 sec <br>OBD Text-<br>Hi! This is Aishwarya yet again! And this time I promise to get you something special.... I'll be sharing some classic dialogues of your favourite stars.. (Movie dialogue)... sounds exciting right? Then give a missed call on 8512054646 now"
          tip[20]="OBD Duration- 28 sec <br>OBD Text-<br>Generation will change but everlasting classic songs will never erased Good life club exclusively presents you Carnatic master Smt. MS Subbulakshmi collections, She was the first musician ever to be awarded the Bharat Ratna < Song Play >. To continue with more collections of MSS , just give a miss call to Aishwarya 8512054646."
       tip[21]="OBD Duration- 45 sec <br>OBD Text-<br>Having a lazy day..? So am I... Let's listen to something interesting then... (Bigraphy of a tamil star) This is really interesting... Let us witness the success story of our favourite stars... Join me Aishwarya through your phone.. I am waiting for your missed call on 8512054646"
       
	   tip[22]="OBD Duration- 35 sec <br>OBD Text- <br>Hey Aishwarya here... Trust me friends, A R Rahman is the God of music composition!!! His music can do wonders and make a movie hit! Join me with the beautiful music collection of A R Rahman today!!! Give a missed call on 8512054646. Hurry!!!"
//HUL_OBD_NEWYEAR 
	   tip[23]="OBD Duration- 1.11 sec <br>OBD Text- <br>Ahgaya! Ahgaya! New Year Ahgaya! , this 2013 brings you the happiness & prosperity wishes from Aishwarya and Good life club. We should always remember the old memories ,we are going to present you the best treasurer . Lets See ! 2012-ka best Song < Song >; 2012-ka best Movie < Movie >; 2012-ka best Punch < Punch >; 2012 ka best Comedy < Comedy >. This is not and end, we have lot more to reveal from you good life . Wanna to enjoy this day with us , then give me a miss call '8512054646'."
//HUL_OBD_PONGAL	 
	 tip[24]="OBD Duration- 12 sec <br>OBD Text- <br>Hi This is Vikram."
//HUL_OBD_RAJNI
	  tip[25]="OBD Duration- 50 sec <br>OBD Text- <br>In stylish acting he created a separate boundary all alone; he got introduced in Aboorva Raagangal, so from the age of 6 - 60 every people knows him , his punch dialogues and the style of mouthing dialogues that eventually brought him the name - Super Star. So he stood different from other actors , he is the only Star of South india that's our Super Star Rajnikanth. His birthday ahgaya , lets enjoy his birthday with his stylish songs, stylish punch dialogues & lots more to come from your one & only Ashiwarya from Good life club. So give me a miss call '8512054646', listen to Journey of super star & let us celebrate this birthday along with him."
	   
       
     function showtip(current,e,num)
        {
         if (document.layers) // Netscape 4.0+
            {
             theString="<DIV CLASS='ttip'>"+tip[num]+"</DIV>"
             document.tooltip.document.write(theString)
             document.tooltip.document.close()
             document.tooltip.left=e.pageX+14+'px'
             document.tooltip.top=e.pageY+2+'px'
             document.tooltip.visibility="show"
            }
         else
           {
            if(document.getElementById) // Netscape 6.0+ and Internet Explorer 5.0+
              {
               elm=document.getElementById("tooltip")
               elml=current
               elm.innerHTML=tip[num]
               elm.style.height=elml.style.height
               elm.style.top=parseInt(elml.offsetTop+elml.offsetHeight)+'px'
               elm.style.left=parseInt(elml.offsetLeft+elml.offsetWidth+10)+'px'
               elm.style.visibility = "visible"
              }
           }
        }
function hidetip(){
if (document.layers) // Netscape 4.0+
   {
    document.tooltip.visibility="hidden"
   }
else
  {
   if(document.getElementById) // Netscape 6.0+ and Internet Explorer 5.0+
     {
      elm.style.visibility="hidden"
     }
  } 
}
</script>
	<script type="text/javascript">
	function openWindow(str)
{
   window.open("view_mndobd_details.php?msisdn="+str,"mywindow","menubar=0,resizable=1,width=650, height=500,scrollbars=yes");
}
	</script>
	 <style type='text/css'>
          .long { background:yellow; }
		
		table.listing_new {
	border-bottom:1px solid #9097A9;
	width:613px;
	padding:0;
	margin:0;
	border:1px solid #9097A9;
	}
	table.listing_new td,
table.listing_new th {
	border:1px solid #fff;
	text-align:center;
	}	
table.listing_new th {
	background:#9097A9;
	color:#fff;
	padding:5px;
	}
table.listing_new td {
	<!--background:#D8D8D8;-->
	color:#000;
	padding:3px 5px;
	}
  </style>
  <script type="text/javascript">
function cgcolor(ani)
{
document.getElementById(ani).style.backgroundColor="yellow";
}
</script>
<!--added for new table fixed column start here-->
<link href="master/Fixed-Header-Table-master/demo/css/960.css" rel="stylesheet" media="screen" />
        <link href="master/Fixed-Header-Table-master/css/defaultTheme.css" rel="stylesheet" media="screen" />
        <link href="master/Fixed-Header-Table-master/demo/css/myTheme.css" rel="stylesheet" media="screen" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <script src="master/Fixed-Header-Table-master/jquery.fixedheadertable.js"></script>
        <script src="master/Fixed-Header-Table-master/demo/demo.js"></script>
		<!--added for new table fixed column end here-->
	</head>
<body>
<div id="main">
	<div id="header">
		<a href="index.html" class="logo"><img src="img/Hlogo.png" width="282" height="80" alt=""/></a>
	</div>
	<div id="middle" >
		<div id="left-column">
		<?php include('left-sidebar.php');?>	
		</div>
		<div id="center-column1" style="width:600px">
			<div class="top-bar">
				<h1>Promotional OBD Details </h1>
				</div>
			
		  <div class="select-bar">
		  
			<b>*Description of short code using in OBD details-</b>
				<p>Content modules accessed (Yes/No) - CMA</p>
				<p>Average Time Spent On The Content (Yes/No) - ATS</p>
				<p>The details which are coming as blank are mdns of hungama and hul.</p>
				<a href="xls_listallhulpromotion.php" title="Click to download file.">
						<img src="img/download-icon.png" width="32" height="32" alt="" style="margin-top:8px"/></a>
				  <div style="float:left;padding:1px">
				
			</div>
			</div>
			
			 <div class="table" style="width:700px">
	<?php //echo 'Total no of records '.$totalrecord;?>
		
			 <div class="container_12 divider">
        
        	<div class="grid_4 height400">
        		<table class="fancyTable" id="myTable03" cellpadding="0" cellspacing="0">
        		    <thead>
        		    <tr>
        		    <th>Msisdn</th>
					<!--th>Date</th-->
					<th>Circle</th>
					<th>Operator</th>
					<th>Customer Name</th>
					<th>Town</th>
					<th>Verification</th>
					<th>Mcard_dp</th>
					<th>Mcard_rv</th>
					<th>Talk time received</th>
					<th><span class="tooltip" onMouseover="showtip(this,event,'0')" onMouseOut="hidetip()">HUL_OBD_1</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'1')" onMouseOut="hidetip()" >HUL_OBD_2</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'2')" onMouseOut="hidetip()" >HUL_OBD_3</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'3')" onMouseOut="hidetip()" >HUL_OBD_4</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'4')" onMouseOut="hidetip()" >HUL_OBD_5</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'5')" onMouseOut="hidetip()" >HUL_OBD_6</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'6')" onMouseOut="hidetip()" >HUL_OBD_7</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'7')" onMouseOut="hidetip()" >HUL_OBD_8</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'8')" onMouseOut="hidetip()" >HUL_OBD_9</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'9')" onMouseOut="hidetip()" >HUL_OBD_10</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'10')" onMouseOut="hidetip()" >HUL_OBD_11</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'11')" onMouseOut="hidetip()" >HUL_OBD_12</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'12')" onMouseOut="hidetip()" >HUL_OBD_13</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'13')" onMouseOut="hidetip()" >HUL_OBD_14</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'14')" onMouseOut="hidetip()" >HUL_OBD_15</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'15')" onMouseOut="hidetip()" >HUL_OBD_16</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'16')" onMouseOut="hidetip()" >HUL_OBD_17</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'17')" onMouseOut="hidetip()" >HUL_OBD_18</span></th>
<!--th><span class="tooltip" onMouseover="showtip(this,event,'18')" onMouseOut="hidetip()" >HUL_OBD_19</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'19')" onMouseOut="hidetip()" >HUL_OBD_20</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'20')" onMouseOut="hidetip()" >HUL_OBD_21</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'21')" onMouseOut="hidetip()" >HUL_OBD_22</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'22')" onMouseOut="hidetip()" >HUL_OBD_23</span></th-->
<th><span class="tooltip" onMouseover="showtip(this,event,'23')" onMouseOut="hidetip()" >HUL_OBD_NEWYEAR</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'24')" onMouseOut="hidetip()" >HUL_OBD_PONGAL</span></th>
<th><span class="tooltip" onMouseover="showtip(this,event,'25')" onMouseOut="hidetip()" >HUL_OBD_RAJNI</span></th>
        		        </tr>
        		    </thead>
        		     <tbody>
					 <?php

if($totalrecord>0)
{?>
	<!--tr><th colspan="36" align="left">Total no of <?= $totalrecord;?> records found of date <?=$displaydate;?>.</th></tr-->
	<?php
	$m=0;
	while($result_list = mysql_fetch_array($sql_getmsisdnlist))
				{
if(!empty($result_list['ANI']))
{

$cir = mysql_query("select master_db.getCircle('".$result_list['ANI']."') as circle");
$getcir = mysql_fetch_array($cir);

$optr = mysql_query("select master_db.getOperator('".$result_list['ANI']."') as operator");
$getoperator = mysql_fetch_array($optr);
//get customer name & other details

/*$sql_getmdndeatils = mysql_query("select b.customer_name as customer_name,b.town as town,b.verification_done as verification_done,b.memebership_card_dp as memebership_card_dp,b.memebership_card_rv as memebership_card_rv,c.amount as amount from newseleb_hungama.msdn_info as b, newseleb_hungama.tbl_mnd_recharge as c where b.mobile_no=c.mdn  and b.mobile_no='".$result_list['ANI']."'");
$result_mdn_deatils = mysql_fetch_array($sql_getmdndeatils);
*/

$sql_getmdn_user_deatils = mysql_query("select b.customer_name as customer_name,b.town as town,b.verification_done as verification_done,b.memebership_card_dp as memebership_card_dp,b.memebership_card_rv as memebership_card_rv from newseleb_hungama.msdn_info as b where b.mobile_no='".$result_list['ANI']."'");
$result_mdn_user_deatils = mysql_fetch_array($sql_getmdn_user_deatils);


$sql_getmdn_recharge_deatils = mysql_query("select c.amount as amount from newseleb_hungama.tbl_mnd_recharge as c where c.mdn='".$result_list['ANI']."'");
$result_mdn_recharge_deatils = mysql_fetch_array($sql_getmdn_recharge_deatils);


//get obd deatils here for each msisdn 
  $fileData='';
$sql_getmsisdnobdlist = mysql_query("select count(*) as totalno, odb_name as odb_name,sum(duration) as duration,duration as obd_duration,date_time as obddate,error_code as error_code from hul_hungama.tbl_hulobd_success_fail_details where ANI='".$result_list['ANI']."' and service='HUL_PROMOTION' group by odb_name");
//$sql_getmsisdnobdlist = mysql_query("select count(*) as totalno, odb_name as odb_name,sum(duration) as duration,duration as obd_duration,date_time as obddate,error_code as error_code from hul_hungama.tbl_hulobd_success_fail_details where ANI='".$result_list['ANI']."' and service='HUL_PROMOTION' and status=2 group by odb_name");

//select duration, date_time from tbl_hulobd_success_fail_details where ANI='9999130777' and odb_name='HUL_OBD_1' and status='2';
$totalobdrecord=mysql_num_rows($sql_getmsisdnobdlist);
	if($totalobdrecord>0)
{  
$i=0;
while($result_list_obd = mysql_fetch_array($sql_getmsisdnobdlist))
				{
			//	echo $result_list_obd['odb_name']."--error_code--".$result_list_obd['error_code']."<br>";
					if(!empty($result_list_obd['duration'])) { $cmy='YES';} else {$cmy='NO';}
				if(!empty($result_list_obd['totalno'])) {$cmyF=$result_list_obd['totalno'];} else { $cmyF="--";}
				if(!empty($result_list_obd['duration'])) 
{

$avgvalue=$result_list_obd['duration']/$result_list_obd['totalno'];
$avgfrq=round($avgvalue, 0, PHP_ROUND_HALF_UP);
$atsc=$avgfrq;
} else {
$atsc="--";
}
    $sql_getlastheardobdlist = mysql_query("select duration as obd_duration,date_time as obddate from hul_hungama.tbl_hulobd_success_fail_details where ANI='".$result_list['ANI']."' and odb_name='".$result_list_obd['odb_name']."' and service='HUL_PROMOTION' and status IN(1,2) order by date_time desc limit 1");
	$result_list_obd_dur = mysql_fetch_array($sql_getlastheardobdlist);
	
        $fileData[$i]['odb_name'] = $result_list_obd['odb_name'];
		$fileData[$i]['cmy'] = $cmy;
		$fileData[$i]['cmyF'] = $cmyF;
		$fileData[$i]['atsc'] = $atsc;
		$fileData[$i]['obd_duration'] = $result_list_obd_dur['obd_duration'];
		$fileData[$i]['obddate'] = $result_list_obd_dur['obddate'];
		$fileData[$i]['error_code'] = $result_list_obd['error_code'];
		$i++;
}

}

$obd1=array();$obd2=array();$obd3=array();$obd4=array();$obd5=array();$obd6=array();$obd7=array();$obd8=array();$obd9=array();$obd10=array();
$obd11=array();$obd12=array();$obd13=array();$obd14=array();$obd15=array();$obd16=array();$obd17=array();$obd18=array();$obd19=array();$obd20=array();
$obd21=array();$obd22=array();$obd23=array();$HUL_OBD_NEWYEAR	=array();$HUL_OBD_PONGAL=array();$HUL_OBD_RAJNI=array();
foreach($fileData as $key=>$value) 
{
	switch($value['odb_name'])
{
	case 'HUL_OBD_1':
		$obd1[0] = $value['odb_name'];
		$obd1[1]=$value['cmy'];
		$obd1[2]=$value['cmyF'];
		$obd1[3]=$value['atsc'];
		$obd1[4]=$value['obd_duration'];
		$obd1[5]=$value['obddate'];
		$obd1[6]=$value['error_code'];
		break;
	case 'HUL_OBD_2':
		$obd2[0] = $value['odb_name'];
		$obd2[1]=$value['cmy'];
		$obd2[2]=$value['cmyF'];
		$obd2[3]=$value['atsc'];
		$obd2[4]=$value['obd_duration'];
		$obd2[5]=$value['obddate'];
		$obd2[6]=$value['error_code'];
		break;
		case 'HUL_OBD_3':
		$obd3[0] = $value['odb_name'];
		$obd3[1]=$value['cmy'];
		$obd3[2]=$value['cmyF'];
		$obd3[3]=$value['atsc'];
		$obd3[4]=$value['obd_duration'];
		$obd3[5]=$value['obddate'];
		$obd3[6]=$value['error_code'];
		break;
		case 'HUL_OBD_4':
		$obd4[0] = $value['odb_name'];
		$obd4[1]=$value['cmy'];
		$obd4[2]=$value['cmyF'];
		$obd4[3]=$value['atsc'];
		$obd4[4]=$value['obd_duration'];
		$obd4[5]=$value['obddate'];
		$obd4[6]=$value['error_code'];
		break;
		case 'HUL_OBD_5':
		$obd5[0] = $value['odb_name'];
		$obd5[1]=$value['cmy'];
		$obd5[2]=$value['cmyF'];
		$obd5[3]=$value['atsc'];
		$obd5[4]=$value['obd_duration'];
		$obd5[5]=$value['obddate'];
		$obd5[6]=$value['error_code'];
		break;
		case 'HUL_OBD_6':
		$obd6[0] = $value['odb_name'];
		$obd6[1]=$value['cmy'];
		$obd6[2]=$value['cmyF'];
		$obd6[3]=$value['atsc'];
		$obd6[4]=$value['obd_duration'];
		$obd6[5]=$value['obddate'];
		$obd6[6]=$value['error_code'];
		break;
		case 'HUL_OBD_7':
		$obd7[0] = $value['odb_name'];
		$obd7[1]=$value['cmy'];
		$obd7[2]=$value['cmyF'];
		$obd7[3]=$value['atsc'];
		$obd7[4]=$value['obd_duration'];
		$obd7[5]=$value['obddate'];
		$obd7[6]=$value['error_code'];
		break;
		case 'HUL_OBD_8':
		$obd8[0] = $value['odb_name'];
		$obd8[1]=$value['cmy'];
		$obd8[2]=$value['cmyF'];
		$obd8[3]=$value['atsc'];
		$obd8[4]=$value['obd_duration'];
		$obd8[5]=$value['obddate'];
		$obd8[6]=$value['error_code'];
		break;
		case 'HUL_OBD_9':
		$obd9[0] = $value['odb_name'];
		$obd9[1]=$value['cmy'];
		$obd9[2]=$value['cmyF'];
		$obd9[3]=$value['atsc'];
		$obd9[4]=$value['obd_duration'];
		$obd9[5]=$value['obddate'];
		$obd9[6]=$value['error_code'];
		break;
		case 'HUL_OBD_10':
		$obd10[0] = $value['odb_name'];
		$obd10[1]=$value['cmy'];
		$obd10[2]=$value['cmyF'];
		$obd10[3]=$value['atsc'];
		$obd10[4]=$value['obd_duration'];
		$obd10[5]=$value['obddate'];
		$obd10[6]=$value['error_code'];
		break;
		case 'HUL_OBD_11':
		$obd11[0] = $value['odb_name'];
		$obd11[1]=$value['cmy'];
		$obd11[2]=$value['cmyF'];
		$obd11[3]=$value['atsc'];
		$obd11[4]=$value['obd_duration'];
		$obd11[5]=$value['obddate'];
		$obd11[6]=$value['error_code'];
		break;
		case 'HUL_OBD_12':
		$obd12[0] = $value['odb_name'];
		$obd12[1]=$value['cmy'];
		$obd12[2]=$value['cmyF'];
		$obd12[3]=$value['atsc'];
		$obd12[4]=$value['obd_duration'];
		$obd12[5]=$value['obddate'];
		$obd12[6]=$value['error_code'];
		break;
		case 'HUL_OBD_13':
		$obd13[0] = $value['odb_name'];
		$obd13[1]=$value['cmy'];
		$obd13[2]=$value['cmyF'];
		$obd13[3]=$value['atsc'];
		$obd13[4]=$value['obd_duration'];
		$obd13[5]=$value['obddate'];
		$obd13[6]=$value['error_code'];
		break;
		case 'HUL_OBD_14':
		$obd14[0] = $value['odb_name'];
		$obd14[1]=$value['cmy'];
		$obd14[2]=$value['cmyF'];
		$obd14[3]=$value['atsc'];
		$obd14[4]=$value['obd_duration'];
		$obd14[5]=$value['obddate'];
		$obd14[6]=$value['error_code'];
		break;
		case 'HUL_OBD_15':
		$obd15[0] = $value['odb_name'];
		$obd15[1]=$value['cmy'];
		$obd15[2]=$value['cmyF'];
		$obd15[3]=$value['atsc'];
		$obd15[4]=$value['obd_duration'];
		$obd15[5]=$value['obddate'];
		$obd15[6]=$value['error_code'];
		break;
		case 'HUL_OBD_16':
		$obd16[0] = $value['odb_name'];
		$obd16[1]=$value['cmy'];
		$obd16[2]=$value['cmyF'];
		$obd16[3]=$value['atsc'];
		$obd16[4]=$value['obd_duration'];
		$obd16[5]=$value['obddate'];
		$obd16[6]=$value['error_code'];
		break;
		case 'HUL_OBD_17':
		$obd17[0] = $value['odb_name'];
		$obd17[1]=$value['cmy'];
		$obd17[2]=$value['cmyF'];
		$obd17[3]=$value['atsc'];
		$obd17[4]=$value['obd_duration'];
		$obd17[5]=$value['obddate'];
		$obd17[6]=$value['error_code'];
		break;
		case 'HUL_OBD_18':
		$obd18[0] = $value['odb_name'];
		$obd18[1]=$value['cmy'];
		$obd18[2]=$value['cmyF'];
		$obd18[3]=$value['atsc'];
		$obd18[4]=$value['obd_duration'];
		$obd18[5]=$value['obddate'];
		$obd18[6]=$value['error_code'];
		break;
	/*	case 'HUL_OBD_19':
		$obd19[0] = $value['odb_name'];
		$obd19[1]=$value['cmy'];
		$obd19[2]=$value['cmyF'];
		$obd19[3]=$value['atsc'];
		$obd19[4]=$value['obd_duration'];
		$obd19[5]=$value['obddate'];
		$obd19[6]=$value['error_code'];
		break;
		case 'HUL_OBD_20':
		$obd20[0] = $value['odb_name'];
		$obd20[1]=$value['cmy'];
		$obd20[2]=$value['cmyF'];
		$obd20[3]=$value['atsc'];
		$obd20[4]=$value['obd_duration'];
		$obd20[5]=$value['obddate'];
		$obd20[6]=$value['error_code'];
		break;
		case 'HUL_OBD_21':
		$obd21[0] = $value['odb_name'];
		$obd21[1]=$value['cmy'];
		$obd21[2]=$value['cmyF'];
		$obd21[3]=$value['atsc'];
		$obd21[4]=$value['obd_duration'];
		$obd21[5]=$value['obddate'];
		$obd21[6]=$value['error_code'];
		break;
		case 'HUL_OBD_22':
		$obd22[0] = $value['odb_name'];
		$obd22[1]=$value['cmy'];
		$obd22[2]=$value['cmyF'];
		$obd22[3]=$value['atsc'];
		$obd22[4]=$value['obd_duration'];
		$obd22[5]=$value['obddate'];
		$obd22[6]=$value['error_code'];

		break;
		case 'HUL_OBD_23':
		$obd23[0] = $value['odb_name'];
		$obd23[1]=$value['cmy'];
		$obd23[2]=$value['cmyF'];
		$obd23[3]=$value['atsc'];
		$obd23[4]=$value['obd_duration'];
		$obd23[5]=$value['obddate'];
		$obd23[6]=$value['error_code'];

		break;
		*/
		case 'HUL_OBD_NEWYEAR':
		$HUL_OBD_NEWYEAR[0] = $value['odb_name'];
		$HUL_OBD_NEWYEAR[1]=$value['cmy'];
		$HUL_OBD_NEWYEAR[2]=$value['cmyF'];
		$HUL_OBD_NEWYEAR[3]=$value['atsc'];
		$HUL_OBD_NEWYEAR[4]=$value['obd_duration'];
		$HUL_OBD_NEWYEAR[5]=$value['obddate'];
		$HUL_OBD_NEWYEAR[6]=$value['error_code'];
		break;
		case 'HUL_OBD_PONGAL':
		$HUL_OBD_PONGAL[0] = $value['odb_name'];
		$HUL_OBD_PONGAL[1]=$value['cmy'];
		$HUL_OBD_PONGAL[2]=$value['cmyF'];
		$HUL_OBD_PONGAL[3]=$value['atsc'];
		$HUL_OBD_PONGAL[4]=$value['obd_duration'];
		$HUL_OBD_PONGAL[5]=$value['obddate'];
		$HUL_OBD_PONGAL[6]=$value['error_code'];

		break;
		case 'HUL_OBD_RAJNI':
		$HUL_OBD_RAJNI[0] = $value['odb_name'];
		$HUL_OBD_RAJNI[1]=$value['cmy'];
		$HUL_OBD_RAJNI[2]=$value['cmyF'];
		$HUL_OBD_RAJNI[3]=$value['atsc'];
		$HUL_OBD_RAJNI[4]=$value['obd_duration'];
		$HUL_OBD_RAJNI[5]=$value['obddate'];
		$HUL_OBD_RAJNI[6]=$value['error_code'];
		break;
	
}
}
?>
<tr id="<?php echo $result_list['ANI']?>">
<td><b>
<?=$result_list['ANI']?>
</b>
</td>
<!--td><?//=trim($result_list['date_time'])?></td-->
<td><?php if($getcir['circle']!='UND') {echo $getcir['circle'];} else {echo "--";};?></td>
<td><?php /*if(!empty($result_list['operator'])) {echo $result_list['operator'];} else {echo "--";}*/ echo $getoperator['operator'];?></td>		
<td><?php if(!empty($result_mdn_user_deatils['customer_name'])) {echo $result_mdn_user_deatils['customer_name'];} else {echo "--";}?></td>
<td><?php if(!empty($result_mdn_user_deatils['town'])) {echo $result_mdn_user_deatils['town'];} else {echo "--";}?></td>
<td><?php if(!empty($result_mdn_user_deatils['verification_done'])) {echo $result_mdn_user_deatils['verification_done'];} else {echo "--";}?></td>
<td><?php if(!empty($result_mdn_user_deatils['memebership_card_dp'])) {echo $result_mdn_user_deatils['memebership_card_dp'];} else {echo "--";}?></td>
<td><?php if(!empty($result_mdn_user_deatils['memebership_card_rv'])) {echo $result_mdn_user_deatils['memebership_card_rv'];} else {echo "--";}?></td>
<td><?php if(!empty($result_mdn_recharge_deatils['amount'])) {echo "YES";} else {echo "NO";}?></td>
<td>
<?php
if($obd1[0]=='HUL_OBD_1')
{
if($obd1[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd1[1]."<br>";
echo "<b>Duration</b>-".$obd1[4]."</br>";
echo "<b>Date & Time</b>-".$obd1[5]."</br>";
echo '</pre>';
}
else
{
echo $obd1[6];
}
}
?>
</td>
<td>
<?php
if($obd2[0]=='HUL_OBD_2')
{
//echo $obd2[1]."***".$obd2[2]."***".$obd2[3];
if($obd2[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd2[1]."<br>";
echo "<b>Duration</b>-".$obd2[4]."</br>";
echo "<b>Date & Time</b>-".$obd2[5]."</br>";
echo '</pre>';
}
else
{
echo $obd2[6];
//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
}
}

?>
</td>
<td><?php
if($obd3[0]=='HUL_OBD_3')
{
//echo $obd3[1]."***".$obd3[2]."***".$obd3[3];
if($obd3[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd3[1]."<br>";
echo "<b>Duration</b>-".$obd3[4]."</br>";
echo "<b>Date & Time</b>-".$obd3[5]."</br>";
echo '</pre>';
}
else
{
echo $obd3[6];
//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
}
}

?></td>
<td><?php
if($obd4[0]=='HUL_OBD_4')
{
//echo $obd4[1]."***".$obd4[2]."***".$obd4[3];
if($obd4[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd4[1]."<br>";
echo "<b>Duration</b>-".$obd4[4]."</br>";
echo "<b>Date & Time</b>-".$obd4[5]."</br>";
echo '</pre>';
}
else
{
echo $obd4[6];
//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
}
}
?></td>
<td><?php
if($obd5[0]=='HUL_OBD_5')
{
//echo $obd5[1]."***".$obd5[2]."***".$obd5[3];
if($obd5[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd5[1]."<br>";
echo "<b>Duration</b>-".$obd5[4]."</br>";
echo "<b>Date & Time</b>-".$obd5[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd5[6];
}
}
?></td>
<td><?php
if($obd6[0]=='HUL_OBD_6')
{
if($obd6[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd6[1]."<br>";
echo "<b>Duration</b>-".$obd6[4]."</br>";
echo "<b>Date & Time</b>-".$obd6[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd6[6];
}
}
?></td>
<td><?php
if($obd7[0]=='HUL_OBD_7')
{
if($obd7[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd7[1]."<br>";
echo "<b>Duration</b>-".$obd7[4]."</br>";
echo "<b>Date & Time</b>-".$obd7[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd7[6];
}
}
?></td>
<td><?php
if($obd8[0]=='HUL_OBD_8')
{
if($obd8[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd8[1]."<br>";
echo "<b>Duration</b>-".$obd8[4]."</br>";
echo "<b>Date & Time</b>-".$obd8[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd8[6];
}}
?></td>
<td><?php
if($obd9[0]=='HUL_OBD_9')
{
if($ob9[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd9[1]."<br>";
echo "<b>Duration</b>-".$obd9[4]."</br>";
echo "<b>Date & Time</b>-".$obd9[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd9[6];
}
}
?></td>
<td><?php
if($obd10[0]=='HUL_OBD_10')
{
if($obd10[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd10[1]."<br>";
echo "<b>Duration</b>-".$obd10[4]."</br>";
echo "<b>Date & Time</b>-".$obd10[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd10[6];
}
}
?></td>
<td><?php
if($obd11[0]=='HUL_OBD_11')
{
if($obd11[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd11[1]."<br>";
echo "<b>Duration</b>-".$obd11[4]."</br>";
echo "<b>Date & Time</b>-".$obd11[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd11[6];
}
}
?></td>
<td><?php
if($obd12[0]=='HUL_OBD_12')
{
if($obd12[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd12[1]."<br>";
echo "<b>Duration</b>-".$obd12[4]."</br>";
echo "<b>Date & Time</b>-".$obd12[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd12[6];
}
}
?></td>
<td><?php
if($obd13[0]=='HUL_OBD_13')
{
if($obd13[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd13[1]."<br>";
echo "<b>Duration</b>-".$obd13[4]."</br>";
echo "<b>Date & Time</b>-".$obd13[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd13[6];
}
}
?></td>
<td><?php
if($obd14[0]=='HUL_OBD_14')
{
if($obd14[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd14[1]."<br>";
echo "<b>Duration</b>-".$obd14[4]."</br>";
echo "<b>Date & Time</b>-".$obd14[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd14[6];
}
}
?></td>
<td><?php
if($obd15[0]=='HUL_OBD_15')
{
if($obd15[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd15[1]."</br>";
echo "<b>Duration</b>-".$obd15[4]."</br>";
echo "<b>Date & Time</b>-".$obd15[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd15[6];
}
}
?></td>
<td><?php
if($obd16[0]=='HUL_OBD_16')
{
if($obd16[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd16[1]."<br>";
echo "<b>Duration</b>-".$obd16[4]."</br>";
echo "<b>Date & Time</b>-".$obd16[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd16[6];
}
}
?></td>
<td><?php
if($obd17[0]=='HUL_OBD_17')
{
if($obd17[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd17[1]."<br>";
echo "<b>Duration</b>-".$obd17[4]."</br>";
echo "<b>Date & Time</b>-".$obd17[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd17[6];
}
}
?></td>
<td><?php
if($obd18[0]=='HUL_OBD_18')
{
if($obd18[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd18[1]."<br>";
echo "<b>Duration</b>-".$obd18[4]."</br>";
echo "<b>Date & Time</b>-".$obd18[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd18[6];
}
}
?></td>
<!--
<td><?php /*
if($obd19[0]=='HUL_OBD_19')
{
if($obd19[1]=='Y')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd19[1]."<br>";
echo "<b>Duration</b>-".$obd19[4]."</br>";
echo "<b>DateTime</b>-".$obd19[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd19[6];
}
}
?></td>
<td><?php
if($obd20[0]=='HUL_OBD_20')
{
if($obd20[1]=='Y')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd20[1]."<br>";
echo "<b>Duration</b>-".$obd20[4]."</br>";
echo "<b>DateTime</b>-".$obd20[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd20[6];
}
}
?></td>
<td><?php
if($obd21[0]=='HUL_OBD_21')
{
if($obd21[1]=='Y')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd21[1]."<br>";
echo "<b>Duration</b>-".$obd21[4]."</br>";
echo "<b>DateTime</b>-".$obd21[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd21[6];
}
}
?></td>
<td><?php
if($obd22[0]=='HUL_OBD_22')
{
if($obd22[1]=='Y')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd22[1]."<br>";
echo "<b>Duration</b>-".$obd22[4]."</br>";
echo "<b>DateTime</b>-".$obd22[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd22[6];
}
}
?></td>
<td><?php
if($obd23[0]=='HUL_OBD_23')
{
if($obd23[1]=='Y')
{
echo '<pre>';
echo "<b>CMA</b>-".$obd23[1]."<br>";
echo "<b>Duration</b>-".$obd23[4]."</br>";
echo "<b>DateTime</b>-".$obd23[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $obd23[6];
}
}
*/
?></td>
-->
<td><?php
if($HUL_OBD_NEWYEAR[0]=='HUL_OBD_NEWYEAR')
{
if($HUL_OBD_NEWYEAR[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$HUL_OBD_NEWYEAR[1]."<br>";
echo "<b>Duration</b>-".$HUL_OBD_NEWYEAR[4]."</br>";
echo "<b>Date & Time</b>-".$HUL_OBD_NEWYEAR[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $HUL_OBD_NEWYEAR[6];
}
}
?></td>
<td><?php
if($HUL_OBD_PONGAL[0]=='HUL_OBD_PONGAL')
{
if($HUL_OBD_PONGAL[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$HUL_OBD_PONGAL[1]."<br>";
echo "<b>Duration</b>-".$HUL_OBD_PONGAL[4]."</br>";
echo "<b>Date & Time</b>-".$HUL_OBD_PONGAL[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $HUL_OBD_PONGAL[6];
}
}
?></td>
<td><?php
if($HUL_OBD_RAJNI[0]=='HUL_OBD_RAJNI')
{
if($HUL_OBD_RAJNI[1]=='YES')
{
echo '<pre>';
echo "<b>CMA</b>-".$HUL_OBD_RAJNI[1]."<br>";
echo "<b>Duration</b>-".$HUL_OBD_RAJNI[4]."</br>";
echo "<b>Date & Time</b>-".$HUL_OBD_RAJNI[5]."</br>";
echo '</pre>';
}
else
{//$rand_keys = array_rand($errorcode, 2);
//echo $errorcode[$rand_keys[0]];
echo $HUL_OBD_RAJNI[6];
}
}
?></td>
</tr>
<?php
}
$m++;
}

}
else
{?>
<tr><td>NA</td><td colspan="34">No records found.</td></tr>
<?php
}
?>
        		  </tbody>
        		</table>
        	</div>
        	<div class="clear"></div>
        </div>
		 <div>
				
				<?php //echo $m;?>
				
		</div>
				</div>
		</div>
		<div id="right-column">
		
<?php
//close database connection
mysql_close($con);
?>
	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>