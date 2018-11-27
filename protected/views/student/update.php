<?php
$this->breadcrumbs=array(
	Yii::t('core','Student')=>array('index'),
	$model->student_name=>array('view','id'=>$model->student_pk),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List Student','url'=>array('index')),
	array('label'=>'Create Student','url'=>array('create')),
	array('label'=>'View Student','url'=>array('view','id'=>$model->student_pk)),
	array('label'=>'Manage Student','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update');?> <?php echo Yii::t('core','Student');?> - <?php echo $model->student_name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>