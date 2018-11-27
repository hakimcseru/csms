<?php
$this->breadcrumbs=array(
	'Bank Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BankInfo', 'url'=>array('index')),
	array('label'=>'Manage BankInfo', 'url'=>array('admin')),
);
?>

<h1>Create BankInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>