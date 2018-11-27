<?php
$this->breadcrumbs=array(
	'Bank Infos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BankInfo', 'url'=>array('index')),
	array('label'=>'Create BankInfo', 'url'=>array('create')),
	array('label'=>'View BankInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BankInfo', 'url'=>array('admin')),
);
?>

<h1>Update BankInfo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>