<?php
$this->breadcrumbs=array(
	'Licences'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Licence', 'url'=>array('index')),
	array('label'=>'Create Licence', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('licence-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Stock :: Manage Licence</h1>

<?php
$this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'label' => 'New Licence',
        'type' => 'primary',
	
		
		'url'=>Yii::app()->urlManager->createUrl('/certificate/licence/create'),
    )
);?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'licence-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'dob',
		'nationality',
		'fathers_name',
		'seaman_book_no',
		'doi_cdc',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
