<h1><?php echo Yii::t('attendance', 'Daily Attendance'); ?></h1>
<div class="search-form">
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
	'type'=>'inline',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'date',array('class'=>'input-small datepicker')); ?>

	<?php echo $form->dropDownList($model, 'core_department_id', CHtml::listData(
			CoreDepartment::model()->findAll(array('order'=>'name DESC')), 'id', 'name'),array('empty'=>$model->getAttributeLabel('core_department_id'), 'class'=>'input-small')); ?>

	<?php echo $form->dropDownList($model, 'core_shift_id', CHtml::listData(
			CoreShift::model()->findAll(array('order'=>'name DESC')), 'id', 'name'),array('empty'=>$model->getAttributeLabel('core_shift_id'), 'class'=>'input-small')); ?>


	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'icon-search', 'label'=>Yii::t('attendance', 'Search'), )); ?>
	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'icon-print', 'label'=>Yii::t('attendance', 'Export'), )); ?>

<?php $this->endWidget(); ?>
</div><!-- search-form -->
<?php if(!empty($model->date)){ ?>
<?php $this->widget('ext.groupgridview.BootGroupGridView',array(
	'id'=>'attendance-final-data-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'type'=>'striped condensed bordered',
	'enableSorting'=>false,
	'selectableRows'=>false,
	'mergeColumns' => array(),
	'extraRowColumns' => array(),
	'extraRowExpression'=>'',
	'columns'=>array(
		'core_employee_id'=>array(
			'name'=>'core_employee_id',
			'type'=>'raw',
			'value'=> 'isset($data->employee)? "<div style=\'text-align:left;\'>
				<img src=\'".$data->employee->getImage(48,48)."\' />".
				$data->employee->name." (".Bndate::t($data->core_employee_id).")</div>" :
				$data->core_employee_name." (".Bndate::t($data->core_employee_id). ")"',
			'filter'=>false,
			),
		'in_time'=>array('name'=>'in_time', 'value'=>'empty($data->in_time)? null : Bndate::t(date("H:i:s", strtotime($data->in_time)))'),
		'break_start'=>array('name'=>'break_start', 'value'=>'empty($data->break_start)? null : Bndate::t(date("H:i:s", strtotime($data->break_start)))'),
		'break_end'=>array('name'=>'break_end', 'value'=>'empty($data->break_end)? null : Bndate::t(date("H:i:s", strtotime($data->break_end)))'),
		'out_time'=>array('name'=>'out_time', 'value'=>'empty($data->out_time)? null : Bndate::t(date("H:i:s", strtotime($data->out_time)))'),
		'status'=>array(
			'name'=>'status',
			'value'=>'$data->status',
		),
		'work_hour'=>array(
			'name'=>'work_hour',
			'value'=>'$data->work_hour? Bndate::t($data->work_hour) : null',
		),
		'over_time'=>array(
			'name'=>'over_time',
			'value'=>'$data->over_time? Bndate::t($data->over_time) : null',
		),
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',

			'template'=>'{view}',
			'buttons'=>array
			(
				'view' => array
				(
					'url'=>'Yii::app()->createUrl("attendance/report/entries", array("id"=>$data->id))',
					'options'=>array(  // this is the 'html' array but we specify the 'ajax' element
						 'ajax'=>array(
						   'type'=>'POST',
						   'url'=>"js:$(this).attr('href')", // ajax post will use 'url' specified above
						   'success'=>"function(data)
							{
								msg = eval('(' + data + ')');
								$('#modalAjaxView div.modal-body').html(msg.div);
								$('#modalAjaxView').modal();
								//setTimeout(\"$('#dialogInboxView').dialog('close') \",2000);

							} ",
						 ),
					   ),
				),
			),
		)
	),
)); ?>
<?php } ?>


<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'modalAjaxView')); ?>
<div class="modal-body"></div>
<?php $this->endWidget(); ?>