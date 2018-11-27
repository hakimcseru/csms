<?php
$this->breadcrumbs=array(
	Yii::t('core','Course Semester Lebel')=>array('index'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List CourseSemesterLebel','url'=>array('index')),
	array('label'=>'Create CourseSemesterLebel','url'=>array('create')),
	array('label'=>'Update CourseSemesterLebel','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CourseSemesterLebel','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CourseSemesterLebel','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Course Semester Lebel');?> <?php echo Yii::t('core','View');?> # <?php echo Bndate::t($model->id); ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(

		array('name'=>'id','value'=>Bndate::t($model->id)),
		array('name'=>'course_id','value'=>$model->course->course_name),

		array('name'=>'semester_id','value'=>Bndate::t($model->semester_id)),
		'lebel',
	),
)); ?>
