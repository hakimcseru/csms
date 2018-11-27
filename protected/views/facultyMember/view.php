


<?php
$this->breadcrumbs=array(
	Yii::t('core','Faculty Member')=>array('index'),
	Bndate::t($model->member_id),
);
?>

<h1><?php echo Yii::t('core','Faculty Members')?>: <?php echo $model->member_name.' ('.Bndate::t($model->member_id).')'; ?></h1>

<ul class="nav nav-pills">
	<li class="active"><a href="#basic" data-toggle="pill"><?php echo Yii::t('core','BASIC INFO')?></a></li>

	<li><a href="#contacts" data-toggle="pill"><?php echo Yii::t('core','CONTACT INFO')?></a></li>

<li><a href="#routine_info" data-toggle="pill"><?php echo Yii::t('core','CLASS ROUTINE INFO')?></a></li>

<li><a href="#routine_info" data-toggle="pill"><?php echo Yii::t('core','EXAM ROUTINE INFO')?></a></li>

<li><a href="#notice" data-toggle="pill"><?php echo Yii::t('core','NOTICE')?></a></li>
<li><a href="#reading_materials" data-toggle="pill"><?php echo Yii::t('core','READING MATERIALS')?></a></li>
<li><a href="#syllabus_info" data-toggle="pill"><?php echo Yii::t('core','SYLLABUS')?></a></li>
<li><a href="#attendance_info" data-toggle="pill"><?php echo Yii::t('core','ATTENDANCE INFO')?></a></li>
<li><a href="#academic_info" data-toggle="pill"><?php echo Yii::t('core','প্রশাসনিক তথ্য')?></a></li>


</ul>
<div id="facultyTab">
	<div class="tab-content">
		<div class="tab-pane active" id="basic">
                    <div style="width:70%; height: auto; float: left;">
			<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
				'data'=>$model,
				'attributes'=>array(

						array(
								'name'=>'member_id',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($model->member_id)),
						),
						'member_name',

						array(
								'name'=>'member_dob',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($model->member_dob)),
						),
					'member_father_name',
					'member_mother_name',
					'member_nationality',

						array(
								'name'=>'member_gender',
								'type'=> 'html',
								'value'=> nl2br(Yii::t('core',$model->member_gender)),
						),
					'member_blood_group',
						'member_profession',

				),
			)); ?>
                </div>
                    <div style="width:30%; height: auto; float: right;">
                            <img src="<?php echo Yii::app()->request->getBaseUrl(TRUE)?>/images/faculty/<?php echo $model->member_image;?>" />
                        </div>
		</div>

		<div class="tab-pane" id="contacts">
			<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
				'data'=>$model,
				'attributes'=>array(

						array(
								'name'=>'member_email',
								'type'=> 'html',
								'value'=> nl2br($model->member_email),
						),
						array(
								'name'=>'member_contact',
								'type'=> 'html',
								'value'=> nl2br($model->member_contact),
						),
					array(
						'name'=>'member_present_address',
						'type'=> 'html',
						'value'=> nl2br($model->member_present_address),
					),
					array(
						'name'=>'member_permanent_address',
						'type'=> 'html',
						'value'=> nl2br($model->member_permanent_address),
					),


					array(
						'name'=>'member_alternate_contact',
						'type'=> 'html',
						'value'=> nl2br($model->member_alternate_contact),
					),
				),
			)); ?>
		</div>



		<div class="tab-pane" id="fees_info">Coming Soon</div>
	<div class="tab-pane" id="attendance_info"><?php $this->renderPartial('facultyMemberAttendanceGrid', array('model'=>$model)); ?></div>
	<div class="tab-pane" id="routine_info" >Coming Soon</div>
	<div class="tab-pane" id="syllabus_info">Coming Soon</div>

	<div class="tab-pane" id="notice" >Coming Soon</div>
	<div class="tab-pane" id="result" >Coming Soon</div>
	<div class="tab-pane" id="reading_materials" >Coming Soon</div>
        <div class="tab-pane" id="academic_info" >
            <?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
				'data'=>$model,
				'attributes'=>array(

						array(
								'name'=>'faculty_id',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($model->faculty->faculty_name)),
						),
						

						array(
								'name'=>'department_id',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($model->department->department_name)),
						),
						
					array(
								'name'=>'designation',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($model->designation)),
						),

				),
			)); ?>
            </div>
	</div>
</div>
<?php Yii::app()->bootstrap->registerTabs('studentTab'); ?>

