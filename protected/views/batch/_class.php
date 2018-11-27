<?php
$classModel = new ClassModel('search');
$classModel->unsetAttributes();
$classModel->class_ref_batch_pk = $model->batch_pk;

$this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'class-model-grid',
	'dataProvider'=>$classModel->search(),
	'columns'=>array(
		'class_pk',
		'class_ref_room_no',
		'class_ref_subject_name',
		'class_start_time',
		'class_end_time',
		'class_days_on_week',
		'class_semester',
	),
)); ?>