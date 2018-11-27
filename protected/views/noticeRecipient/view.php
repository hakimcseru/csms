<?php
$this->breadcrumbs=array(
	'Notice Recipients'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NoticeRecipient','url'=>array('index')),
	array('label'=>'Create NoticeRecipient','url'=>array('create')),
	array('label'=>'Update NoticeRecipient','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete NoticeRecipient','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NoticeRecipient','url'=>array('admin')),
);
?>

<h1>View NoticeRecipient #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_no',
		'type',
		'notice_id',
		'start_date',
		'end_date',
	),
)); ?>
