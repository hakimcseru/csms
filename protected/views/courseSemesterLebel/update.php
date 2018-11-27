<?php
$this->breadcrumbs=array(
	Yii::t('core','Course Semester Lebel')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List CourseSemesterLebel','url'=>array('index')),
	array('label'=>'Create CourseSemesterLebel','url'=>array('create')),
	array('label'=>'View CourseSemesterLebel','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CourseSemesterLebel','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Course Semester Lebel') ?>&nbsp;<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>