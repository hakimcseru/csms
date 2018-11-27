<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_pk')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->batch_pk),array('view','id'=>$data->batch_pk)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_id')); ?>:</b>
	<?php echo CHtml::encode($data->batch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_start_date')); ?>:</b>
	<?php echo CHtml::encode($data->batch_start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_end_date')); ?>:</b>
	<?php echo CHtml::encode($data->batch_end_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_status')); ?>:</b>
	<?php echo CHtml::encode($data->batch_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_ref_course_pk')); ?>:</b>
	<?php echo CHtml::encode($data->batch_ref_course_pk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_ref_course_name')); ?>:</b>
	<?php echo CHtml::encode($data->batch_ref_course_name); ?>
	<br />


</div>