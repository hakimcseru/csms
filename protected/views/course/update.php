<?php
$this->breadcrumbs=array(
	Yii::t('core','Course')=>array('index'),
	$model->course_name=>array('view','id'=>$model->course_pk),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List Course','url'=>array('index')),
	array('label'=>'Create Course','url'=>array('create')),
	array('label'=>'View Course','url'=>array('view','id'=>$model->course_pk)),
	array('label'=>'Manage Course','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update')." ". Yii::t('core','Course');?> : <?php echo $model->course_name; ?></h1>
<span class="reuquired"><?php echo $this->renderPartial('_form',array('model'=>$model,'semester_lebel'=>$semester_lebel)); ?></span>
<?php /*
<div class ="row">
	<div class="span5">
	<?php echo $this->renderPartial('_form',array('model'=>$model,'semester_lebel'=>$semester_lebel)); ?>

	<h3>Available Subjects</h3>
	<?php $this->renderPartial('allSubjectsGrid', array('model'=>$model)); ?>
	</div>
	<div class="span4">
		<div class="well">
		<h4>Subjects Under this Course</h4>
		<?php $this->renderPartial('selectedSubjectsGrid', array('model'=>$model)); ?>
		</div>
	</div>
</div>
*/ ?>