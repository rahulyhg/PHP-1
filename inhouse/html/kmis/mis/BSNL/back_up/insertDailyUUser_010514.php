<?php

///////////////////////////////////// start code to insert the data for Unique Users  for toll  for BSNL54646 ////////////////////////////////////
$uu_tf = array();
$uu_tf_query = "select 'UU_T',circle, count(distinct msisdn),'BSNL54646' as service_name,date(call_date) from mis_db.tbl_bsnl_54646_calllog 
where date(call_date)='$view_date1' and (dnis='54646' or dnis like '546464%' 
or dnis like '546465%' or dnis like '546466%' or dnis like '546467%') and operator in('bsnl') group by circle";

$uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
$numRows4 = mysql_num_rows($uu_tf_result);
if ($numRows4 > 0) {
    $uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
    while ($uu_tf = mysql_fetch_array($uu_tf_result)) {
        $insert_uu_tf_data = "insert into mis_db.dailyReportBsnl(report_date,type,circle,charging_rate,total_count,mode_of_sub,service_id,mous,pulse,
        total_sec) values('$view_date1', '$uu_tf[0]','$uu_tf[1]','0','$uu_tf[2]','','2202','NA','NA','NA')";
        $queryIns_uu = mysql_query($insert_uu_tf_data, $dbConn);
    }
}

$uu_tf = array();
$uu_tf_query = "(select 'UU_T',circle, count(distinct msisdn),'BSNL54646' as service_name,date(call_date),status,'Non Active' as 'user_status' 
from mis_db.tbl_bsnl_54646_calllog where date(call_date)='$view_date1' and (dnis='54646' or dnis like '546464%' 
or dnis like '546465%' or dnis like '546466%' or dnis like '546467%')  and operator in('bsnl') and status in(-1,11,0) 
AND MSISDN  NOT IN( select DISTINCT MSISDN from mis_db.tbl_bsnl_54646_calllog where date(call_date)='$view_date1' and (dnis='54646' or dnis like '546464%' 
or dnis like '546465%' or dnis like '546466%' or dnis like '546467%') 
and operator in('bsnl') and status IN (1)) group by circle)";
$uu_tf_query .= "UNION (select 'UU_T',circle, count(distinct msisdn),'BSNL54646' as service_name,date(call_date),status,'Active' as 'user_status' 
from mis_db.tbl_bsnl_54646_calllog where date(call_date)='$view_date1' and (dnis='54646' or dnis like '546464%' 
or dnis like '546465%' or dnis like '546466%' or dnis like '546467%') and operator in('bsnl') and status=1 group by circle)";

$uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
$numRows4 = mysql_num_rows($uu_tf_result);
if ($numRows4 > 0) {
    $uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
    while ($uu_tf = mysql_fetch_array($uu_tf_result)) {
        if ($uu_tf[5] == 1)
            $uu_tf[0] = "L_UU_T";
        elseif ($uu_tf[5] != 1)
            $uu_tf[0] = "N_UU_T";
        $insert_uu_tf_data = "insert into mis_db.dailyReportBsnl(report_date,type,circle,charging_rate,total_count,mode_of_sub,service_id,mous,pulse,
        total_sec) values('$view_date1', '$uu_tf[0]','$uu_tf[1]','0','$uu_tf[2]','','2202','NA','NA','NA')";
        $queryIns_uu = mysql_query($insert_uu_tf_data, $dbConn);
    }
}


$uu_tf = array();
$uu_tf_query = "select 'UU_T_4',circle, count(distinct msisdn),'BSNL54646' as service_name,date(call_date) from mis_db.tbl_bsnl_54646_calllog 
where date(call_date)='$view_date1' and (dnis like '546468%') and operator in('bsnl') group by circle";

$uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
$numRows4 = mysql_num_rows($uu_tf_result);
if ($numRows4 > 0) {
    $uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
    while ($uu_tf = mysql_fetch_array($uu_tf_result)) {
        $insert_uu_tf_data = "insert into mis_db.dailyReportBsnl(report_date,type,circle,charging_rate,total_count,mode_of_sub,service_id,mous,pulse,
        total_sec) values('$view_date1', '$uu_tf[0]','$uu_tf[1]','0','$uu_tf[2]','','2202','NA','NA','NA')";
        $queryIns_uu = mysql_query($insert_uu_tf_data, $dbConn);
    }
}

