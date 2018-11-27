<?php
$this->breadcrumbs=array(
	'Exam Routines',
);

$this->menu=array(
	array('label'=>'Create ExamRoutine','url'=>array('create')),
	array('label'=>'Manage ExamRoutine','url'=>array('admin')),
);
?>

<h1>Exam Routines</h1>


<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'exam-routine-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php //echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'session_id',CHtml::listData(ExamRoutine::model()->findAll(), 'session_id', 'session_id'),array('class'=>'span5', 'empty'=>"Select ")); ?>

	<?php echo $form->dropDownListRow($model,'name',CHtml::listData(ExamRoutine::model()->findAll(), 'id', 'name'),array('class'=>'span5', 'empty'=>"Select ")); ?>
    
    <?php echo $form->textFieldRow($model,'date',array('class'=>'span5 datepicker')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Routine' : 'Save',
		)); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Room View' : 'Save',
		)); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Teacher View' : 'Save',
		)); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Date View' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
