
<?php
$this->breadcrumbs=array(
	'Exam'=>array('index'),
	'Tabulation',
);
$position=1;
?>


<?php if(isset($model2))
{
?>
<form class="well form-search" id="searchForm" action="<?php echo Yii::app()->createUrl('examsetting/saveandLock');?>" method="post">	
<style>

.ured{color:red;-moz-text-decoration-color: red; text-decoration-color: red;}
body {margin:0; padding:0; font-family: SolaimanLipi,Arial,Helvetica,sans-serif; font-size: 15px !important;
	  color: #525252
	  }
.result_sheet{margin:15px; padding:0}
.result_sheet table{margin:0; background-color:#cecece}	  
.result_sheet table tr th{padding:6px 5px; font-weight:bold; background-color:#fafafa; color:#333; text-align:left}
.result_sheet table tr td{padding:0px 5px; font-weight:normal; background-color:#fff; text-align:left}
.result_sheet h1{margin:5px 0 0 0; padding:0; color:#333; font-size:20px; font-weight:bold; text-align:center}
.result_sheet h2{margin:0 0 5px 0; padding:0; color:#333; font-size:18px; font-weight:bold; text-align:center}
.result_sheet span{float:left}
.result_sheet span.txt_left{width:50%; text-align:left}
.result_sheet span.txt_right{width:50%; text-align:right}
.result_sheet input[type=text]{margin:3px 0 6px 0; padding:3px; font-size:15px; color:#525252; border:1px solid #ebebeb;
							   width:50px; height:15px;		
								}
								


.result_sheet2{margin:15px; padding:0}
.result_sheet2 table{margin:0; background-color:#cecece}	  
.result_sheet2 table tr th{padding:6px 5px; font-weight:bold; background-color:#fafafa; color:#333; text-align:left; border: 1px solid #EBEBEB;}
.result_sheet2 table tr td{padding:3px 5px; font-weight:normal; background-color:#fff; text-align:left;border: 1px solid #EBEBEB;}
.result_sheet2 h1{margin:5px 0 0 0; padding:0; color:#333; font-size:20px; font-weight:bold; text-align:center}
.result_sheet2 h2{margin:0 0 5px 0; padding:0; color:#333; font-size:18px; font-weight:bold; text-align:center}
</style>


<div class="result_sheet2">
        <table width="100%" border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td colspan="12">
            	<h1>বার্ষিক পরীক্ষা - <?php echo Bndate::t($model->session);?><input type="hidden" name="session_id" value="<?php echo $model->session;?>"></h1>
            	<h2>কার্যক্রম: <?php echo $model->coursec->course_name;?>
				<input type="hidden" name="batch_id" value="<?php echo $model->batch_id;?>">
				<input type="hidden" name="course_id" value="<?php echo $model->coursec->course_pk;?>">
				<input type="hidden" name="course" value="<?php echo $model->coursec->course_name;?>">
				, বিভাগ: <?php echo Department::model()->findByPk($model->department)->department_name;?>
				<input type="hidden" name="department_id" value="<?php echo $model->department;?>">
				<input type="hidden" name="department" value="<?php echo Department::model()->findByPk($model->department)->department_name;?>">
				
				, শ্রেণি: <?php echo CourseSemesterLebel::model()->semesterLebel($model->course,$model->semester,0);?>
				<input type="hidden" name="semester_id" value="<?php echo $model->semester;?>">
				<input type="hidden" name="semester" value="<?php echo CourseSemesterLebel::model()->semesterLebel($model->course,$model->semester,0);?>">
				
				, দল: <?php echo $model->batchgroup->group_name;?>
				
				<input type="hidden" name="batch_group_id" value="<?php echo $model->batchgroup->id;?>">
				<input type="hidden" name="batch_group" value="<?php echo $model->batchgroup->group_name;?>">
				</h2>
            </td>
          </tr>
		  
		  
		  
          <tr>
            <th>ক্রম</th>
            <th>নাম</th>
            <th>পরিচিতি</th>
			<?php //foreach($subjects as $sub):
			
			foreach($subjectse as $sub2): 
					
					$sub=CourseSubject::model()->find("course_subject_ref_course_pk=".$sub2->course." and course_subject_semester_no=".$model->semester." and course_subject_department_id=".$sub2->department." and course_subject_ref_subject_pk='".$sub2->subject."' ");
				$ssuubb[]=$sub->subject->subject_pk;	
				
				

			?>
            <th>পাঠ: <?php echo $sub->subject->subject_code;?><input type="hidden" name="subject_code[]" value="<?php echo $sub->subject->subject_code;?>"></th>
            
			<?php endforeach;?>
            <th>মোট</th>
            <th>মান</th>
			<th>স্থান</th>
            
          </tr>
		  
		  
          <tr>
            <th colspan="3">&nbsp;</th>
			<?php 
			$full_mark=0;
			foreach($subjectse as $sub2):
			$sub=CourseSubject::model()->find("course_subject_ref_course_pk=".$sub2->course." and course_subject_semester_no=".$model->semester." and course_subject_department_id=".$sub2->department." and course_subject_ref_subject_pk='".$sub2->subject."' ");
			
			$st_res3333=Examsetting::model()->find("session='".$model->session."' and course='".$sub2->course."' and department='".$sub2->department."' and  subject='".$sub2->subject."' AND semester ='".$model->semester."'
AND batch_id ='".$model->batch_id."'
AND batch_group ='".$model->batch_group."'");

			if(isset($st_res3333))
			{
				
			if($st_res3333->mark_type=="Grading")
			{
			$sfull="";
			}
			else{
			$sfull=$st_res3333->full_mark;
			}
			}
			
			?>
            <th><?php echo $sub->subject->subject_name;?>
			<input type="hidden" name="subject_name[]" value="<?php echo $sub->subject->subject_name;?>">
			<input type="hidden" name="subject_id[]" value="<?php echo $sub->subject->subject_pk;?>">
			
			
			
			<?php 
			$subject_full_marks=" ";
			if(is_numeric($sfull) && $sfull ){?>:<?php $full_mark=$full_mark+$sfull; echo Bndate::t($sfull);
			$subject_full_marks=$sfull;}?></th>
            <input type="hidden" name="subject_full_mark[]" value="<?php echo $sfull;?>">
			<?php endforeach;?>
            
            <th><?php 
			
			$st_res=StudentResult::model()->find("session='".$model->session."' and course='".$model->course."' and department='".$model->department."' and  subject='".$sub->course_subject_ref_subject_pk."' AND semester ='".$model->semester."'
AND batch_id ='".$model->batch_id."'
AND batch_group ='".$model->batch_group."'");
			$st_res22=$st_res;
			if(isset($st_res->examsetting))
			{
				
			if($st_res->examsetting->mark_type=="Grading")
			{
			echo "";
			$full_mark=0;
			}
			else{
			echo Bndate::t($full_mark);}}
			else echo Bndate::t($full_mark); ?>
			<input type="hidden" name="subject_total_mark" value="<?php echo $full_mark;?>">
			</th>
            <th colspan="2">&nbsp;</th>
          </tr>
		  
		  <?php 
		  
		  foreach($model2 as $mod):
		  $data=StudentEnrollmentInfo::model()->find("student_pk='".$mod['student_pk']."' and session='".$model->session."'");
		  ?>
          <tr>
            <td><?php echo Bndate::t($data->roll_no);?>
			<input type="hidden" name="roll_no[]" value="<?php echo $data->roll_no;?>"></td>
            <td><?php echo $data->student->student_name;?>
			<input type="hidden" name="name[]" value="<?php echo $data->student->student_name;?>"></td>
            <td><?php echo Bndate::t($data->student_id);?>
			<input type="hidden" name="student_id[]" value="<?php echo $data->student_id;?>"></td>
            <?php 
			$tmark=0;
			$fail=0;
			foreach($subjectse as $sub2):
			$sub=CourseSubject::model()->find("course_subject_ref_course_pk=".$sub2->course." and course_subject_semester_no=".$model->semester." and course_subject_department_id=".$sub2->department." and course_subject_ref_subject_pk='".$sub2->subject."' ");
			?>
			<td>
			<?php
			//echo "session='".$model->session."' and course='".$model->course."' and department='".$model->department."' and  subject='".$sub->course_subject_ref_subject_pk."' and student_pk='".$data->student_pk."' and student_id='".$data->student_id."'";
			//die();
			$st_res=StudentResult::model()->find("session='".$model->session."' and course='".$model->course."' and department='".$model->department."' and  subject='".$sub->course_subject_ref_subject_pk."' and student_pk='".$data->student_pk."' and student_id='".$data->student_id."'");
			//echo $sub->course_subject_ref_subject_pk;
			
			$sfm=0;
			/*if(isset($st_res->examsetting))
			{*/
			if(@$st_res22->examsetting->mark_type=="Grading")
			{
			echo @$st_res->full_marks;
			$sfm=@$st_res->full_marks;
			}
			else{
			if($st_res) $sfm=$st_res->full_marks; else {$sfm=0;$fail=1;}
			
			$tmark=$tmark+$sfm;
			if($sfm<$sub->pass_mark)
			{$fail=1;echo '<u class="ured">'.Bndate::t($sfm).'</u>';}
			else echo Bndate::t($sfm);
			}
			//}
			//else {echo Bndate::t($sfm);$fail=1;}
			//echo $sub->pass_mark;
			?>
			
			<input type="hidden" name="student_subject_marks<?php echo $data->student_id;?>[]" value="<?php echo $sfm;?>">
			</td>
			
			<?php endforeach;?>
            <td><?php 
			if(isset($st_res22->examsetting))
			{ 
			if($st_res22->examsetting->mark_type=="Grading")
			{
			echo "";
			}
			else{
			echo Bndate::t($tmark);
			}}
			else echo Bndate::t($tmark);
			?>
			<input type="hidden" name="total_number[]" value="<?php echo $tmark;?>">
			</td>
            <td>
			<?php
			$sresult=" ";
			if(@$st_res22->examsetting->mark_type=="Grading")
			{
			echo "";
			
			}
			else{	//echo "fail=".$fail;
										if($fail==0)
										{
										$per=($tmark/$full_mark)*100;
										$per=number_format($per, 2, '.', '');
										//echo "session='".$model->session."' and	'".$per."'>=start_limit and '".$per."'<=end_limit";
										$res=ResultSetings::model()->find("session='".$model->session."' and	'".$per."'>=start_limit and '".$per."'<=end_limit");
										if($res) echo $sresult=$res->result; else echo $sresult="NA";
										}
										elseif($fail==1)
										{										
										$per=($tmark/$full_mark)*100;
										$per=number_format($per, 2, '.', '');											
										if($per>=50) echo $sresult="বিশেষ বিবেচনায় উত্তীর্ণ";
										else echo $sresult="অকৃতকার্য";
										
										}
										
					}
									
								
										?>
										<input type="hidden" name="result[]" value="<?php echo $sresult;?>">
			</td>
           <td>
		   <?php
		   $spos=" ";
		  
			if(@$st_res22->examsetting->mark_type=="Grading")
			{
			echo "";
			}
			else{
		   if($fail==0)
		   {
			/*echo Bndate::t($position); $spos=$position;
		  $position++;*/
		   
		    $allsub=implode(",",$ssuubb);
		   $connection=Yii::app()->db;
		   
        $command=$connection->createCommand("SELECT distinct(student_pk) FROM student_result where

		session='".$model->session."' and
		course='".$model->course."' and
		department='".$model->department."' and
		semester='".$model->semester."' and
		batch_id='".$model->batch_id."' and
		batch_group='".$model->batch_group."' and
		
		subject in ( $allsub )
		
		group by student_pk having sum(full_marks) > $tmark
		");
		$hm = $command->queryAll();
		echo $spos=Bndate::t(count($hm)+1);
		}
		}
		
		?>
		<input type="hidden" name="position[]" value="<?php echo $spos;?>">
		   </td>
          </tr>
		  <?php endforeach;?>
          
          </tr>
        </table>
    </div>  
	
	<input type="text" name="published_date" class="datepicker" /> <input type="submit" name="submit" value="Save & Lock" />
	</form>
<?php }
else {
?>
<?php 


echo $this->renderPartial('_tabulation', array('model'=>$model)); }?>
