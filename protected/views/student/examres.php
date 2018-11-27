<?php
$this->breadcrumbs=array(
	Yii::t('core','Student')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List Student','url'=>array('index')),
	array('label'=>'Manage Student','url'=>array('admin')),
);
?>
<style>
    .input-xlarge, .input-small{
        height:28px;
    }
	
</style>

<h1><?php echo Yii::t('core','Exam Registration');?></h1>

<form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/student/examres" id="searchForm" class="well form-search">	
    <div class="input-prepend"><span class="add-on"><i class="icon-search"></i></span><input type="text" id="TestForm_textField" name="IDSearchForm[searchid]" placeholder="Text input" class="input-xlarge">
	
	
	</div>
	<button name="yt5" type="submit" id="yw126" class="btn">Go</button>
</form>

<?php if(isset($model->student_id))
{

$eninfo=$model->EnrollmentInfoLast;

if($eninfo)
{
?>


                    
<div class="span5">
    <div class="well">
    <h4>Enrollment information</h4>					  
                        
                        

<div class="tab-pane" id="present_enrollment_info">
			<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
				'data'=>$eninfo,
				'attributes'=>array(

					array(
						'name'=>'session',
						'type'=> 'html',
						'value'=> nl2br(Bndate::t($eninfo->session)),
					),

						array(
								'name'=>'enrollment_status',
								'type'=> 'html',
								'value'=> nl2br(Yii::t('core',$eninfo->enrollment_status)),
						),

					array(
									'name'=>'course_id',
									'type'=> 'html',
									'value'=> nl2br($eninfo->course->course_name),
									),

						array(
								'name'=>'department_id',
								'type'=> 'html',
								'value'=> nl2br($eninfo->department->department_name),
						),

						array(
								'name'=>'batch_id',
								'type'=> 'html',
								'value'=> nl2br($eninfo->batch->batch_id),
						),
						array(
								'name'=>'batch_group',
								'type'=> 'html',
								'value'=> nl2br($eninfo->batchgroup->group_name),
						),

						array(
								'name'=>'semester',
								'type'=> 'html',
								'value'=> nl2br(CourseSemesterLebel::model()->semesterLebel($eninfo->course_id,$eninfo->semester)),
						),

						array(
								'name'=>'roll_no',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($eninfo->roll_no)),
						),


				),
			)); ?>
		</div>
</div>
</div>

<div class="span5">
    <div class="well">
    <h4>Exam Result</h4>
		<?php 
		$res=SavedResult::model()->find("session_id='".$eninfo->session."' and student_id='".$eninfo->student_id."'") ;
		if(isset($res))
		echo "Result: ".$res->result." <br /> Position: ".$res->position;
		else echo "No result found";
		?>
	</div>
</div>
<div style="clear:both;"></div>
<?php } } echo $this->renderPartial('_examres', array('model'=>$model)); 


?>