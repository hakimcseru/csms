<h1><?php echo Yii::t('attendance', 'Attendance Summary'); ?></h1>
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
	'dataProvider'=>$model->attendanceSummary(),
	//'filter'=>$model,
	'type'=>'striped condensed bordered',
	'enableSorting'=>false,
	'selectableRows'=>false,
	'mergeColumns' => array(),
	'extraRowColumns' => array(),
	'extraRowExpression'=>'',
	'columns'=>array(
		'date'=>array(
			'name'=>$model->getAttributeLabel('date'),
			'value'=>  'CHtml::link(Bndate::t($data["date"], true),
					Yii::app()->createUrl("attendance/report/daily", array("date"=>$data["date"],"dept"=>"'.$model->core_department_id.'","shift"=>"'.$model->core_shift_id.'")))',
			'type'=>'raw',
		),
		'present'=>array('name'=>$model->getAttributeLabel('present'), 'value'=>'Bndate::t($data["present"])'),
		'late_in'=>array('name'=>$model->getAttributeLabel('late_in'), 'value'=>'Bndate::t($data["present"])'),
		'early_out'=>array('name'=>$model->getAttributeLabel('early_out'), 'value'=>'Bndate::t($data["early_out"])'),
		'day_off'=>array('name'=>$model->getAttributeLabel('day_off'), 'value'=>'Bndate::t($data["day_off"])'),
		'leave'=>array('name'=>$model->getAttributeLabel('leave'), 'value'=>'Bndate::t($data["leave"])'),
		'absent'=>array('name'=>$model->getAttributeLabel('absent'), 'value'=>'Bndate::t($data["absent"])'),
	),
)); ?>
<?php } ?>