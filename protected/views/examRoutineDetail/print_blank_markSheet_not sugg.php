
<style>
body{font-family:SolaimanLipi !important;}
	.tdata .bdr1{border:1px solid #ccc}
	.tdata .bdr2{border:1px solid #ccc; border-left:none}
	.tdata .bdr3{border:1px solid #ccc; border-top:none}
</style>





<?php 

$all_student=ExamRoutineDetail::model()->find(
			array(
			//'select'=>'t.module',
			//'group'=>'t.module',
			//'order'=>'authmodule.priority ASC',
			//'distinct'=>true,
			//'condition'=>'session_id = "'.$model->session_id.'" and batch_section_id="'.$model->batch_section_id.'" and course_id="'.$model->course_id.'" and department_id="'.$model->department_id.'" and batch_id="'.$model->batch_id.'" and batch_group_id="'.$model->batch_group_id.'" and semester_id="'.$model->semester_id.'"';
			'condition'=>'t.id='.$model->id,
			'with' => array(
				/*
				'batch_section' => array(
				'joinType' => 'INNER JOIN', 
				'condition' => 'batch_section.id ='.$model->batch_section_id,				
				),*/
				'students' => array(
				//'joinType' => 'L JOIN', 'batch_section_id'=>'batch_section_id',
				'condition' => 'students.roll_no >= '.$model->batch_section->start_role.' and students.roll_no <= '.$model->batch_section->end_role.' ',
				
       ),
			)
			));
	
?>
<!-- attendance calculation end -->

<?php
$att_set=AttendanceReleaseSetting::model()->find("session='".$all_student->session_id."' and course_id='".$all_student->course_id."'");
$array1 = array(); 
$tot_class=ClassRoutine::model()->findAll("session_id='".$all_student->session_id."' 
and course_id='".$all_student->course_id."' 
and department_id='".$all_student->department_id."' 
and batch_id='".$all_student->batch_id."' and 
 batch_group_id='".$all_student->batch_group_id."' 
 and semester_id='".$all_student->semester_id."' group by calendar_id,weekday");
//echo count($tot_class);
$final_res=array();
$final_res2=array();


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
	
	
	$tot_holiday=AttendanceCalendar::model()->findAll("course_id=".$all_student->course_id." and date >='$tstart_date' and date <='$tend_date'  ");

	foreach($tot_holiday as $pre):

	$total_holiday[]=$pre->date;
	endforeach;
	
//echo $tt->calendar_id." ".	$tt->weekday." ".$tt->session_id." <br />";

	$dates = implode(",",$array1);
	//echo "date in ($dates) and student_id=".$eninfo->student_pk."<br>";



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


}
?>

<!-- attendance calculation end -->

<?php
$i=1;
	
foreach($all_student->students as $student):
$total_present = array();
/* attendance start */


$tot_presence=StudentAttendanceData::model()->findAll("date in ($comma_separated) and date not in ($comma_dhd)  and student_id=".$student->student_pk." group by date");

foreach($tot_presence as $pre):

$total_present[]=$pre->date;

$dadd=date("H:i:s",strtotime($pre->time)); 


$final_ins[$pre->date][]=$dadd;
endforeach;

//print_r($total_holiday);
?>



					
                        <?php $tclass=count($final_res2);?>
                     
						<?php $total_pre=round((count($total_present)/$tclass)*100,2);
						
if($att_set)
{
if($att_set->min_allendance<=$total_pre)
{
												
if($i%28==1)
{
?>
<h3 style="text-align:center">ছায়ানট সঙ্গীতবিদ্যায়তন<h3>
<h3 style="text-align:center">নম্বরপত্রী, <?php echo $model->exam_routine->name;?></h3>
<h4 style="text-align:center"><?php echo $model->course->course_name.", ".$model->department->department_name.", ".$model->semesterLevel->lebel.", ".$model->batchgroup->group_name;?></h4>
<h4><span style="width:50%; float:left;">বিষয়: <?php echo $model->subject->subject_name;?>, পূর্ণমান: <?php echo Bndate::t($model->coursesubject->full_mark);?></span><span style="width:50%; float:right;text-align:right">কক্ষ: <?php echo $model->room->room_no;?> &nbsp;&nbsp;&nbsp;তারিখ: <?php echo Bndate::t($model->exam_date->exam_date,true)?></span></h4>
<h4>পরীক্ষক: <?php echo $model->facultyMember->member_name;
echo " / ";
echo $model->A_facultyMember?$model->A_facultyMember->member_name." / ":"";

echo $model->A_facultyMember2?$model->A_facultyMember2->member_name." / ":"";

echo $model->A_facultyMember3?$model->A_facultyMember3->member_name." / ":"";

echo $model->A_facultyMember4?$model->A_facultyMember4->member_name." / ":"";

echo $model->A_facultyMember5?$model->A_facultyMember5->member_name." / ":"";
?>

<table style="margin:10px" class="tdata" cellpadding="5" width="98%">
<tr>
<td class="bdr1" width="10%">ক্রম</td>
<td class="bdr2" width="30%">নাম</td>
<td class="bdr2" width="20%">পরিচিতি</td>
<td class="bdr2" width="40%">পাস নম্বর</td>
<td class="bdr2" width="40%">অর্জিত নম্বর</td>
</tr>
<?php } ?>



<!--Attendance End-->						


<tr>
<td class="bdr3"><?php echo Bndate::t($student->roll_no);?></td>
<td class="bdr3"><?php echo $student->student->student_name;?></td>
<td class="bdr3"><?php echo Bndate::t($student->student_id);?></td>
<td class="bdr3"><?php //echo Bndate::t($examsetting->pass_mark);?></td>
<td class="bdr3"><?php //echo Bndate::t($examsetting->full_mark);?></td>

</tr>

<?php 
if($i%28==0)
{ echo '</table>';
?>
<div class="signature">
<br><br><br>
<div style="text-align:center;">-----------------------------------------------------------------------</div>
<h4 style="text-align:center">পরীক্ষকের স্বাক্ষর ও তারিখ</h4>
</div>
<?php }?>
<?php 
$i++;}}
endforeach;?>
<?php 
if(($i-1)%28!=0) { echo '</table>';
?>
<div class="signature">
<br><br><br>
<div style="text-align:center;">-----------------------------------------------------------------------</div>
<h4 style="text-align:center">পরীক্ষকের স্বাক্ষর ও তারিখ</h4>
</div>
<?php } 

?>
<style>

@media print
 {
 .signature {page-break-after:always;}
 }
</style>