<?php
$this->breadcrumbs=array(
	Yii::t('core','Faculty')=>array('index'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List Faculty','url'=>array('index')),
	array('label'=>'Create Faculty','url'=>array('create')),
	array('label'=>'Update Faculty','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Faculty','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Faculty','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View Faculty')?> #<?php echo Bndate::t($model->id); ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'faculty_name',
		'faculty_code',
	),
)); ?>
