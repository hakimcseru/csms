<h1><?php echo Yii::t('attendance', 'Late Attendance Summary'); ?></h1>
<div class="search-form">
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
	'type'=>'inline',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'dateFrom',array('class'=>'input-small datepicker')); ?>

	<?php echo $form->textFieldRow($model,'dateTo',array('class'=>'input-small datepicker')); ?>

	<?php echo $form->dropDownList($model, 'core_department_id', CHtml::listData(
			CoreDepartment::model()->findAll(array('order'=>'name DESC')), 'id', 'name'),array('empty'=>$model->getAttributeLabel('core_department_id'), 'class'=>'input-small')); ?>

	<?php echo $form->dropDownList($model, 'core_shift_id', CHtml::listData(
			CoreShift::model()->findAll(array('order'=>'name DESC')), 'id', 'name'),array('empty'=>$model->getAttributeLabel('core_shift_id'), 'class'=>'input-small')); ?>


	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'icon-search', 'label'=>Yii::t('attendance', 'Search'), )); ?>

<?php $this->endWidget(); ?>
</div><!-- search-form -->
<?php if(isset($model->dateFrom, $model->dateTo)){ ?>
<?php $this->widget('ext.groupgridview.BootGroupGridView',array(
	'id'=>'attendance-final-data-grid',
	'dataProvider'=>$model->attendanceLateSummary(),
	//'filter'=>$model,
	'type'=>'striped condensed bordered',
	'enableSorting'=>false,
	'selectableRows'=>false,
	'mergeColumns' => array(),
	'extraRowColumns' => array(),
	'extraRowExpression'=>'',
	
	'columns'=>array(
		'id'=>array(
			'header'=>"ID",
			'value'=>  '$data["core_employee_id"]',
			'type'=>'raw',
		),
		'date'=>array(
			'name'=>$model->getAttributeLabel('core_employee_id'),
			'value'=>  'AttendanceFinalData::model()->get_name($data)',
			
			'type'=>'raw',
		),
		'present'=>array('name'=>$model->getAttributeLabel('present'), 'value'=>'Bndate::t($data["present"])'), 
		'late_in'=>array('name'=>$model->getAttributeLabel('late_in'), 'value'=>'Bndate::t($data["late_in"])'),
		'early_out'=>array('name'=>$model->getAttributeLabel('early_out'), 'value'=>'Bndate::t($data["early_out"])'),
		'day_off'=>array('name'=>$model->getAttributeLabel('day_off'), 'value'=>'Bndate::t($data["day_off"])'), 
		'sick_leave'=>array('name'=>$model->getAttributeLabel('Sick Leave'), 'value'=>'Bndate::t($data["sick_leave"])'),
		'casual_leave'=>array('name'=>$model->getAttributeLabel('Casual Leave'), 'value'=>'Bndate::t($data["casual_leave"])'),
		'absent'=>array('name'=>$model->getAttributeLabel('absent'), 'value'=>'Bndate::t($data["absent"])'),
	),
)); ?>
<?php } ?>