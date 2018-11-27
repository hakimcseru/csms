<script>
$(function () {
       $('#select-all').click(function (event) {

           var selected = this.checked;
           // Iterate each checkbox
           $(':checkbox').each(function () {    this.checked = selected; });

       });
    });
</script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles_card_vertical.css" />
<?php $t=0;?>
<form action="<?php echo Yii::app()->createUrl('studentAccountClearance/create');?>" method="POST">
<?php foreach($subjects as $subject):?>

<input type="checkbox" value="<?php echo $subject->course_subject_pk;?>" name="subjects[]" /><?php echo $subject->subject->subject_name;?> <br>

<?php endforeach;?>
<table class="table">
<tr>
<th> </th>
<th><strong>সংখ্যা</strong></th>
<th><strong>পরিচিতি</strong></th>
<th>ক্রম</th>
<th>শিক্ষার্থী</th>
<th> <label>বিভাগ</label></th>
<th><label>শ্রেণি</label></th>
<th> <label>দল</label></th>
<th> <label>Present</label>%</th>

</tr>
<tr><td><input type="checkbox" name="select-all" id="select-all" /></td></tr>
<input type="hidden" value="<?php echo $card_type; ?>" name="type" />
<?php 
$counter=1;
foreach($model as $mod):
$eninfo=$mod;
$detail=$mod->student;
?>
<?php 
if($mod->full_free=="Yes") $clear_payment=1;
else 
$clear_payment= StudentCollection::model()->find('student_pk='.$mod->student->student_pk." and collection_id!=0 and session_id='$session_id' and month='12'");

if($clear_payment)

{
?>
<?php

$array1 = array(); 
$tot_class=ClassRoutine::model()->findAll("session_id='".$eninfo->session."' 
and course_id='".$eninfo->course_id."' 
and department_id='".$eninfo->department_id."' 
and batch_id='".$eninfo->batch_id."' and 
 batch_group_id='".$eninfo->batch_group."' 
 and semester_id='".$eninfo->semester."' group by calendar_id,weekday");
//echo count($tot_class);
$final_res=array();
$final_res2=array();
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
	
	
	$tot_holiday=AttendanceCalendar::model()->findAll("course_id=".$eninfo->course_id." and date >='$tstart_date' and date <='$tend_date'  ");

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



$tot_presence=StudentAttendanceData::model()->findAll("date in ($comma_separated) and date not in ($comma_dhd)  and student_id=".$eninfo->student_pk." group by date");

foreach($tot_presence as $pre):

$total_present[]=$pre->date;

$dadd=date("H:i:s",strtotime($pre->time)); 


$final_ins[$pre->date][]=$dadd;
endforeach;

//print_r($total_holiday);
?>



					
                        <?php $tclass=count($final_res2);?>
                     
						<?php $total_pre=round((count($total_present)/$tclass)*100,2);
						
						
						
						?>
                        


					
					
<tr>

<td><input type="checkbox" value="<?php echo $mod->id;?>" name="stlist[]" /></td>
<td> <strong><?php $t++;echo Bndate::t($t);?></strong></td>
<td> <strong><?php echo Bndate::t($detail->student_id);?></strong></td>
<td> <strong><?php echo Bndate::t($mod->roll_no);?></strong></td>
<td><?php echo $detail->student_name;?></td>
<td><?php echo $mod->department->department_name;?></td>
<td><?php echo CourseSemesterLebel::model()->semesterLebel($mod->course_id,$mod->semester);?></td>
<td><?php echo $mod->batchgroup->group_name;?></td>
<td><?php echo $total_pre;?>%</td>
                   

</tr>
		
<?php
}}
endforeach;
?>
</table>
<button class="btn btn-primary" name="yt1" type="submit"><?php echo Yii::t('core','Create');?></button>
<button class="btn btn-primary" name="yt2" type="submit"><?php echo Yii::t('core','Print');?></button>
</form>	
