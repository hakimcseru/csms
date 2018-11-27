<?php
$this->breadcrumbs=array(
	Yii::t('core','Faculty')=>array('index'),
	Bndate::t($model->id)=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List Faculty','url'=>array('index')),
	array('label'=>'Create Faculty','url'=>array('create')),
	array('label'=>'View Faculty','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Faculty','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Faculty')?># <?php echo Bndate::t($model->id); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>