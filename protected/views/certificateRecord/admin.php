<?php
$this->breadcrumbs=array(
	Yii::t('core','Certificate Records')=>array('index'),
	Yii::t('core','Manage Certificate Records'),
);

$this->menu=array(
	array('label'=>'List CertificateRecord','url'=>array('index')),
	array('label'=>'Create CertificateRecord','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('certificate-record-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Certificate Records')?></h1>

<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('certificateRecord/create'),
)); ?>
&nbsp;

<?php echo CHtml::link(Yii::t('core','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'certificate-record-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'received_date',
		'received_by',
		'student_id',
		'course_id',
		'department_id',
		/*
		'session_id',
		'batch_id',
		'batch_group_id',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
