<?php
$this->breadcrumbs=array(
	 Yii::t('core','Student Dues'),
);

$this->menu=array(
	array('label'=>'Create StudentDues','url'=>array('create')),
	array('label'=>'Manage StudentDues','url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('core','Student Dues')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
