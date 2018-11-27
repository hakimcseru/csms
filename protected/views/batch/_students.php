<?php
/* @var $model Batch */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$students = new Student('search');

$form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	//'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>

	<?php echo $form->textFieldRow($students,'student_pk',array('class'=>'span5','maxlength'=>20,'id'=>'student-pk')); ?>

	<div class="actions">
		<?php echo CHtml::ajaxSubmitButton('Add', array("batch/addStudent/$model->batch_pk"), array('success' => "function(){jQuery('#student-grid').yiiGridView.update('student-grid');jQuery('#student-pk').val('')}"), array('class' => 'btn small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
<?php
$students->unsetAttributes();
$students->student_ref_batch_pk = $model->batch_pk;
$this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'student-grid',
	'dataProvider'=> $students->search(),
	//'filter'=>$model,
	'columns'=>array(
		'student_id',
		'student_name',
	),
)); ?>