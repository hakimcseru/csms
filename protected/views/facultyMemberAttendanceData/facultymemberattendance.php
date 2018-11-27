<h1><?php echo Yii::t('core','Faculties Attendances Report');?></h1>
 
 <?php if($nf=Yii::app()->user->getFlash('warning'))
{
?>
<div class="alert in alert-block fade alert-error"><a data-dismiss="alert" class="close">×</a>
<?php echo $nf;?>
</div>
<?php }?>
<?php echo $this->renderPartial('_fmform', array('model'=>$model)); ?> 
 
 <div class="stu_attendance">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td><h4>শিক্ষক উপস্থিতি</h4></td>
          </tr>
          <tr>
            <td align="center">কার্যদিবস: <?php echo $model->weekday;?></td>
          </tr>
          <tr>
          	<td>&nbsp;</td>
          </tr>
          <tr>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="student_tbl">
                	<tr>
                    	<th width="8%">পরিচিতি</th>
                        <th width="19%">শিক্ষক</th>
                        <th width="29%">মোট দিন</th>
                        <th width="15%">মোট উপস্থিতি</th>
                    </tr>
                   
                
<?php

 
 //echo "session_id=".$model->session_id." and weekday='".$model->weekday."' group by faculty_member_id";
//echo "session_id=".$session_id." and faculty_member_id=".$model->member_pk." group by calendar_id,weekday";
$tot_fm2=ClassRoutine::model()->findAll(array('select'=>'additional_faculty_member_id','group'=>'additional_faculty_member_id','distinct'=>true,'condition'=>"session_id=".$model->session_id." and weekday='".$model->weekday."'"));

$tot_fm3=ClassRoutine::model()->findAll(array('select'=>'faculty_member_id','group'=>'faculty_member_id','distinct'=>true,'condition'=>"session_id=".$model->session_id." and weekday='".$model->weekday."'"));

$edre=array();
foreach($tot_fm2 as $cd):
if($cd->additional_faculty_member_id>0)
$edre[]=$cd->additional_faculty_member_id;
endforeach;
foreach($tot_fm3 as $cd):
if($cd->faculty_member_id>0)
$edre[]=$cd->faculty_member_id;
endforeach;

$cdree=array_unique($edre);
$fid=implode(",",$cdree);
//echo count($tot_class);
$tot_fm2=FacultyMember::model()->findAll(array("condition"=>" member_pk in ( ".$fid." )","order"=>"member_name ASC"));

?>


<?php

foreach($tot_fm2 as $tot_fm):

$array1 = array();

$total_holiday=array();
$final_res2=array();
 
//echo "session_id=".$session_id." and faculty_member_id=".$model->member_pk." group by calendar_id,weekday";
$tot_class=ClassRoutine::model()->findAll("session_id=".$model->session_id." and (faculty_member_id=".$tot_fm->member_pk." or additional_faculty_member_id=".$tot_fm->member_pk." ) and weekday='".$model->weekday."' group by calendar_id");
//echo count($tot_class);
$final_res=array();

$total_present = array();

$today=date("Y-m-d");
$td=strtotime($today);
foreach($tot_class as $tt):

$ctstart_date=strtotime($tt->calendar->start_date);
$ctend_date=strtotime($tt->calendar->end_date);

$tstart_date=$model->start_date;
$tend_date=$model->end_date;
$tsd=strtotime($tstart_date);
$ted=strtotime($tend_date);
 
if(($ctstart_date>=$tsd && $ctstart_date<=$ted) || ($ctend_date>=$tsd && $ctend_date<=$ted)||($ctstart_date<$tsd && $ctend_date>$ted))
{

 if($ctstart_date<$tsd) {$ctstart_date=$tsd;}
 if($ctend_date>$ted) {$ctend_date=$ted;}
	
	//echo $model->start_date." ".$model->end_date;
	$array1=AttendanceCalendar::model()->getAllWeekDays(date("Y-m-d",$ctstart_date),date("Y-m-d",$ctend_date),$model->weekday );
	
	$final_res = array_merge($final_res, $array1);
	
	//echo "date >='".date("Y-m-d",$ctstart_date)."' and date <='".date("Y-m-d",$ctend_date)."' ";
	$tot_holiday=AttendanceCalendar::model()->findAll("date >='".date("Y-m-d",$ctstart_date)."' and date <='".date("Y-m-d",$ctend_date)."' and course_id='".$tt->course_id."' ");
	
	//echo count($final_res);
	//print_r($tot_holiday);
	foreach($tot_holiday as $pre):
	//echo date("l",strtotime($pre->date));
	if(date("l",strtotime($pre->date))==$model->weekday)
	$total_holiday[]=$pre->date;
	endforeach;
	
//echo $tt->calendar_id." ".	$tt->weekday." ".$tt->session_id." ".$tt->calendar->start_date." ".$tt->calendar->end_date." <br />";

	$dates = implode(",",$array1);
	//echo "date in ($dates) and student_id=".$eninfo->student_pk."<br>";

	foreach($array1 as $er):
	$WD[$er]=$model->weekday;
	endforeach;

}

endforeach;

//print_r($final_res);

