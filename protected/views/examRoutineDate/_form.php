<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'exam-routine-date-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'exam_routine_id',array('class'=>'span5')); ?>
	
	<?php echo $form->dropDownListRow($model,'exam_routine_id', CHtml::listData(ExamRoutine::model()->findAll(), 'id', 'name'), array('empty' => 'Select Course','class'=>'span5 timedate','maxlength'=>20)); ?>

	<div class="control-group <?php echo ($model->hasErrors('exam_date'))? 'error' : '' ?>">
				<?php echo $form->label($model,'exam_date', array('class'=>'control-label')); ?>
				<div class="controls">
					<?php
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model' => $model,
						'name' => 'ExamRoutineDate[exam_date]',
						'value'=> $model->exam_date,
						'options' => array(
							'dateFormat' => 'yy-mm-dd',
							//'altFormat' => 'yy-mm-dd', // show to user format
							'changeMonth' => true,
							'changeYear' => true,
							'showOn' => 'focus',
							'buttonImageOnly' => false,
						),
						'htmlOptions'=>array(
							'class'=>'span6',
						),
					));
					?>
					<?php echo $form->error($model,'student_dob'); ?>
				</div>
			</div>
								

	<?php //echo $form->textFieldRow($model,'exam_date',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
