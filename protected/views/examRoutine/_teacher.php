<?php
$cname=$_POST['Student']['calendar_name'];
$session=$_POST['Student']['session'];

$fmember=FacultyMember::model()->findAll("1 order by member_name");
			
			
?>


<style>
	body{
	margin:0px 8px;
    padding:0;	
    font-family:Arial,Helvetica,sans-serif,SolaimanLipi;
    }
 	h4{margin:0; padding:0; font-size:15px; text-align:center; color:#333}
	.routine_tbl{border-collapse:collapse; border-spacing:0; color:#333; font-size:12px}
	.routine_tbl tr th{padding:2px; background-color:#fafafa; text-align:left; font-weight:bold; border:1px solid #ccc; vertical-align:middle}
	.routine_tbl tr td{padding:2px; text-align:left; border:1px solid #ccc; vertical-align:middle}
	.routine_tbl tr td div{line-height:normal}
	
	
	@media print
	{
	table {page-break-after:always;}
	}

</style>
<?php 
//echo count($fmember);

foreach($fmember as $fm):

			//echo "(faculty_member_id=$fm->member_pk or additional_faculty_member_id=$fm->member_pk) and exam_routine_id='$cname' and session_id='$session'";
			
			//echo '<br/>';
			
			//continue;
$exr=ExamRoutineDetail::model()->findAll(array('condition'=>"(t.faculty_member_id=$fm->member_pk or t.additional_faculty_member_id=$fm->member_pk or t.additional_faculty_member_id2=$fm->member_pk or t.additional_faculty_member_id3=$fm->member_pk or t.additional_faculty_member_id4=$fm->member_pk or t.additional_faculty_member_id5=$fm->member_pk ) and t.exam_routine_id='$cname' and t.session_id='$session' ",
'with'=>array('exam_date'),
 'order'=> 'exam_date.exam_date, exam_date.id ASC',
 ));	
 /*
 $exr=ExamRoutineDetail::model()->findAll("(faculty_member_id=$fm->member_pk or additional_faculty_member_id=$fm->member_pk) and exam_routine_id='$cname' and session_id='$session'");	
 */
if($exr)
{				
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><h4><?php echo $fm->member_name;?></h4></td>
  </tr>
  <tr>
    <td><h4>অনুষদ : <?php echo $fm->faculty->faculty_name;?>, বিভাগ : <?php echo $fm->department->department_name;?></h4></td>
  </tr>
  <tr>
  	<td height="3"></td>
  </tr>
 
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="routine_tbl">
          
		  
		  <?php 
		  $i=1;
		  foreach($exr as $riou ): 
		  
		  if($i%8==1)
			{
		  ?>
          <tr>
		  <?php } ?>
		  
		  
		  
          	
			
            <td>
			
			<?php echo Bndate::BanglaNumDate(date("d F Y",strtotime($riou->exam_date->exam_date)));?>
			<br/>
			<?php echo Bndate::BanglaWeekDay(date("l",strtotime($riou->exam_date->exam_date)));?>
			<br/>
			<?php echo $riou->exam_time;?>
			<br/>
			<?php echo $riou->course->course_name;?>
			<br/>
			<?php echo $riou->department->department_name;?>
			<br/>
			
			<?php echo CourseSemesterLebel::model()->semesterLebel($riou->course_id,$riou->semester_id);?>
			<br/>
			
			<?php echo $riou->subject->subject_name;?>
			<br/>
			<?php 
			
			if($riou->faculty_member_id!=$fm->member_pk)
			echo $riou->facultyMember?$riou->facultyMember->member_name."<br/>":"";
			if($riou->additional_faculty_member_id!=$fm->member_pk)
			echo $riou->A_facultyMember?$riou->A_facultyMember->member_name."<br/>":"";
			if($riou->additional_faculty_member_id2!=$fm->member_pk)
			echo $riou->A_facultyMember2?$riou->A_facultyMember2->member_name."<br/>":"";
			if($riou->additional_faculty_member_id3!=$fm->member_pk)
			echo $riou->A_facultyMember3?$riou->A_facultyMember3->member_name."<br/>":"";
			if($riou->additional_faculty_member_id4!=$fm->member_pk)
			echo $riou->A_facultyMember4?$riou->A_facultyMember4->member_name."<br/>":"";
			if($riou->additional_faculty_member_id5!=$fm->member_pk)
			echo $riou->A_facultyMember5?$riou->A_facultyMember5->member_name."<br/>":"";?>
			
			
			
			
			
			<?php echo $riou->room->room_no;?>
			
			
		
			
			
			
            	
            </td>
			
			<?php 
if($i%8==0)
{ echo '</td>';}
?>
		 
			 
            
            <?php $i++; endforeach; ?>
			
			<?php 
if(($i-1)%8!=0) { 

if(count($exr)>8)
		  {
for($j=1;$j<=(8-($i-1)%8);$j++) echo "<td></td>";
}

echo '</tr>';}
?>
        </table>
    </td>
  </tr>
</table>
<div style="height:8px"></div>
<?php }?>

<?php endforeach;?>


