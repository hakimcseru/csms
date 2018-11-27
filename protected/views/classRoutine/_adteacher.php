
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
<?php foreach($fmember as $fmem):

			$fm=FacultyMember::model()->findByPk($fmem['additional_faculty_member_id']);
			if($fm)
			{
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(class_period_id) FROM class_routine where $where and additional_faculty_member_id = '".$fmem['additional_faculty_member_id']."' order by id");
			$cperiod = $command->queryAll();
			
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(batch_section_id) FROM class_routine where $where and additional_faculty_member_id = '".$fmem['additional_faculty_member_id']."' order by batch_section_id");
			$section = $command->queryAll();
			
			
			$connection=Yii::app()->db;
			$command=$connection->createCommand("SELECT distinct(weekday) FROM class_routine where $where and additional_faculty_member_id = '".$fmem['additional_faculty_member_id']."' order by batch_section_id");
			$weekdayw = $command->queryAll();
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
		  
		  //echo $where;
		  foreach($weekdayw as $wd):?>
		  <tr>
          	<td>
            	<div><?php echo Bndate::BanglaWeekDay($wd['weekday']);?></div>
            </td>
			<?php // foreach($cperiod as $per):
			$srr2=ClassRoutine::model()->findAll($where." and additional_faculty_member_id = '".$fmem['additional_faculty_member_id']."' and weekday='".$wd['weekday']."' order by class_period_id");
			foreach($srr2 as $srr):
			
			?>
            <td>
			<div>
			<?php 
			$cp=ClassPeriod::model()->findByPk($srr['class_period_id']);
			
			echo Bndate::t(date("A h:i",strtotime($cp->start_time)))." - ".Bndate::t(date("h:i",strtotime($cp->end_time)));?></div>
			
		
			<div><?php echo $srr->course?$srr->course->course_name:"";?></div>
			<div><?php echo $srr->department?$srr->department->department_name:"";?></div>
			<div><?php echo $semester_name=CourseSemesterLebel::model()->semesterLebel($srr->course_id,$srr->semester_id,0).', শাখা: '; echo $srr->sescion->section_name;?></div>
            	<div><?php echo $srr->subject->subject_name;?></div>
                <div><?php echo $srr->facultyMember->member_name;?></div>
                
                <div><?php echo $srr->room->room_no;?></div>
            </td>
			<?php  endforeach;?>
			
		  </tr>
			<?php endforeach;?>
            
            
        </table>
    </td>
  </tr>
</table>
<div style="height:8px"></div>
<?php } endforeach;?>

