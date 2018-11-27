<?php
$this->breadcrumbs=array(
	Yii::t('core','Course Materials')=>array('index'),
	Bndate::t($model->id)=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List CourseMaterial','url'=>array('index')),
	array('label'=>'Create CourseMaterial','url'=>array('create')),
	array('label'=>'View CourseMaterial','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CourseMaterial','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Course Materials')?>#<?php echo Bndate::t($model->id); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>