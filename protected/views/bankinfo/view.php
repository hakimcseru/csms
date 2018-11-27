<?php
$this->breadcrumbs=array(
	'Bank Infos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List BankInfo', 'url'=>array('index')),
	array('label'=>'Create BankInfo', 'url'=>array('create')),
	array('label'=>'Update BankInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BankInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BankInfo', 'url'=>array('admin')),
);
?>

<h1>View BankInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'acc_name',
		'acc_no',
		'active',
	),
)); ?>
