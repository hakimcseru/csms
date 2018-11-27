<?php
$this->breadcrumbs=array(
	Yii::t('core','Course')=>array('index'),
	$model->course_name,
);

$this->menu=array(
	array('label'=>'List Course','url'=>array('index')),
	array('label'=>'Create Course','url'=>array('create')),
	array('label'=>'Update Course','url'=>array('update','id'=>$model->course_pk)),
	array('label'=>'Delete Course','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->course_pk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Course','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Course')?> : <?php echo $model->course_name; ?></h1>
<div class ="row">
	<div class="span5">
	<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
		'data'=>$model,
		'attributes'=>array(

			array(
								'name'=>'course_pk',
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($model->course_pk)),
						),
			'course_name',
			array(
								'name'=>Yii::t('core','No of Semester'),
								'type'=> 'html',
								'value'=> nl2br(Bndate::t($model->semester)),
						),
			array(
								'name'=>Yii::t('core','List of Semester'),
								'type'=> 'html',
								'value'=> nl2br($model->allSemisterLebelsString($model->course_pk,$model->semester)),
						),

		),
	)); ?>
	</div>
	<div class="span4">
		<div class="well">
			<?php $courses = $model->departments ?>
		<h4><?php echo Yii::t('core','List of Departments');?></h4>
		<?php $this->renderPartial('showDepartmentsOnCourse', array('model'=>$model)); ?>
		</div>
	</div>
</div>
