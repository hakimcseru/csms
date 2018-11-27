<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'type'=>'horizontal',
	'id'=>'certificate-record-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('core','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	
	<div class="control-group <?php echo ($model->hasErrors('received_date'))? 'error' : '' ?>">
		<?php echo $form->label($model,'received_date', array('class'=>'control-label')); ?>
		<div class="controls">
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'certificateRecord[received_date]',
				'value'=> $model->received_date,
				'options' => array(
					'dateFormat' => 'yy-mm-dd',
					//'altFormat' => 'yy-mm-dd', // show to user format
					'changeMonth' => true,
					'changeYear' => true,
					'showOn' => 'focus',
					'buttonImageOnly' => false,
				),
				'htmlOptions'=>array(
					'class'=>'span5',
				),
			));
			?>
			<?php echo $form->error($model,'received_date'); ?>
		</div>
		</div>

	<?php echo $form->textFieldRow($model,'received_by',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'student_id',array('class'=>'span5')); ?>
	
	<?php echo $form->dropDownListRow($model,'course_id', CHtml::listData(Course::model()->findAll(), 'course_pk', 'course_name'), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Course'),
                                'type' => 'POST',                     
                               'update'=>'#CertificateRecord_department_id',
                                )),'empty' => 'Select Course','class'=>'span5','maxlength'=>20)); ?>
								
	<?php echo $form->dropDownListRow($model,'department_id', array(''=>''),array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('DisCoor'),
                                'type' => 'POST',                     
                               'update'=>'#CertificateRecord_batch_id',
                                )),'empty' => 'Select Department','class'=>'span5','maxlength'=>20)); ?>
	
	
<?php echo $form->dropDownListRow($model,'batch_id', array(''=>''), array('onChange'=>CHtml::ajax(array(
                                'url' => CController::createUrl('Group'),
                                'type' => 'POST',                     
                               'update'=>'#CertificateRecord_batch_group_id',
                                )),'class'=>'span5','maxlength'=>20)); ?>

<?php  echo $form->dropDownListRow($model,'batch_group_id', array(''=>''), array('class'=>'span5','maxlength'=>20)); ?>
	

	<?php echo $form->dropDownListRow($model,'session_id', array('1420'=>'১৪২০','1421'=>'১৪২১','1422'=>'১৪২২','1423'=>'১৪২৩'),array('class'=>'span5', 'maxlength'=>20)); ?>
	

	

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('core','Create') : Yii::t('core','Save'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
