<?php
$this->breadcrumbs=array(
	Yii::t('core','Faculty Members')=>array('index'),
	Yii::t('core','Manage'),
);

$this->menu=array(
	array('label'=>'List FacultyMember','url'=>array('index')),
	array('label'=>'Create FacultyMember','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('faculty-member-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Manage Faculty Members');?></h1>
<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('facultyMember/create'),
)); ?>
&nbsp;



<?php echo CHtml::link(Yii::t('core','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'faculty-member-grid',
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
		'member_id'=>array('name'=>'member_id','value'=>'Bndate::t($data->member_id)'),
		'member_name',
                array('name'=>'member_image','value'=>'CHtml::image( $data->getStImage($data->member_image),"",array(\'width\'=>30, \'height\'=>45))','type'=>'raw'),
		'faculty_id'=>array('name'=>'faculty_id','value'=>'$data->faculty->faculty_name','filter'=>CHtml::listData(Faculty::model()->findAll(array('order'=>'faculty_name')),'id','faculty_name')),
		'department_id'=>array('name'=>'department_id','value'=>'$data->department->department_name','filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'id','department_name')),
		/*
		 * 'member_father_name',

		'member_mother_name',
		'member_present_address',
		'member_permanent_address',

		'member_nationality',
		'member_gender',
		'member_dob',
		'member_profession',
		'member_email',
		'member_contact',
		'member_blood_group',
		'member_qualification',
		'member_alternate_contact',
		'member_pk',
		'member_image',
		'faculty_id',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
)); ?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('facultyMember/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("faculty-member-grid");
		pos = queryString.indexOf('?',0)
		if(pos == -1)
		{
			queryString = '';
		}
		else
		{
			queryString = queryString.substr(pos);
		}
		$(link).attr("href", baseUrl+queryString);
		//alert($.fn.yiiGridView.getUrl("attendance-final-data-grid"));
	}      
</script>
<td><a class="btn btn-primary" style="margin-right:20px;"  class="btnPrint" href="#" onclick="getUrl(this)" >Excel Export</a></td>