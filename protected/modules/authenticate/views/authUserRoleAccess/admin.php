<?php
$this->breadcrumbs=array(
	'Auth User Role Accesses',
);

$this->menu=array(
array('label'=>'List AuthUserRoleAccess','url'=>array('index')),
array('label'=>'Create AuthUserRoleAccess','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('auth-user-role-access-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Auth User Role Accesses</h1>
<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Create',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('authenticate/authUserRoleAccess/create'),
)); ?>
&nbsp;

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
'id'=>'auth-user-role-access-grid',
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
		'role_id',
		'module',
		'controller',
		'action',
array(
//'class'=>'bootstrap.widgets.BootButtonColumn',
'class'=>'CButtonColumn',

'template'=>'{view}{update}{delete}',

),
),
)); ?>