if($final_res)
{
if($total_holiday)
{
foreach($final_res as $vc=>$res):

if(in_array($res,$total_holiday));
else $final_res2[]=$res;
endforeach;
}
else $final_res2=$final_res;
//print_r($final_res2);

$comma_separated = implode("','", $final_res2);
$comma_separated = "'".$comma_separated."'";









$comma_dhd = implode("','", $total_holiday);
$comma_dhd = "'".$comma_dhd."'";


$tot_presence=FacultyMemberAttendanceData::model()->findAll("date in ($comma_separated) and date not in ($comma_dhd)  and member_id=".$tot_fm->member_pk." group by date");

foreach($tot_presence as $pre):

$total_present[]=$pre->date;

$dadd=date("H:i:s",strtotime($pre->time)); 


$final_ins[$pre->date][]=$dadd;
endforeach;

//print_r($total_holiday);
?>


 <tr>
                    	<td><?php echo $tot_fm->member_id;?></td>
                        <td><?php echo $tot_fm->member_name;?></td>
                        <td><?php echo count($final_res2);?></td>
                        <td><?php echo count($tot_presence);?></td>
                    </tr>
                    

<?php }

endforeach;
?>


<?php
/*
$dcc=implode(",",$ssd);
foreach($tot_fm2 as $tot_fm):

$array1 = array();

$total_holiday=array();
$final_res2=array();
 
//echo "session_id=".$session_id." and faculty_member_id=".$model->member_pk." group by calendar_id,weekday";
$tot_class=ClassRoutine::model()->findAll("session_id=".$model->session_id." and additional_faculty_member_id='".$tot_fm->additional_faculty_member_id."' and weekday='".$model->weekday."' and additional_faculty_member_id not in (".$dcc.") group by calendar_id ");
//echo count($tot_class);
$final_res=array();

$total_present = array();

$today=date("Y-m-d");
$td=strtotime($today);
foreach($tot_class as $tt):

$ctstart_date=strtotime($tt->calendar->start_date);
$ctend_date=strtotime($tt->calendar->end_date);

$tstart_date=$model->start_date;
$tend_date=$model->end_date;
$tsd=strtotime($tstart_date);
$ted=strtotime($tend_date);
 //echo "dsfvzxvzxcv";
 //echo date("Y-m-d",$tsd)." ".date("Y-m-d",$ted)." ".date("Y-m-d",$ctstart_date)." ".date("Y-m-d",$ctend_date)."<br />";
  //echo $tsd." ".$ctstart_date." ".$ctend_date."<br />";
if(($ctstart_date>=$tsd && $ctstart_date<=$ted) || ($ctend_date>=$tsd && $ctend_date<=$ted)||($ctstart_date<$tsd && $ctend_date>$ted)||($ctstart_date>$tsd && $ctend_date<$ted))
{
 
 if($ctstart_date<$tsd) {$ctstart_date=$tsd;}
 if($ctend_date>$ted) {$ctend_date=$ted;}
	
	//echo $model->start_date." ".$model->end_date;
	$array1=AttendanceCalendar::model()->getAllWeekDays(date("Y-m-d",$ctstart_date),date("Y-m-d",$ctend_date),$model->weekday );
	
	$final_res = array_merge($final_res, $array1);
	
	//echo "date >='".date("Y-m-d",$ctstart_date)."' and date <='".date("Y-m-d",$ctend_date)."' ";
	$tot_holiday=AttendanceCalendar::model()->findAll("date >='".date("Y-m-d",$ctstart_date)."' and date <='".date("Y-m-d",$ctend_date)."' and course_id='".$tt->course_id."' ");
	//print_r($tot_holiday);
	foreach($tot_holiday as $pre):
	//echo date("l",strtotime($pre->date));
	if(date("l",strtotime($pre->date))==$model->weekday)
	$total_holiday[]=$pre->date;
	
	endforeach;
	
//echo $tt->calendar_id." ".	$tt->weekday." ".$tt->session_id." ".$tt->calendar->start_date." ".$tt->calendar->end_date." <br />";

	$dates = implode(",",$array1);
	//echo "date in ($dates) and student_id=".$eninfo->student_pk."<br>";

	foreach($array1 as $er):
	$WD[$er]=$model->weekday;
	endforeach;

}

endforeach;

if($final_res)
{
if($total_holiday)
{
foreach($final_res as $res):
if(in_array($res,$total_holiday));
else $final_res2[]=$res;
endforeach;
}
else $final_res2=$final_res;
$comma_separated = implode("','", $final_res2);
$comma_separated = "'".$comma_separated."'";









$comma_dhd = implode("','", $total_holiday);
$comma_dhd = "'".$comma_dhd."'";


$tot_presence=FacultyMemberAttendanceData::model()->findAll("date in ($comma_separated) and date not in ($comma_dhd)  and member_id=".$tot_fm->additional_faculty_member_id." group by date");

foreach($tot_presence as $pre):

$total_present[]=$pre->date;

$dadd=date("H:i:s",strtotime($pre->time)); 


$final_ins[$pre->date][]=$dadd;
endforeach;

//print_r($total_holiday);
?>


 <tr>
                    	<td><?php echo $tot_fm->A_facultyMember->member_id;?></td>
                        <td><?php echo $tot_fm->A_facultyMember->member_name;?></td>
                        <td><?php echo count($final_res2);?></td>
                        <td><?php echo count($tot_presence);?></td>
                    </tr>
                    

<?php } 

endforeach;*/
?>

</table>
            </td>
          </tr>
        </table>
    </div>  

<style>

	
	
	.stu_attendance
	{margin:0 auto; margin-top:30px; width:800px; font-size:14px; font-weight:normal; height:auto; overflow:hidden}

	
	.student_tbl
	{border-collapse:collapse; border-spacing:0; color:#333; font-size:14px}
	
	.student_tbl tr th
	{padding:8px; background-color:#fafafa; text-align:left; font-weight:bold; border:1px solid #ccc; vertical-align:middle}
		
	.student_tbl tr td
	{padding:8px; text-align:left; border:1px solid #ccc; vertical-align:middle}
	
</style>	
    