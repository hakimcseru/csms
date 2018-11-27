<?php

$array1 = array();



$tot_class=ClassRoutine::model()->findAll("session_id=".$eninfo->session." and course_id=".$eninfo->course_id." and department_id=".$eninfo->department_id." and batch_id=".$eninfo->batch_id." and  batch_group_id=".$eninfo->batch_group." and semester_id=".$eninfo->semester." group by calendar_id,weekday");
$final_res=array();

$total_present = array();

$today=date("Y-m-d");
$td=strtotime($today);
foreach($tot_class as $tt):
$tstart_date=$tt->calendar->start_date;
$tend_date=$tt->calendar->end_date;
$tsd=strtotime($tstart_date);
$ted=strtotime($tend_date);
if($tsd<=$td)
{
 if($ted>=$td)
 {	$tend_date=date("Y-m-d",$td);
	$tsd=$td;}
	
	$array1=AttendanceCalendar::model()->getAllWeekDays($tstart_date,$tend_date,$tt->weekday );
	
	$final_res = array_merge($final_res, $array1);
	
	
	$tot_holiday=AttendanceCalendar::model()->findAll("course_id=".$eninfo->course_id." and date >='$tstart_date' and date <='$tend_date' ");

	foreach($tot_holiday as $pre):

	$total_holiday[]=$pre->date;
	endforeach;
	
//echo $tt->calendar_id." ".	$tt->weekday." ".$tt->session_id." <br />";

	$dates = implode(",",$array1);
	//echo "date in ($dates) and student_id=".$eninfo->student_pk."<br>";



}

endforeach;

if($final_res)
{

foreach($final_res as $res):
if(in_array($res,$total_holiday));
else $final_res2[]=$res;
endforeach;

$comma_separated = implode("','", $final_res2);
$comma_separated = "'".$comma_separated."'";









$comma_dhd = implode("','", $total_holiday);
$comma_dhd = "'".$comma_dhd."'";


$tot_presence=StudentAttendanceData::model()->findAll("date in ($comma_separated) and date not in ($comma_dhd)  and student_id=".$eninfo->student_pk);

foreach($tot_presence as $pre):

$total_present[]=$pre->date;

$dadd=date("H:i:s",strtotime($pre->time)); 

$final_ins[$pre->date]=$dadd;
endforeach;


?>

<table class="table">
	<tr>
		<th>Total Class<th>
		<th>Total Presence<th>
		<th>Percentage of Presence<th>
	</tr>
	<tr>
		<td><?php echo $tclass=count($final_res2);?><td>
		<td><?php echo count($total_present);?><td>
		<td><?php echo (count($total_present)/$tclass)*100;?>%<td>
	</tr>

</table>


<table class="table">
	<tr>
		<th>Date<th>
		<th>In Time<th>
		<th>Status<th>
	</tr>
	<?php foreach($final_res as $rr):?>
	<tr>
		<td><?php echo $rr;?><td>
		<td><?php 
		
		if(in_array($rr,$total_present)) { echo $final_ins[$rr]; $status="Present"; }
		elseif(in_array($rr,$total_holiday)) $status="Holiday";
		else $status="Absent";
		
		?><td>
		<td><?php echo $status;?><td>
	</tr>
<?php endforeach;?>
</table>
<?php }?>