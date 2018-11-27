<?php
$this->breadcrumbs=array(
	 Yii::t('core','Student Enrollment Infos')=>array('index'),
	$model->student->student_name=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List StudentEnrollmentInfo','url'=>array('index')),
	array('label'=>'Create StudentEnrollmentInfo','url'=>array('create')),
	array('label'=>'View StudentEnrollmentInfo','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage StudentEnrollmentInfo','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update');?> <?php echo Yii::t('core','Student Enrollment Infos');?>::<?php echo Bndate::t($model->student_id);?> </h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>