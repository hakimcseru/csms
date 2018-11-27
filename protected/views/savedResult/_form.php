<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'saved-result-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'session_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'course',array('class'=>'span5','maxlength'=>250)); ?>

	<?php //echo $form->textFieldRow($model,'department',array('class'=>'span5','maxlength'=>250)); ?>

	<?php // echo $form->textFieldRow($model,'semester',array('class'=>'span5','maxlength'=>250)); ?>

	<?php // echo $form->textFieldRow($model,'batch_group',array('class'=>'span5','maxlength'=>250)); ?>

	<?php //echo $form->textFieldRow($model,'course_id',array('class'=>'span5')); ?>

	<?php ////echo $form->textFieldRow($model,'department_id',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'semester_id',array('class'=>'span5')); ?>

	<?php /*echo $form->textFieldRow($model,'batch_group_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'roll_no',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'student_id',array('class'=>'span5','maxlength'=>250)); */ ?>

	<?php echo $form->textFieldRow($model,'total_number',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'result',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'position',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'published_date',array('class'=>'span5')); ?>

	<?php /*echo $form->textFieldRow($model,'saved_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'saved_by',array('class'=>'span5')); */?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>


Results Subject

<a href="<?php echo Yii::app()->createUrl('savedResultSubject/create',array('id'=>$model->id));?>">Add result subject<a/>
<table class="table">
<tr>
	<th>Student Id</th>
	<th>Subject Code</th>
	<th>Subject Name</th>
	<th>Subject Full Mark</th>
	<th>Pass Mark</th>
	<th>Obtained</th>
	<th>Action</th>
</tr>
<?php foreach($model->resultsubject as $res):

?>
<tr>
	<td><?php echo $res->subject_id?></td>
	<td><?php  echo $res->subject_code;?></td>
	<td><?php  echo $res->subject_name;?></td>
	<td><?php  echo $res->subject_full_mark;?></td>
	<td><?php echo $res->subject_min_mark;?></td>
	<td><?php echo $res->student_subject_marks;?></td>
	<td><a href="<?php echo Yii::app()->createUrl('savedResultSubject/update',array('id'=>$res->id));?>">edit<a/></td>
</tr>
<?php endforeach;?>
</table>


