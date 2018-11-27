<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_pk')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->class_pk),array('view','id'=>$data->class_pk)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_ref_room_pk')); ?>:</b>
	<?php echo CHtml::encode($data->class_ref_room_pk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_ref_room_no')); ?>:</b>
	<?php echo CHtml::encode($data->class_ref_room_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_start_date')); ?>:</b>
	<?php echo CHtml::encode($data->class_start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_end_date')); ?>:</b>
	<?php echo CHtml::encode($data->class_end_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_start_time')); ?>:</b>
	<?php echo CHtml::encode($data->class_start_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_end_time')); ?>:</b>
	<?php echo CHtml::encode($data->class_end_time); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('class_status')); ?>:</b>
	<?php echo CHtml::encode($data->class_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_days_on_week')); ?>:</b>
	<?php echo CHtml::encode($data->class_days_on_week); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_ref_batch_pk')); ?>:</b>
	<?php echo CHtml::encode($data->class_ref_batch_pk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_ref_batch_id')); ?>:</b>
	<?php echo CHtml::encode($data->class_ref_batch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_ref_subject_pk')); ?>:</b>
	<?php echo CHtml::encode($data->class_ref_subject_pk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_ref_subject_name')); ?>:</b>
	<?php echo CHtml::encode($data->class_ref_subject_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class_semester')); ?>:</b>
	<?php echo CHtml::encode($data->class_semester); ?>
	<br />

	*/ ?>

</div>