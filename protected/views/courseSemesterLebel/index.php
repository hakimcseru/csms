<?php
$this->breadcrumbs=array(
	Yii::t('core','Course Semester Lebel'),
);

$this->menu=array(
	array('label'=>'Create CourseSemesterLebel','url'=>array('create')),
	array('label'=>'Manage CourseSemesterLebel','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Manage Course Semester Lebel') ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
