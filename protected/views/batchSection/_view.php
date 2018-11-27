<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_group_id')); ?>:</b>
	<?php echo CHtml::encode($data->batch_group_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('section_name')); ?>:</b>
	<?php echo CHtml::encode($data->section_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_role')); ?>:</b>
	<?php echo CHtml::encode($data->start_role); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_role')); ?>:</b>
	<?php echo CHtml::encode($data->end_role); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_id')); ?>:</b>
	<?php echo CHtml::encode($data->session_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_id')); ?>:</b>
	<?php echo CHtml::encode($data->course_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('department_id')); ?>:</b>
	<?php echo CHtml::encode($data->department_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_id')); ?>:</b>
	<?php echo CHtml::encode($data->batch_id); ?>
	<br />

	*/ ?>

</div>