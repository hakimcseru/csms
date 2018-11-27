<?php
$this->breadcrumbs=array(
	 Yii::t('core','Section')=>array('index'),
	 Bndate::t($model->id)=>array('view','id'=>$model->id),
	 Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List BatchSection','url'=>array('index')),
	array('label'=>'Create BatchSection','url'=>array('create')),
	array('label'=>'View BatchSection','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BatchSection','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Section')?> <?php echo Bndate::t($model->id); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>