<?php
$this->breadcrumbs=array(
	'Examsettings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Examsetting','url'=>array('index')),
	array('label'=>'Create Examsetting','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('examsetting-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Examsettings</h1>
<?php $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>Yii::t('core','Create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'normal', // null, 'large', 'small' or 'mini'
	'url'=>Yii::app()->createUrl('examsetting/create'),
)); ?>

<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'examsetting-grid',
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
		'session',
		//'course',
		
		'course'=>array('name'=>'course','value'=>'$data->coursec->course_name','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_name','course_name')),
		//'department',
		
		'department'=>array('name'=>'department','value'=>'$data->departments->department_name','filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'department_name','department_name')),
		
		
		
		'batch_id'=>array('name'=>'batch_id','value'=>'$data->batch->batch_id','filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id')),
		
		'batch_group'=>array('type'=>'raw','name'=>'batch_group','value'=>'$data->batchgroup->group_name." (". $data->batchgroup->id .")"','filter'=>CHtml::listData(BatchGroup::model()->findAll(array('order'=>'group_name')),'group_name','group_name')),
		
		//'subject',
		array(
			'name'=>'subject',
		'value'=>'$data->subjects?$data->subjects->subject_name:""',
		'filter'=>CHtml::listData(Subject::model()->findAll(array('order'=>'subject_name')),'subject_name','subject_name')
		
		),
		
		
		'semester'=>array('name'=>'semester','value'=>'CourseSemesterLebel::model()->semesterLebel($data->course,$data->semester,1)','filter'=>CHtml::listData(CourseSemesterLebel::model()->findAll(),'lebel','lebel')),
		

		
		
		'mark_type',
		'pass_mark',
		'full_mark',
		array(
			'header'=>'Teacher',
			'value'=>'$data->allteacher($data)',
		
		),
		'lock',
		//'semester',
		
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'template'=>'{view}{update}{delete}{add}{marks}{print}',
            'buttons'=>array
            (
                
               
			   
			 'add' => array
                (
                    'label'=>'Add Marks',
                    'icon'=>'plus',
                    'url'=>'Yii::app()->createUrl("examsetting/add", array("id"=>$data->id))',
                    'options'=>array(
                        'class'=>'btn btn-small btn-info',
                    ),
                ),
				
				
				
				'marks' => array
                (
                    'label'=>'ViewMarks',
                    //'icon'=>'plus',
                    'url'=>'Yii::app()->createUrl("examsetting/viewmarks", array("id"=>$data->id))',
                    'options'=>array(
                        'class'=>'btn btn-small btn-info',
                    ),
                ),
				
				'print' => array
                (
                    'label'=>'Print',
                    //'icon'=>'plus',
                    'url'=>'Yii::app()->createUrl("examsetting/printmarks", array("id"=>$data->id))',
                    'options'=>array(
                        'class'=>'btn btn-small btn-info',
                    ),
                ),
			
			),
		),
		
	),
)); ?>

<script type="text/javascript">
	function getUrl(link)
	{
		baseUrl = '<?php echo Yii::app()->urlManager->createUrl('examsetting/export'); ?>';
		queryString = $.fn.yiiGridView.getUrl("examsetting-grid");
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
<td><a class="btn btn-primary" style="margin-right:20px;"  class="btnPrint" href="#" onclick="getUrl(this)" ><?php echo Yii::t('core','Excel Export');?></a></td>
