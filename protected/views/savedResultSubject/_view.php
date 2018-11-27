<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('saved_result_id')); ?>:</b>
	<?php echo CHtml::encode($data->saved_result_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_id')); ?>:</b>
	<?php echo CHtml::encode($data->subject_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_code')); ?>:</b>
	<?php echo CHtml::encode($data->subject_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_name')); ?>:</b>
	<?php echo CHtml::encode($data->subject_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_full_mark')); ?>:</b>
	<?php echo CHtml::encode($data->subject_full_mark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('student_subject_marks')); ?>:</b>
	<?php echo CHtml::encode($data->student_subject_marks); ?>
	<br />


</div>