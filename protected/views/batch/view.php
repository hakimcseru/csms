<?php
$this->breadcrumbs=array(
	Yii::t('core','Batch')=>array('index'),
	Bndate::t($model->batch_pk),
);

$this->menu=array(
	array('label'=>'List Batch','url'=>array('index')),
	array('label'=>'Create Batch','url'=>array('create')),
	array('label'=>'Update Batch','url'=>array('update','id'=>$model->batch_pk)),
	array('label'=>'Delete Batch','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->batch_pk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Batch','url'=>array('admin')),
);
?>

<h2><?php echo Yii::t('core','Batch')." # ".Bndate::t($model->batch_id); ?></h2>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(

		'batch_id'=>array('name'=>'batch_id','value'=>Bndate::t($model->batch_id)),
		'batch_start_date'=>array('name'=>'batch_start_date','value'=>Bndate::t($model->batch_start_date)),
		'batch_end_date'=>array('name'=>'batch_end_date','value'=>Bndate::t($model->batch_end_date)),

		'batch_status'=>array('name'=>'batch_status','value'=>Yii::t('core',$model->batch_status)),

		'department_id'=>array('name'=>'department_id','value'=>$model->department->department_name),
		'batch_ref_course_pk'=>array('name'=>'batch_ref_course_pk','value'=>$model->course->course_name ),



	),
)); ?>

<?php /*$this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs', // 'tabs' or 'pills'
    'tabs'=>array(
        array('label'=>"Class ($model->classCount)", 'content'=> $this->renderPartial('_class', array('model' => $model),true)),
		array('label'=>"Students ($model->studentsCount)", 'content'=> $this->renderPartial('_students', array('model' => $model),true)),
		array('label'=>"Routine", 'content'=> $this->renderPartial('_routine', array('model' => $model),true)),
    ),
)); */?>

<?php 
$model2= new BatchGroup("search");
$model2->batch_id=$model->batch_pk;
?>
<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'batch-group-grid',
	'dataProvider'=>$model2->search(),
	 'template'=>"{pager}{summary}\n{items}\n{summary}{pager}",
         'pager'=>array(
'header'=>'',
'cssFile'=>false,
'maxButtonCount'=>17,


'firstPageLabel'=>'<<',
'lastPageLabel'=>'>>',
'prevPageLabel'=>'<',
'nextPageLabel'=>'>',
),
	//'filter'=>$model2,
	'columns'=>array(
		/*
		array(
		'name'=>'batch_id',
		'value'=>'$data->batch->batch_id',
			'filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_pk','batch_id'),
		),*/

		'group_name',
		
	),
)); ?>