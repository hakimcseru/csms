<style>

	body
	{margin:0px; padding:0; font-family:Arial,Helvetica,sans-serif,SolaimanLipi}
	
	.stu_attendance
	{margin:0 auto; margin-top:30px; width:800px; font-size:14px; font-weight:normal; height:auto; overflow:hidden}
	
	h4{margin:0; padding:0; font-size:16px; text-align:center; color:#333}
	
	.student_tbl
	{border-collapse:collapse; border-spacing:0; color:#333; font-size:14px}
	
	.student_tbl tr th
	{padding:8px; background-color:#fafafa; text-align:left; font-weight:bold; border:1px solid #ccc; vertical-align:middle}
		
	.student_tbl tr td
	{padding:8px; text-align:left; border:1px solid #ccc; vertical-align:middle}
	
</style>
<?php echo $this->renderPartial('_stform', array('model'=>$model)); ?>

    <div class="stu_attendance">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td><h4><?php echo Yii::t('core','Students Attendances Report');?></h4></td>
          </tr>
          <tr>
            <td align="center">কার্যক্রম: <?php echo $model->course->course_name;?>, বিভাগ: <?php echo $model->department->department_name;?>, শ্রেণি: <?php echo CourseSemesterLebel::model()->semesterLebel($model->course_id,$model->semester_id);?>, দল: <?php echo $model->batchgroup->group_name;?>	</td>
          </tr>
          <tr>
          	<td>&nbsp;</td>
          </tr>
          <tr>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="student_tbl">
                	<tr>
						
                    	<th width="8%">সংখ্যা</th>
                        <th width="19%">পরিচিতি</th>
                        <th width="29%">শিক্ষার্থী</th>
						<th width="8%">ক্রম</th>
                        <th width="15%">মোট দিন</th>
                        <th width="15%">মোট উপস্থিতি</th>
                        <th width="14%">শতকরা উপস্থিতি</th>
                    </tr>
<?php

$totals=0;
//echo "course_id ='".$model->course_id."' and  batch_id='".$model->batch_id."' and  batch_group= '".$model->batch_group_id."' and  semester='".$model->semester_id."' and session='".Bndate::get_year(date("Y-m-d"))."'";
$student_eninfo=StudentEnrollmentInfo::model()->findAll("session='".$model->session_id."' and course_id ='".$model->course_id."' and  batch_id='".$model->batch_id."' and  batch_group= '".$model->batch_group_id."' and  semester='".$model->semester_id."'  order by roll_no");
//echo count($student_eninfo); die();
$i=1;
foreach($student_eninfo as $eninfo)
{

//echo "session_id=".$eninfo->session." and course_id=".$eninfo->course_id." and department_id=".$eninfo->department_id." and batch_id=".$eninfo->batch_id." and  batch_group_id=".$eninfo->batch_group." and semester_id=".$eninfo->semester." group by calendar_id,weekday"; //die();

$array1 = array();
$tot_class=ClassRoutine::model()->findAll("session_id=".$eninfo->session." and course_id=".$eninfo->course_id." and department_id=".$eninfo->department_id." and batch_id=".$eninfo->batch_id." and  batch_group_id=".$eninfo->batch_group." and semester_id=".$eninfo->semester." group by calendar_id,weekday");
//echo count($tot_class);
$final_res=array();
$final_res2=array();
$total_present = array();

$today=date("Y-m-d");
/// i added here
//echo $eninfo->session;
$bnsession=Bndate::get_year($today);
if($bnsession>$eninfo->session)
{$yyy=$eninfo->session+594; $today=$yyy."-04-13";}

//echo $today; die();
// i added here


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


$tclass=count($final_res2);
$presence=round((count($total_present)/$tclass)*100,2);

if($model->range<=$presence)
{
$totals++;

?>



					<tr>
						<td><?php echo Bndate::t($i); $i++;?></td>
                        <td><?php echo Bndate::t($eninfo->student_id);?></td>
                        <td><?php echo $eninfo->student->student_name;?></td>
						<td><?php echo Bndate::t($eninfo->roll_no);?></td>
                        <td><?php echo Bndate::t($tclass);?></td>
                        <td><?php echo Bndate::t(count($total_present));?></td>
                        <td><?php echo Bndate::t($presence);?>%</td>
                    </tr>


<?php }
}}?>

                    
                     
        </table>
    </td>
	</tr>
	</table>

	</div>    