<?php
$this->breadcrumbs=array(
	Yii::t('core','Department')=>array('index'),
	$model->department_name,
);

$this->menu=array(
	array('label'=>'List Department','url'=>array('index')),
	array('label'=>'Create Department','url'=>array('create')),
	array('label'=>'Update Department','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Department','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Department','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Department');?> <?php echo $model->department_name; ?></h1>
<div class ="row">
	<div class="span5">
<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(
								'name'=>'id',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($model->id)),
						),
		'department_name',
	),
)); ?>
</div>
	<div class="span4">
		<div class="well">

		<h4><?php echo Yii::t('core','List of Courses');?></h4>
		<?php $this->renderPartial('showCoursesOnDepartment', array('model'=>$model)); ?>
		</div>
	</div>
</div>
