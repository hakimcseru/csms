<?php
$this->breadcrumbs=array(
	Yii::t('core','Student')=>array('index'),
	Bndate::t($model->student_id),
);

$this->menu=array(
	array('label'=>'List Student','url'=>array('index')),
	array('label'=>'Create Student','url'=>array('create')),
	array('label'=>'Update Student','url'=>array('update','id'=>$model->student_pk)),
	array('label'=>'Delete Student','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->student_pk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Student','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Student')?>: <?php echo $model->student_name.' ('.Bndate::t($model->student_id).')'; ?></h1>

<ul class="nav nav-pills">
	<li ><a href="#basic" data-toggle="pill"><?php echo Yii::t('core','BASIC INFO')?></a></li>

	<li><a href="#contacts" data-toggle="pill"><?php echo Yii::t('core','CONTACT INFO')?></a></li>
	<li><a href="#present_enrollment_info" data-toggle="pill"><?php echo Yii::t('core','PRESENT ENROLLMENT INFO')?></a></li>
	<li><a href="#previous_enrollment_info" data-toggle="pill"><?php echo Yii::t('core','PREVIOUS ENROLLMENT INFO')?></a></li>

	<li class="active"><a href="#fees_info"  data-toggle="pill"><?php echo Yii::t('core','FEES INFO')?></a></li>
	<li><a href="#attendance_info" data-toggle="pill"><?php echo Yii::t('core','ATTENDANCE INFO')?></a></li>
	<li><a href="#routine_info" data-toggle="pill"><?php echo Yii::t('core','ROUTINE INFO')?></a></li>
	<li><a href="#syllabus_info" data-toggle="pill"><?php echo Yii::t('core','SYLLABUS')?></a></li>

	<li><a href="#notice" data-toggle="pill"><?php echo Yii::t('core','NOTICE')?></a></li>
	<li><a href="#result" data-toggle="pill"><?php echo Yii::t('core','RESULT')?></a></li>

</ul>
<div id="studentTab">
<div class="tab-content">
		<div class="tab-pane" id="basic" >
                    
                    <div style="width:70%; height: auto; float: left;">
			<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
				'data'=>$model,
				'attributes'=>array(

						array(
								'name'=>'student_id',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($model->student_id)),
						),
						'student_name',

						array(
								'name'=>'student_dob',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($model->student_dob)),
						),
					'student_father_name',
					'student_mother_name',
					'student_nationality',

						array(
								'name'=>'student_gender',
								'type'=> 'html',
								'value'=> nl2br(Yii::t('core',$model->student_gender)),
						),
					'student_blood_group',
						'occupation',

				),
			)); ?>
                    </div>
                        <div style="width:30%; height: auto; float: right;">
                            <img src="<?php echo Yii::app()->request->getBaseUrl(TRUE)?>/images/student/<?php echo $model->student_image;?>" />
                        </div>
		</div>

		<div class="tab-pane" id="contacts">
			<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
				'data'=>$model,
				'attributes'=>array(

						array(
								'name'=>'student_email',
								'type'=> 'html',
								'value'=> nl2br($model->student_email),
						),
						array(
								'name'=>'student_contact',
								'type'=> 'html',
								'value'=> nl2br($model->student_contact),
						),
					array(
						'name'=>'student_present_address',
						'type'=> 'html',
						'value'=> nl2br($model->student_present_address),
					),
					array(
						'name'=>'student_permanent_address',
						'type'=> 'html',
						'value'=> nl2br($model->student_permanent_address),
					),


					array(
						'name'=>'student_alternate_contact',
						'type'=> 'html',
						'value'=> nl2br($model->student_alternate_contact),
					),
				),
			)); ?>
		</div>
		
		<div class="tab-pane" id="present_enrollment_info">
			
			<?php 
			$cvf=$model->EnrollmentInfoPresent;
			
			//foreach($model->EnrollmentInfoAll as $Enrollmet):?>
			<div class="span5">
			<div class="well">
			<?php
			if($cvf)
			{
			$this->widget('ext.bootstrap.widgets.BootDetailView',array(
				'data'=>$cvf,
				'attributes'=>array(

					array(
						'name'=>'session',
						'type'=> 'html',
						'value'=> nl2br(Bndate::t($cvf->session)),
					),

						array(
								'name'=>'enrollment_status',
								'type'=> 'html',
								'value'=> nl2br(Yii::t('core',$cvf->enrollment_status)),
						),

					array(
									'name'=>'course_id',
									'type'=> 'html',
									'value'=> nl2br($cvf->course->course_name),
									),

						array(
								'name'=>'EnrollmentInfo.department_id',
								'type'=> 'html',
								'value'=> nl2br($cvf->department->department_name),
						),

						array(
								'name'=>'EnrollmentInfo.batch_id',
								'type'=> 'html',
								'value'=> nl2br($cvf->batch->batch_id),
						),
						array(
								'name'=>'EnrollmentInfo.batch_group',
								'type'=> 'html',
								'value'=> nl2br($cvf->batchgroup->group_name),
						),

						array(
								'name'=>'EnrollmentInfo.semester',
								'type'=> 'html',
								'value'=> nl2br(CourseSemesterLebel::model()->semesterLebel($cvf->course_id,$cvf->semester)),
						),

						array(
								'name'=>'EnrollmentInfo.roll_no',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($cvf->roll_no)),
						),


				),
			)); 
			} else echo "No information is available.";
			?>
			</div></div>
			<?php
			//endforeach;
			?>
		</div>

		<div class="tab-pane" id="previous_enrollment_info">
		
		
		<?php 
			
			foreach($model->EnrollmentInfoPast as $Enrollmet):?>
			<div class="span5">
			<div class="well">
			<?php
			$this->widget('ext.bootstrap.widgets.BootDetailView',array(
				'data'=>$Enrollmet,
				'attributes'=>array(

					array(
						'name'=>'session',
						'type'=> 'html',
						'value'=> nl2br(Bndate::t($Enrollmet->session)),
					),

						array(
								'name'=>'enrollment_status',
								'type'=> 'html',
								'value'=> nl2br(Yii::t('core',$Enrollmet->enrollment_status)),
						),

					array(
									'name'=>'course_id',
									'type'=> 'html',
									'value'=> nl2br($Enrollmet->course->course_name),
									),

						array(
								'name'=>'EnrollmentInfo.department_id',
								'type'=> 'html',
								'value'=> nl2br($Enrollmet->department->department_name),
						),

						array(
								'name'=>'EnrollmentInfo.batch_id',
								'type'=> 'html',
								'value'=> nl2br($Enrollmet->batch->batch_id),
						),
						array(
								'name'=>'EnrollmentInfo.batch_group',
								'type'=> 'html',
								'value'=> nl2br($Enrollmet->batchgroup->group_name),
						),

						array(
								'name'=>'EnrollmentInfo.semester',
								'type'=> 'html',
								'value'=> nl2br(CourseSemesterLebel::model()->semesterLebel($Enrollmet->course_id,$Enrollmet->semester)),
						),

						array(
								'name'=>'EnrollmentInfo.roll_no',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($Enrollmet->roll_no)),
						),


				),
			)); 
			?>
			</div></div>
			<?php
			endforeach;
			?>
		
		</div>
		<div class="tab-pane  active" id="fees_info">
		
		
		<?php 
		//$nbd=new array();
		$ii=1;
		foreach($model->EnrollmentInfoAll as $eninfo):
			if($ii==1)
			{
			$nbd[]=array('label'=>$eninfo->session, 'active'=>true, 'content'=>
		'
		<div class="span5">
                        <div class="well">
                        <h4>খাত অনুযায়ী সংগ্রহ</h4>
                        '.$this->renderPartial('viewCollectionGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
                    <div class="span5">
                        <div class="well">
                        <h4>এ পর্যন্ত সংগ্রহ</h4>
                        '.$this->renderPartial('viewCollectionDetailGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
                    <div class="span5">
                        <div class="well">
                        <h4>এ পর্যন্ত বকেয়া</h4>
                        '.$this->renderPartial('viewCollectionDuesGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
                    <div class="span5">
                        <div class="well">
                        <h4>এ পর্যন্ত জরিমানা</h4>
                        '.$this->renderPartial('viewCollectionFinelGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
					  <div class="span5">
                        <div class="well">
                        <h4>এ পর্যন্ত  উদ্বৃত্ত </h4>
                        '.$this->renderPartial('viewCollectionlRemainingGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
					 <div class="span5">
                        <div class="well">
                        <h4>সেশান এর পুরো বকেয়া</h4>
                        '.$this->renderPartial('viewCollectionDuesFullGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
		'
		
		
		);
		}
		else
		{
		$nbd[]=array('label'=>$eninfo->session,  'content'=>
		'
		<div class="span5">
                        <div class="well">
                        <h4>খাত অনুযায়ী সংগ্রহ</h4>
                        '.$this->renderPartial('viewCollectionGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
                    <div class="span5">
                        <div class="well">
                        <h4>এ পর্যন্ত সংগ্রহ</h4>
                        '.$this->renderPartial('viewCollectionDetailGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
                    <div class="span5">
                        <div class="well">
                        <h4>এ পর্যন্ত বকেয়া</h4>
                        '.$this->renderPartial('viewCollectionDuesGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
                    <div class="span5">
                        <div class="well">
                        <h4>এ পর্যন্ত জরিমানা</h4>
                        '.$this->renderPartial('viewCollectionFinelGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
					  <div class="span5">
                        <div class="well">
                        <h4>এ পর্যন্ত  উদ্বৃত্ত </h4>
                        '.$this->renderPartial('viewCollectionlRemainingGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
					 <div class="span5">
                        <div class="well">
                        <h4>সেশান এর পুরো বকেয়া</h4>
                        '.$this->renderPartial('viewCollectionDuesFullGrid', array('model'=>$model,'eninfo'=>$eninfo),true).'
                        </div>
                     </div>
		'
		
		
		);
		}
		$ii++;
		endforeach;
		
		$this->widget('ext.bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs',
    'placement'=>'left', // 'above', 'right', 'below' or 'left'
    'tabs'=>$nbd,
)); ?>
		

                    
  </div>
	<div class="tab-pane" id="attendance_info"> <?php $this->renderPartial('studentAttendanceGrid', array('student_id'=>$model->student_pk,'eninfo'=>$model->EnrollmentInfoLast)); ?></div>
	<div class="tab-pane" id="routine_info" >
    <?php 
	 if($cvf)
			{
    	$vvvbb=ClassRoutine::model()->findAll("session_id='".$cvf->session."'  and semester_id='".$cvf->semester."'  AND 
		 course_id='".$cvf->course_id."' and department_id='".$cvf->department_id."' and batch_id='".$cvf->batch_id."' and batch_group_id='".$cvf->batch_group."'");
        
         ?>
      <table width="100%" border="0" class="tablen2">
      <tr>
        <th>Subject</th>
        <th>Room No</th>
        <th>Time</th>
        <th>Teacher</th>
      </tr>
      <?php
         
		foreach($vvvbb as $cdcd):
	?>	
    
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
        <?php $cdcd->subject->subject_name;?></td>
        <td>
		<?php 
			echo $cdcd->facultyMember->member_name;
            echo "<br />";
            echo $cdcd->A_facultyMember?$cdcd->A_facultyMember->member_name:"";
			?>
        </td>
      </tr>
      <?php endforeach;?>
    </table>
    <?php }?>
    </div>

	<div class="tab-pane" id="syllabus_info">Coming Soon</div>

	<div class="tab-pane" id="notice" >Coming Soon</div>
	<div class="tab-pane" id="result" >Coming Soon</div>

  </div>
</div>
<?php Yii::app()->bootstrap->registerTabs('studentTab'); ?>
