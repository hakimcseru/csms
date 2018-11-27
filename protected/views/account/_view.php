<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('month')); ?>:</b>
	<?php echo CHtml::encode($data->month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('process_date')); ?>:</b>
	<?php echo CHtml::encode($data->process_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('process_status')); ?>:</b>
	<?php echo CHtml::encode($data->process_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lock')); ?>:</b>
	<?php echo CHtml::encode($data->lock); ?>
	<br />


</div>