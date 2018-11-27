<?php
$this->breadcrumbs=array(
	Yii::t('core','Calendar')=>array('index'),
	Bndate::t($model->calendar_pk)=>array('view','id'=>$model->calendar_pk),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List Calendar','url'=>array('index')),
	array('label'=>'Create Calendar','url'=>array('create')),
	array('label'=>'View Calendar','url'=>array('view','id'=>$model->calendar_pk)),
	array('label'=>'Manage Calendar','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Calendar')?> <?php echo Bndate::t($model->calendar_pk); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>