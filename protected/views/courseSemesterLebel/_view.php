<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_id')); ?>:</b>
	<?php echo CHtml::encode($data->course_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester_id')); ?>:</b>
	<?php echo CHtml::encode($data->semester_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lebel')); ?>:</b>
	<?php echo CHtml::encode($data->lebel); ?>
	<br />


</div>