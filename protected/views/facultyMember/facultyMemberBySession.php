
<?php
$array1 = array();

$total_holiday=array();
$final_res2=array();
 
//echo "session_id=".$session_id." and faculty_member_id=".$model->member_pk." group by calendar_id,weekday";
$tot_class=ClassRoutine::model()->findAll("(session_id=".$session_id." and faculty_member_id=".$model->member_pk." or additional_faculty_member_id='".$model->member_pk."')  group by calendar_id,weekday");
//echo count($tot_class);
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
	
	
	$tot_holiday=AttendanceCalendar::model()->findAll("date >='$tstart_date' and date <='$tend_date' and course_id='".$tt->course_id."' ");
	//$tot_holiday=AttendanceCalendar::model()->findAll("date >='".date("Y-m-d",$ctstart_date)."' and date <='".date("Y-m-d",$ctend_date)."' and course_id='".$tt->course_id."' ");

	foreach($tot_holiday as $pre):

	$total_holiday[]=$pre->date;
	endforeach;
	
//echo $tt->calendar_id." ".	$tt->weekday." ".$tt->session_id." ".$tt->calendar->start_date." ".$tt->calendar->end_date." <br />";

	$dates = implode(",",$array1);
	//echo "date in ($dates) and student_id=".$eninfo->student_pk."<br>";

	foreach($array1 as $er):
	$WD[$er]=$tt->weekday;
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

$comma_separated = implode("','", $final_res2);
$comma_separated = "'".$comma_separated."'";









$comma_dhd = implode("','", $total_holiday);
$comma_dhd = "'".$comma_dhd."'";


$tot_presence=FacultyMemberAttendanceData::model()->findAll("date in ($comma_separated) and date not in ($comma_dhd)  and member_id=".$model->member_pk);

foreach($tot_presence as $pre):

$total_present[]=$pre->date;

$dadd=date("H:i:s",strtotime($pre->time)); 


$final_ins[$pre->date][]=$dadd;
endforeach;


?>




<table class="table">
	<tr>
		<th>Date</th>
		<th>Weekday</th>
		<th>Punch Time</th>
	</tr>
	<?php 
	asort($final_res);
	foreach($final_res as $rr):?>
	<tr>
		<td><?php echo $rr;?></td>
		<td><?php echo $WD[$rr];?></td>
		<td><?php 
		
		if(in_array($rr,$total_present)) { 
		foreach($final_ins[$rr] as $df):
		echo $df."<br />";
		endforeach;
		//print_r( $final_ins[$rr]); $status="Present"; 
		}
		elseif(in_array($rr,$total_holiday)) $status="Holiday";
		else $status="Absent";
		
		?></td>
		
	</tr>
<?php endforeach;?>
</table>
<?php }?>