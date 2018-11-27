<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collections')=>array('index'),
	Bndate::t($model->id)=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List StudentCollection','url'=>array('index')),
	array('label'=>'Create StudentCollection','url'=>array('create')),
	array('label'=>'View StudentCollection','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage StudentCollection','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Student Collection')?> <?php echo Bndate::t($model->id); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>