<?php
$this->breadcrumbs=array(
	Yii::t('core','Course')."-".Yii::t('core','Department')=>array('index'),
	$model->course->course_name." - ".$model->course->course_name=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List CourseDepartment','url'=>array('index')),
	array('label'=>'Create CourseDepartment','url'=>array('create')),
	array('label'=>'View CourseDepartment','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CourseDepartment','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update');?> <?php echo $model->course->course_name." - ".$model->course->course_name; ?></h1>



<div >
	<div class="span7">
	
	<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

	<h3><?php echo Yii::t('core','Available Subjects');?></h3>
	<?php $this->renderPartial('allSubjectsGrid', array('subjects'=>$subjects,'model'=>$model)); ?>
	</div>
	<div class="span4">
		<div class="well">
		<h4><?php echo Yii::t('core','Subjects Under this Course-Department');?></h4>
		<?php $this->renderPartial('selectedSubjectsGrid', array('model'=>$model)); ?>
		</div>
	</div>
</div>