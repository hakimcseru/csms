<?php
$this->breadcrumbs=array(
	Yii::t('core','Course')=>array('index'),
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List Course','url'=>array('index')),
	array('label'=>'Create Course','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('course-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage')." ". Yii::t('core','Course');?></h1>






<?php $this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'course-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'course_pk'=>array('name'=>'course_pk','value'=>  'Bndate::t($data->course_pk)' ),
		'course_name',
		'semester'=>array('name'=>'semester','value'=>  'Bndate::t($data->semester)' ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
