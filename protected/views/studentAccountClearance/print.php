

	<table class="table">
<tr>

<th><strong>পরিচিতি</strong></th>
<th>ক্রম</th>
<th>শিক্ষার্থী</th>
<th> <label>বিভাগ</label></th>
<th><label>শ্রেণি</label></th>
<th> <label>দল</label></th>

</tr>


<?php 
$counter=1;

foreach($stids as $stid):

$mod=StudentEnrollmentInfo::model()->findByPk($stid);
$detail=$mod->student;
?>

<tr>



<td> <strong><?php echo Bndate::t($detail->student_id);?></strong></td>
<td> <strong><?php echo Bndate::t($mod->roll_no);?></strong></td>
<td><?php echo $detail->student_name;?></td>
<td><?php echo $mod->department->department_name;?></td>
<td><?php echo CourseSemesterLebel::model()->semesterLebel($mod->course_id,$mod->semester);?></td>
<td><?php echo $mod->batchgroup->group_name;?></td>

</tr>
		
<?php

endforeach;
?>
</table>
