<?php
$connection=Yii::app()->db;
        $command=$connection->createCommand("
		
		
		");
        //$amount = $command->queryAll();
		
		//print_r($amount);
		
	//print_r($model->getAllWeekDays());	



$this->breadcrumbs=array(
	'Attendance Temp Datas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AttendanceTempData','url'=>array('index')),
	array('label'=>'Create AttendanceTempData','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('attendance-calendar-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1><?php echo Yii::t('attendance', 'Manage Calendar'); ?></h1>

<style type="text/css">
	.grid-view .button-column select{ width: 100%;}
</style>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php echo CHtml::link(Yii::t('attendance', 'Add to Calendar'), Yii::app()->createUrl("attendance/calendar/create"),  // the link for open the dialog
    array(
        'style'=>'cursor: pointer; text-decoration: underline;',
        ));?>

<?php $this->widget('ext.groupgridview.BootGroupGridView',array(
	'id'=>'attendance-calendar-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'enableSorting'=>false,
	'selectableRows'=>false,
	'mergeColumns' => array('type', 'title', 'note'),
	//'extraRowColumns' => array('date'),
	//'extraRowExpression'=>'"<strong>".$data->tdate()."</strong>"',
	'columns'=>array(
	
		'date'=>array('name'=>'date', 'value'=>'Bndate::t($data->date, true)'),
		'course_id'=>array('name'=>'course_id', 'value'=>'$data->course->course_name','filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_name')),'course_pk','course_name')),
		'type'=>array('name'=>'type', 'value'=>'$data->types[$data->type]', 'filter'=>$model->types),
		'title'=>array('name'=>'title', 'value'=>'$data->title', 'filter'=>CHtml::listData(AttendanceCalendar::model()->findAll(array('order'=>'title')),'title','title')),
		'note'=>array('name'=>'note', 'value'=>'$data->note', 'filter'=>false),
		/*'status'=>array('name'=>'status', 'cssClassExpression'=> '$data->status? "alert alert-info" : "alert"','value'=>'$data->statusList[$data->status]."<br />".$data->processed_on', 'filter'=>$model->statusList, 'type'=>'raw'),*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'header'=>CHtml::dropDownList(get_class($model).'_pageSize',Yii::app()->user->getState(get_class($model).'_pageSize'), array(10=>10,20=>20,50=>50,100=>100),array(
				'onchange'=>"$.fn.yiiGridView.update('attendance-calendar-grid',{ data:{".get_class($model)."_pageSize: $(this).val() }})",
			)),
			'template'=>'{update}{delete}',
			'buttons'=>array
			(
				
				
			),
		)
	),
)); ?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'modalAjaxView')); ?>
<div class="modal-body"></div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
	var modalUpdateUrl;
// here is the magic
function modalAjaxForm()
{
	//alert(url);
    <?php echo CHtml::ajax(array(
            'url'=>  "js:modalUpdateUrl",
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#modalAjaxView div.modal-body').html(data.div);
                          // Here is the trick: on submit-> once again this function!
                    $('#modalAjaxView div.modal-body form').submit(modalAjaxForm);
                }
                else
                {
                    $('#modalAjaxView div.modal-body').html(data.div);
                    setTimeout(\"$('#modalAjaxView').modal('hide') \",2000);
					$.fn.yiiGridView.update('attendance-calendar-grid');
                }

            } ",
            ))?>;
    return false;

}
</script>