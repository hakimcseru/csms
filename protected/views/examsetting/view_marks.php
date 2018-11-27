<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/marks.css" rel="stylesheet" type="text/css" media="all" />

<style>
	table, table th, table td{text-align:center}
</style>
 


 

<?php 
/*
echo $model->id;

echo $model->session;
echo $model->course;
echo $model->department;
echo $model->semester;
echo $model->subject;
echo $model->mark_type;

$students=StudentEnrollmentInfo::model()->findAll("course_id=".$model->course." and semester=".$model->semester." and department_id=".$model->department." and session=".$model->session);
foreach($students as $student):
 $student->student->student_name;
$teachers=ExamsettingFacultymember::model()->findAll("examsetting_id=".$model->id);
foreach($teachers as $teacher):

 $teacher->facultyMember->member_name.",  ";
 $teacher->faculty_member_id;
 endforeach;
 endforeach; */
 ?>
 <input type="hidden" value="<?php echo $model->id; ?>"  name="id" />
  <div class="result_sheet">
        <table width="95%" border="1" cellspacing="1" cellpadding="3" align="center">
          <tr>
            <td colspan="6">
            	<h1 style="text-align:center">বার্ষিক পরীক্ষা  - <?php echo Bndate::t($model->session);?></h1>
				<h2 style="text-align:center"><?php echo $model->coursec->course_name;?>, <?php echo $model->departments->department_name;?>, <?php echo nl2br(CourseSemesterLebel::model()->semesterLebel($model->course,$model->semester));?>, <?php echo $model->batchgroup->group_name;?></h2>
            	<h2 style="text-align:center">বিষয়: <?php echo $model->subjects->subject_name;?>, পূর্ণমান: <?php $fm=CourseSubject::model()->find("course_subject_ref_course_pk='".$model->course."' and course_subject_ref_subject_pk='".$model->subject."' and course_subject_semester_no='".$model->semester."' and  course_subject_department_id='".$model->department."' ");
				if($fm) echo Bndate::t($fm->full_mark);
				?></h2>
            </td>
          </tr>
          <tr>
		    <th>ক্রম</th>
            <th>নাম</th>
            <th>পরিচিতি</th>
            <th>
                <span class="txt_left"> <?php //echo $model->subjects->subject_name;?> </span>
                <span class="txt_right">প্রাপ্ত নম্বর (শিক্ষক অনুযায়ী)
				
				
				</span> 
            </th>
			<th>মোট প্রাপ্ত নম্বর</th>
			<th>মান</th>
          </tr>
		  
		  <?php $students=StudentEnrollmentInfo::model()->findAll("course_id=".$model->course." and semester=".$model->semester." and department_id=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group." order by roll_no asc");
foreach($students as $student):  ?>
          <tr>
		    <td><?php echo  Bndate::t($student->roll_no);?></td>
            <td><?php echo  $student->student->student_name;?></td>
            <td><?php echo Bndate::t( $student->student_id);?></td>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				 
                  <tr>
				  <?php $teachers=ExamsettingFacultymember::model()->findAll("examsetting_id=".$model->id);
				  $stmarks=0;
foreach($teachers as $teacher):

$value=ExamMarks::model()->find("student_pk=".$student->student_pk." and course=".$model->course." and semester=".$model->semester." and department=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group." and teacher_id=".$teacher->faculty_member_id." and subject='".$model->subject."'");
if($value){
$stmarks+=$value->marks;
}
?>				
                    <td><?php echo $teacher->facultyMember->member_name;?><br />
					 <?php if(isset($value->marks)) echo Bndate::t($value->marks);?>
					
					</td>
                     <?php endforeach;?>
					 
					<?php $res=StudentResult::model()->find("student_pk=".$student->student_pk." and course=".$model->course." and semester=".$model->semester." and department=".$model->department." and session=".$model->session." and batch_id=".$model->batch_id." and batch_group=".$model->batch_group." and subject='".$model->subject."'");?>
					

					 
					 	
                  </tr>
                 
                </table>
            </td>
			<td><?php echo $res?Bndate::t($res->full_marks):"";?></td>
			<td><?php echo $res?Bndate::t($res->result):""; ?></td>
          </tr>
         <?php endforeach;?>
          
          
        </table>
    </div> 
	
 
 



