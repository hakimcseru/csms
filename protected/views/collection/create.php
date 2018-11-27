<style>
    .input-xlarge, .input-small{
        height:28px;
    }
	
</style>

<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collections')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List StudentCollection','url'=>array('index')),
	array('label'=>'Manage StudentCollection','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Student Collection') ?></h1>

<form method="post" action="/nsms/bn/collection/create" id="student-collection-form" class="form-vertical">
	
</form>
<form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/collection/create" id="searchForm" class="well form-search">	
    <div class="input-prepend"><span class="add-on"><i class="icon-search"></i></span><input type="text" id="TestForm_textField" name="IDSearchForm[searchid]" placeholder="Text input" class="input-xlarge">
	<input type="text" id="TestForm_session" name="IDSearchForm[session]" placeholder="Session" class="input-small">
	<input type="text" id="TestForm_deposit_date" name="IDSearchForm[deposit_date]" placeholder="" class="input-small" value="<?php echo date("Y-m-d");?>">
	</div>
	<button name="yt5" type="submit" id="yw126" class="btn">Go</button>
</form>

<?php if(Yii::app()->user->hasFlash('success')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('success'); ?>
</div>

<?php else: ?>
<?php 

if($status=="show")
{
?>   
<div class="tab-pane" id="present_enrollment_info">
    
     <div style="width:50%; height: auto; float: left;">
                            
         <table class="detail-view table table-striped table-condensed">
             <tr>
                 <th style="text-align: left;">SN</th>
                 <th style="text-align: left;">Year</th>
                 <th style="text-align: left;">Month</th>
                 <th style="text-align: left;">Amount</th>
                 <th style="text-align: left;">Description</th>
                 
             </tr>
             <?php 
             $i=1;$total=0;
             
             $StudentDues2=StudentDues::model()->findAll("student_pk='".$model2->student_pk."' and year='".$_POST['IDSearchForm']['session']."'");
             foreach($StudentDues2 as $studentDues):
                 
                 echo '
                 <tr>
                 <td>'.$i++.'</td>
                 <td>'.$studentDues->year.'</td>
                 <td>'.$studentDues->month.'</td>
                 <td>'.$studentDues->due_amount.'</td>
                 <td>'.$studentDues->comment.'</td>
                 
                </tr>';
             $total=$total+$studentDues->due_amount;
             endforeach;
             $StudentFine2=StudentFine::model()->findAll("student_pk='".$model2->student_pk."' and year='".$_POST['IDSearchForm']['session']."'");
             
             foreach($StudentFine2 as $studentFine):
                 
                 echo '
                 <tr>
                 <td>'.$i++.'</th>
                 <td>'.$studentFine->year.'</td>
                 <td>'.$studentFine->month.'</td>
                 <td>'.$studentFine->amount.'</td>
                 <td>'.$studentFine->comment.'</td>
                 
                </tr>';
             $total=$total+$studentFine->amount;
             endforeach;?>
             
                <tr>
                  <th colspan="3" style="text-align: right;">Previous Balance=</th>
                 <th style="text-align: left;">
                     <?php 
					 $Remaining=StudentRemaining::model()->find("student_pk='".$model2->student_pk."' and session_id='".$_POST['IDSearchForm']['session']."'");
					 //echo $rem=$model2->StudentRemaining?$model2->StudentRemaining->remaining_amount:0;
					 if($Remaining) echo $rem=$Remaining->remaining_amount; else echo $rem=0;
					 
					 ?>
                     </th>
                     <th></th>
                
                </tr>
                
              <tr>
                  <th colspan="3" style="text-align: right;">Total=</th>
                 <th style="text-align: left;"><?php echo ($total-$rem);?></th>
                <th></th>
                </tr>
                
         </table>
         
         <?php  if($model) echo $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2)); ?>
         
         
         
                        </div>
    <div style="width:15%; height: auto; float: right;">
                            <img src="<?php echo Yii::app()->request->getBaseUrl(TRUE)?>/images/student/<?php echo $model2->student_image;?>" />
                        </div><div style="width:30%; height: auto; float: right;">
			<?php 
			
			$model223=StudentEnrollmentInfo::model()->find("student_pk='".$model2->student_pk."' and  session='".$_POST['IDSearchForm']['session']."'");
			
			if($model223)
			{
			$this->widget('ext.bootstrap.widgets.BootDetailView',array(
				'data'=>$model223,
				'attributes'=>array(

				//'student_name',
				array(
						'name'=>'student.student_name',
						'type'=> 'html',
						'value'=> nl2br(Bndate::t($model223->student->student_name)),
					),
				array(
						'name'=>'student_id',
						'type'=> 'html',
						'value'=> nl2br(Bndate::t($model223->student_id)),
					),
					array(
						'name'=>'EnrollmentInfo.session',
						'type'=> 'html',
						'value'=> nl2br(Bndate::t($model223->session)),
					),

						array(
								'name'=>'EnrollmentInfo.enrollment_status',
								'type'=> 'html',
								'value'=> nl2br(Yii::t('core',$model223->enrollment_status)),
						),

					array(
									'name'=>'EnrollmentInfo.course_id',
									'type'=> 'html',
									'value'=> nl2br($model223->course->course_name),
									),

						array(
								'name'=>'EnrollmentInfo.department_id',
								'type'=> 'html',
								'value'=> nl2br($model223->department->department_name),
						),

						array(
								'name'=>'EnrollmentInfo.batch_id',
								'type'=> 'html',
								'value'=> nl2br($model223->batch->batch_id),
						),
						array(
								'name'=>'EnrollmentInfo.batch_group',
								'type'=> 'html',
								'value'=> nl2br($model223->batchgroup->group_name),
						),

						array(
								'name'=>'EnrollmentInfo.semester',
								'type'=> 'html',
								'value'=> nl2br(CourseSemesterLebel::model()->semesterLebel($model223->course_id,$model223->semester)),
						),

						array(
								'name'=>'EnrollmentInfo.roll_no',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($model223->roll_no)),
						),


				),
			)); 
			}
			?>
    
</div>
                            
		</div>
<?php
} else echo "Not Match";

?>
<?php endif; ?>