$uu_tf = array();
$uu_tf_query = "(select 'UU_T_4',circle, count(distinct msisdn),'BSNL54646' as service_name,date(call_date),status,'Non Active' as 'user_status' 
from mis_db.tbl_bsnl_54646_calllog where date(call_date)='$view_date1' and (dnis like '546468%')  and operator in('bsnl') and status in(-1,11,0) 
AND MSISDN  NOT IN( select DISTINCT MSISDN from mis_db.tbl_bsnl_54646_calllog where date(call_date)='$view_date1' and (dnis like '546468%')  
and operator in('bsnl') and status IN (1)) group by circle)";
$uu_tf_query .= "UNION (select 'UU_T_4',circle, count(distinct msisdn),'BSNL54646' as service_name,date(call_date),status,'Active' as 'user_status' 
from mis_db.tbl_bsnl_54646_calllog where date(call_date)='$view_date1' and (dnis like '546468%') and operator in('bsnl') and status=1 group by circle)";

$uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
$numRows4 = mysql_num_rows($uu_tf_result);
if ($numRows4 > 0) {
    $uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
    while ($uu_tf = mysql_fetch_array($uu_tf_result)) {
        if ($uu_tf[5] == 1)
            $uu_tf[0] = "L_UU_T_4";
        elseif ($uu_tf[5] != 1)
            $uu_tf[0] = "N_UU_T_4";
        $insert_uu_tf_data = "insert into mis_db.dailyReportBsnl(report_date,type,circle,charging_rate,total_count,mode_of_sub,service_id,mous,pulse,
        total_sec) values('$view_date1', '$uu_tf[0]','$uu_tf[1]','0','$uu_tf[2]','','2202','NA','NA','NA')";
        $queryIns_uu = mysql_query($insert_uu_tf_data, $dbConn);
    }
}
//tollf free data
$uu_tf = array();
$uu_tf_query = "select 'UU_TF',circle, count(distinct msisdn),'BSNL54646' as service_name,date(call_date) from mis_db.tbl_bsnl_54646_calllog 
where date(call_date)='$view_date1' and (dnis like '546461%' 
or dnis like '546462%' or dnis like '546463%' or dnis like '546469%') and operator in('bsnl') group by circle";

$uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
$numRows4 = mysql_num_rows($uu_tf_result);
if ($numRows4 > 0) {
    $uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
    while ($uu_tf = mysql_fetch_array($uu_tf_result)) {
        $insert_uu_tf_data = "insert into mis_db.dailyReportBsnl(report_date,type,circle,charging_rate,total_count,mode_of_sub,service_id,mous,pulse,
        total_sec) values('$view_date1', '$uu_tf[0]','$uu_tf[1]','0','$uu_tf[2]','','2202','NA','NA','NA')";
        $queryIns_uu = mysql_query($insert_uu_tf_data, $dbConn);
    }
}

$uu_tf = array();
$uu_tf_query = "(select 'UU_TF',circle, count(distinct msisdn),'BSNL54646' as service_name,date(call_date),status,'Non Active' as 'user_status' 
from mis_db.tbl_bsnl_54646_calllog where date(call_date)='$view_date1' and (dnis like '546461%' 
or dnis like '546462%' or dnis like '546463%' or dnis like '546469%')  and operator in('bsnl') and status in(-1,11,0) 
AND MSISDN  NOT IN( select DISTINCT MSISDN from mis_db.tbl_bsnl_54646_calllog where date(call_date)='$view_date1' and (dnis='54646' or dnis like '546464%' 
or dnis like '546465%' or dnis like '546466%' or dnis like '546467%') 
and operator in('bsnl') and status IN (1)) group by circle)";
$uu_tf_query .= "UNION (select 'UU_TF',circle, count(distinct msisdn),'BSNL54646' as service_name,date(call_date),status,'Active' as 'user_status' 
from mis_db.tbl_bsnl_54646_calllog where date(call_date)='$view_date1' and (dnis like '546461%' 
or dnis like '546462%' or dnis like '546463%' or dnis like '546469%') and operator in('bsnl') and status=1 group by circle)";

$uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
$numRows4 = mysql_num_rows($uu_tf_result);
if ($numRows4 > 0) {
    $uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
    while ($uu_tf = mysql_fetch_array($uu_tf_result)) {
        if ($uu_tf[5] == 1)
            $uu_tf[0] = "L_UU_TF";
        elseif ($uu_tf[5] != 1)
            $uu_tf[0] = "N_UU_TF";
        $insert_uu_tf_data = "insert into mis_db.dailyReportBsnl(report_date,type,circle,charging_rate,total_count,mode_of_sub,service_id,mous,pulse,
        total_sec) values('$view_date1', '$uu_tf[0]','$uu_tf[1]','0','$uu_tf[2]','','2202','NA','NA','NA')";
        $queryIns_uu = mysql_query($insert_uu_tf_data, $dbConn);
    }
}
//for UU Repeat @jyoti.porwal
$uu_tf = array();
echo $uu_tf_query = "select 'UU_Repeat',item.circle, count(distinct item.msisdn),'BSNL54646' as service_name,date(item.call_date)
from mis_db.tbl_bsnl_54646_calllog item INNER JOIN(  SELECT msisdn  FROM mis_db.tbl_bsnl_54646_calllog  where date(call_date) between '$last_7day_end' and '$last_7day_start'
and (dnis='54646' or dnis like '546464%' or dnis like '546465%' or dnis like '546466%' or dnis like '546467%' or dnis like '546468%' 
or dnis like '546461%' or dnis like '546462%' or dnis like '546463%' or dnis like '546469%') and operator in('bsnl'))temp ON item.msisdn= temp.msisdn 
where date(item.call_date)='$view_date1' and (dnis='54646' or dnis like '546464%' or dnis like '546465%' or dnis like '546466%' or dnis like '546467%' 
or dnis like '546468%' or dnis like '546461%' or dnis like '546462%' or dnis like '546463%' or dnis like '546469%') and operator in('bsnl')
group by item.circle";
$uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
$numRows4 = mysql_num_rows($uu_tf_result);
if ($numRows4 > 0) {
    $uu_tf_result = mysql_query($uu_tf_query, $dbConn) or die(mysql_error());
    while ($uu_tf = mysql_fetch_array($uu_tf_result)) {
        $insert_uu_tf_data = "insert into mis_db.dailyReportBsnl(report_date,type,circle,charging_rate,total_count,mode_of_sub,service_id,mous,pulse, total_sec) 
        values('$view_date1', '$uu_tf[0]','$uu_tf[1]','0','$uu_tf[2]','','2202','NA','NA','NA')";
        $queryIns_uu = mysql_query($insert_uu_tf_data, $dbConn);
    }
}
//for UU New @jyoti.porwal
$uu_total = array();
echo $uu_total_query = "select 'UU_New',item.circle, count(distinct item.msisdn),'BSNL54646' as service_name,date(item.call_date)
from mis_db.tbl_bsnl_54646_calllog item where date(item.call_date)='$view_date1' and (dnis='54646' or dnis like '546464%' or dnis like '546465%' or dnis like '546466%' or dnis like '546467%' 
or dnis like '546468%' or dnis like '546461%' or dnis like '546462%' or dnis like '546463%' or dnis like '546469%') and operator in('bsnl')
group by item.circle";
$uu_total_result = mysql_query($uu_total_query, $dbConn) or die(mysql_error());
$numRows4 = mysql_num_rows($uu_total_result);
if ($numRows4 > 0) {
    $uu_total_result = mysql_query($uu_total_query, $dbConn) or die(mysql_error());
    while ($uu_total = mysql_fetch_array($uu_total_result)) {

        echo $repeat_query = "select  count(distinct item.msisdn)
from mis_db.tbl_bsnl_54646_calllog item INNER JOIN(  SELECT msisdn  FROM mis_db.tbl_bsnl_54646_calllog  where date(call_date) between '$last_7day_end' and '$last_7day_start'
and (dnis='54646' or dnis like '546464%' or dnis like '546465%' or dnis like '546466%' or dnis like '546467%' or dnis like '546468%' 
or dnis like '546461%' or dnis like '546462%' or dnis like '546463%' or dnis like '546469%') and operator in('bsnl'))temp ON item.msisdn= temp.msisdn 
where date(item.call_date)='$view_date1' and (dnis='54646' or dnis like '546464%' or dnis like '546465%' or dnis like '546466%' or dnis like '546467%' 
or dnis like '546468%' or dnis like '546461%' or dnis like '546462%' or dnis like '546463%' or dnis like '546469%') and operator in('bsnl')
and circle='$uu_total[1]'";
        $repeat_query_exe = mysql_query($repeat_query, $dbConn) or die(mysql_error());
        $uu_repeat = mysql_fetch_array($repeat_query_exe);
        if ($uu_repeat[0] == '') {
            $uu_repeat[0] = 0;
        }
        $uu_new = $uu_total[2] - $uu_repeat[0];

        $insert_uu_total_data = "insert into mis_db.dailyReportBsnl(report_date,type,circle,charging_rate,total_count,mode_of_sub,service_id,mous,pulse, total_sec) 
        values('$view_date1', '$uu_total[0]','$uu_total[1]','0','$uu_new','','2202','NA','NA','NA')";
        $queryIns_uu = mysql_query($insert_uu_total_data, $dbConn);
    }
}
//////////////////////////////////////////////////////////// end toll for BSNL54646 //////////////////////////////////////////////////
?>