<?php
$this->breadcrumbs=array(
	'Auth Controllers',
);

$this->menu=array(
array('label'=>'List AuthController','url'=>array('index')),
array('label'=>'Create AuthController','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('auth-controller-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Auth Controllers</h1>


<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Create',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('authenticate/authController/create'),
)); ?>
&nbsp;
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
'id'=>'auth-controller-grid',
'dataProvider'=>$model->search(),
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
'filter'=>$model,
'columns'=>array(
		'id',
		'module_id',
		'name',
		'active',
array(
//'class'=>'bootstrap.widgets.BootButtonColumn',
'class'=>'CButtonColumn',
'template'=>'{view}{update}{delete}',

),
),
)); ?>
