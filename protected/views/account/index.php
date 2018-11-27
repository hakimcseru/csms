
<?php
$this->breadcrumbs=array(
	'Account Processes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AccountProcess','url'=>array('index')),
	array('label'=>'Create AccountProcess','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('account-process-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Account Processes</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'account-process-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'month',
		'year',
		'process_date',
		'process_status',
		'lock',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
                    'template' => '{update} {process}',
                    'buttons'=>array(
                            'process' => array(
                                    'label'=>'Process', // text label of the button
                                    'url'=>"CHtml::normalizeUrl(array('process', 'id'=>\$data->id))",
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/copy.gif',  // image URL of the button. If not set or false, a text link is used
                                    //'options' => array('class'=>'copy'), // HTML options for the button
                            ),
                    ),

		),
	),
)); ?>
