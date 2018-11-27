<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_pk')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->subject_pk),array('view','id'=>$data->subject_pk)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_code')); ?>:</b>
	<?php echo CHtml::encode($data->subject_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_name')); ?>:</b>
	<?php echo CHtml::encode($data->subject_name); ?>
	<br />


</div>