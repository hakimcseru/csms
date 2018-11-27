<div class="view">

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('student_id')); ?>:</b>
	<?php echo CHtml::encode($data->student_id); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('roll_no')); ?>:</b>
	<?php echo CHtml::encode(Bndate::t($data->roll_no)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('course_id')); ?>:</b>
	<?php echo CHtml::encode($data->course->course_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('batch_id')); ?>:</b>
	<?php echo CHtml::encode($data->batch->batch_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank_id')); ?>:</b>
	<?php echo CHtml::encode($data->bank->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_deposit')); ?>:</b>
	<?php echo CHtml::encode(Bndate::t($data->total_deposit)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deposit_date')); ?>:</b>
	<?php echo CHtml::encode($data->deposit_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('input_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->input_datetime); ?>
	<br />

	*/ ?>

</div>