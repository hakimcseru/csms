<?php
$this->breadcrumbs=array(
	Yii::t('core','Course')." ".Yii::t('core','Department')=>array('index'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List CourseDepartment','url'=>array('index')),
	array('label'=>'Create CourseDepartment','url'=>array('create')),
	array('label'=>'Update CourseDepartment','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CourseDepartment','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CourseDepartment','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Course')." ".Yii::t('core','Department');?> # <?php echo Bndate::t($model->id); ?></h1>
<div >
	<div class="span7">
<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(

		array(
					'name'=>'id',
					'value'=>Bndate::t($model->id),
			),

		array(
			'name'=>'course_id',
			'value'=>$model->course->course_name,
			'type'=>'html',
		),
		array(
			'name'=>'department_id',
			'value'=>$model->department->department_name,
			'type'=>'html',
		),

	),
)); ?>
	</div>
<div class="span4">
		<div class="well">
		<h4><?php echo Yii::t('core','Subjects Under this Course-Department');?></h4>
		<?php $this->renderPartial('viewSubjectsGrid', array('model'=>$model)); ?>
		</div>
	</div>
</div>
