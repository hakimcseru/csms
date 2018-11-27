<?php
$this->breadcrumbs=array(
	Yii::t('core','Subject')=>array('index'),
	Bndate::t($model->subject_pk),
);

$this->menu=array(
	array('label'=>'List Subject','url'=>array('index')),
	array('label'=>'Create Subject','url'=>array('create')),
	array('label'=>'Update Subject','url'=>array('update','id'=>$model->subject_pk)),
	array('label'=>'Delete Subject','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->subject_pk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subject','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View')." ".Yii::t('core','Subject');?> # <?php echo Bndate::t($model->subject_pk); ?></h1>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'subject_code',
		
		'subject_name',
		'id'=>array('type'=>'html','label'=>'Course','value'=>$model->coursss()),
		'syllabus'=>array('type'=>'html','name'=>'syllabus','value'=>nl2br($model->syllabus)),
		
		

	),
)); ?>

