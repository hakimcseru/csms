<?php
$this->breadcrumbs=array(
	'Bank Infos',
);

$this->menu=array(
	array('label'=>'Create BankInfo', 'url'=>array('create')),
	array('label'=>'Manage BankInfo', 'url'=>array('admin')),
);
?>

<h1>Bank Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
