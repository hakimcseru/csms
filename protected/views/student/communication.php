<?php
$this->breadcrumbs=array(
	Yii::t('core','Student')=>array('index'),
	Yii::t('core','Manage'),
);
$active = 'manage';
$this->renderPartial('_menu', array('active'=>$active));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('student-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('core','Student Communication')?></h1>

<?php echo CHtml::link(Yii::t('core','Advanced Search'),'#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchcomm',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'student-grid',
	'dataProvider'=>$model->search2(),
        'template'=>"{pager}{summary}\n{items}\n{summary}{pager}",
	'filter'=>$model,
    'pager'=>array(
'header'=>'',
'cssFile'=>false,
'maxButtonCount'=>17,


'firstPageLabel'=>'<<',
'lastPageLabel'=>'>>',
'prevPageLabel'=>'<',
'nextPageLabel'=>'>',
),
	'columns'=>array(

			'student_id'=>array('name'=>'student_id','value'=>'Bndate::t($data->student_id)'),
		'student_name',
		'student_email',
		'student_contact',
		'student_present_address',
		'student_permanent_address',
		'student_blood_group',
		'roll_no'=>array('name'=>'roll_no','value'=>'Bndate::t($data->EnrollmentInfoLast->roll_no)'),
		
		
		
		
		

		


//'student_father_name',
		//'student_mother_name',
		//'student_present_address',
		//'student_permanent_address',
		//'student_nationality',
		//'student_gender',
		//'student_dob',
		//'student_pob',
		//'student_profession',
		//'student_email',
		//'student_fb_id',
		//'student_contact',
		//'student_blood_group',
		//'student_qualification',
		//'student_alternate_contact',
		//'student_reason_of_photography',
		//'student_expectation',
		//'student_pk',
		array(
			'class'=>'CButtonColumn',
		),
	),
));?>
<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('student/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("student-grid");
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
<td><a class="btn btn-primary btnPrint" style="margin-right:20px;"  href="#" onclick="getUrl(this)" >Excel Export</a></td>