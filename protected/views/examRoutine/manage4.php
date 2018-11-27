<h1 style="text-align:center">আজকের পরীক্ষা</h1>
<h3 style="text-align:center"><?php echo Bndate::BanglaNumDate(date("d F, Y",strtotime($date)));?></h3>

<br/>
<style>
.table th, .table td {
    border: 1px solid #DDDDDD !important;
	}
</style>



<table class="table">

<?php 
$a=1;
foreach ($cnn as $cn):
$mmd2=ExamRoutineDetail::model()->findAll("session_id='".$model->session_id."' and  
batch_id='".$cn->batch_id."' and 
course_id='".$cn->course_id."' and
department_id='".$cn->department_id."' and 
batch_group_id='".$cn->batch_group_id."'

and exam_date_id in ( ".$dcdc." )  and exam_routine_id='".$model->id."'");
if(isset($mmd2) && $mmd2)
{
if(($a % 9)==0) $stt=" page-break-after: always;";
else $stt="";
echo '<tr style="'.$stt.'">
<th width="80">';
echo $cn->course->course_name.'<br />';
echo $cn->department->department_name.'<br />';
echo $cn->semesterLevel->lebel.'<br />';
echo $cn->batchgroup->group_name.'<br />';

'</th>';
	
	foreach ($mmd2 as $per):
?>
<td >
<?php 

		//echo $per->subject->subject_name."<br>";
		echo $per->batch_section?Bndate::t($per->batch_section->start_role)."-".Bndate::t($per->batch_section->end_role)."<br />":"";
		echo $per->subject?$per->subject->subject_name."<br />":"";
		echo $per->room?$per->room->room_no."<br>":"";
		echo $per->course?$per->exam_time."<br>":"";


?>
</td>
<?php 

	endforeach;
echo '</tr>';
$a++;
}

endforeach;
?>

</table>
            


