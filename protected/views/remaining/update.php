<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Remaining')=>array('index'),
	Bndate::t($model->id)=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List StudentRemaining','url'=>array('index')),
	array('label'=>'Create StudentRemaining','url'=>array('create')),
	array('label'=>'View StudentRemaining','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage StudentRemaining','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Student Remaining')?> <?php echo Bndate::t($model->id); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>