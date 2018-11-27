<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('head_title')); ?>:</b>
	<?php echo CHtml::encode($data->head_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('head_code')); ?>:</b>
	<?php echo CHtml::encode($data->head_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session')); ?>:</b>
	<?php echo CHtml::encode($data->session); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course')); ?>:</b>
	<?php echo CHtml::encode($data->course); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('student_type')); ?>:</b>
	<?php echo CHtml::encode($data->student_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apply_on_month')); ?>:</b>
	<?php echo CHtml::encode($data->apply_on_month); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('collection_amount')); ?>:</b>
	<?php echo CHtml::encode($data->collection_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purpose')); ?>:</b>
	<?php echo CHtml::encode($data->purpose); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	*/ ?>

</div>