<style>

.text_field{
	
	border:1px solid #ABADB3!important;
	padding:0px!important;
	
}


 

.label{
    font-weight: bold;
    padding: 10px;
    text-align: left;
	 color: #007BA7!important;
	 
	 }

.form label.label{
	float:none;
}
	 
.group{
	float:left;
	margin:0px 16px;
}

.group .button, .group span, .group a{
	margin-top:21px;
}

.form input.text_field{
	font-size:1 em!important;
	width:100% !important;
}


h2#noprint{ margin-right:20px;}

</style>




<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'attendance-report-employee-form',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'enableAjaxValidation' => false,
	'focus' => array($model, 'attendance_final_data_ref_core_employee_id'),
	'htmlOptions' => array(
		'class' => 'form',
	),
)); ?>
<div class="columns wat-cf">
	<div class="column left">
		<div class="group">
			<?php if($model->hasErrors('attendance_final_data_ref_core_employee_id')): ?>
				<div class="fieldWithErrors">
			<?php endif; ?>
			<?php echo $form->labelEx($model, 'attendance_final_data_ref_core_employee_id', array('class' => 'label')); ?>
			<?php if ($model->hasErrors('attendance_final_data_ref_core_employee_id')): ?>
					<span class="error"><?php echo $model->getError('attendance_final_data_ref_core_employee_id'); ?></span>
				</div>
			<?php endif; ?>
			<?php echo $form->textField($model, 'attendance_final_data_ref_core_employee_id', array('size' => 20, 'maxlength' => 20, 'class' => 'text_field')); ?>
		</div>

		<div class="group">
			<?php if($model->hasErrors('attendance_final_data_date_from')): ?>
				<div class="fieldWithErrors">
			<?php endif; ?>
			<?php echo $form->labelEx($model, 'attendance_final_data_date_from', array('class' => 'label')); ?>
			<?php if ($model->hasErrors('attendance_final_data_date_from')): ?>
					<span class="error"><?php echo $model->getError('attendance_final_data_date_from'); ?></span>
				</div>
			<?php endif; ?>
			<?php
			$this->widget('application.modules.attendance.widgets.timepicker.timepicker', array(
				'model' => $model,
				'name' => 'attendance_final_data_date_from',
				//'select' => 'datetime',
				'select' => 'date',
				'options' => array(
					'changeMonth' => true,
					'changeYear' => true,
					'showOn' => 'focus',
					//'ampm' => false,
					'buttonImageOnly' => false,
				),
			))
			?>
		</div>

		<div class="group">
			<?php if($model->hasErrors('attendance_final_data_date_to')): ?>
				<div class="fieldWithErrors">
			<?php endif; ?>
			<?php echo $form->labelEx($model, 'attendance_final_data_date_to', array('class' => 'label')); ?>
			<?php if ($model->hasErrors('attendance_final_data_date_to')): ?>
					<span class="error"><?php echo $model->getError('attendance_final_data_date_to'); ?></span>
				</div>
			<?php endif; ?>
			<?php
			$this->widget('application.modules.attendance.widgets.timepicker.timepicker', array(
				'model' => $model,
				'name' => 'attendance_final_data_date_to',
				//'select' => 'datetime',
				'select' => 'date',
				'options' => array(
					'changeMonth' => true,
					'changeYear' => true,
					'showOn' => 'focus',
					//'ampm' => false,
					'buttonImageOnly' => false,
				),
			))
			?>
		</div>

		<div class="group navform wat-cf">
			<button class="button" type="submit">
				<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/save.png', 'View Employee Job Card'); ?> View
			</button>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>