<?php
$this->breadcrumbs=array(
	Yii::t('core','Calendar')=>array('index'),
	Bndate::t($model->calendar_pk),
);

$this->menu=array(
	array('label'=>'List Calendar','url'=>array('index')),
	array('label'=>'Create Calendar','url'=>array('create')),
	array('label'=>'Update Calendar','url'=>array('update','id'=>$model->calendar_pk)),
	array('label'=>'Delete Calendar','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->calendar_pk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Calendar','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View Calendar')?>#<?php echo Bndate::t($model->calendar_pk); ?></h1>

<?php $this->renderPartial('_view', array('model'=>$model));
