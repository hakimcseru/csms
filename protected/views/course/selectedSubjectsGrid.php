<?php
$courseSubject = new CourseSubject('search');
$courseSubject->unsetAttributes();  // clear any default values
$courseSubject->course_subject_ref_course_pk = $model->course_pk;
$this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'course-subject-grid',
	'dataProvider'=>$courseSubject->search(),
	'columns'=>array(
		array(
			'name'=>'course_subject_ref_subject_pk',
			'value'=>'$data->subject->subject_name',
		),
		'course_subject_semester_no',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
			'htmlOptions'=>array('width'=>'40px'),
			'buttons'=>array
			(
				'view' => array
				(
					'label'=>'View',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/buttons/view.png',
					'url'=>'Yii::app()->createUrl("subject/view", array("id"=>$data->course_subject_ref_subject_pk))',
					'options'=>array(  // this is the 'html' array but we specify the 'ajax' element
						 'ajax'=>array(
						   'type'=>'POST',
						   'url'=>"js:$(this).attr('href')", // ajax post will use 'url' specified above
						   'success'=>"function(data)
							{
								msg = eval('(' + data + ')');
								$('#dialogSelectedSubjectView div.modal-body').html(msg.div);
								$('#dialogSelectedSubjectView').modal('show');
								//setTimeout(\"$('#dialogInboxView').dialog('close') \",2000);

							} ",
						 ),
					   ),
				),
				'update'=> array
				(
					'label'=>'Add to issue',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/buttons/edit.png',
					'url'=>'Yii::app()->createUrl("courseSubject/update", array("id"=>$data->course_subject_pk))',
					//'visible'=>'$data->score > 0',
					//'click'=>'function(){ buttonClick=1; addSubject(); $("#dialogSubjectForm").dialog("open");}',
					'options'=>array(  // this is the 'html' array but we specify the 'ajax' element
						 'ajax'=>array(
						   'type'=>'POST',
						   'url'=>"js:$(this).attr('href')", // ajax post will use 'url' specified above
						   'success'=>"function(data)
							{
								//buttonClick=1;
								data = eval('(' + data + ')');
								$('#dialogSubjectUpdate div.modal-body').html(data.div);
								$('#dialogSubjectUpdate div.modal-body form').submit(updateSubject);
								$('#dialogSubjectUpdate').modal('show');

							} ",
						 ),
					   ),
				),
			),

		),
	),
)); ?>


<?php $this->beginWidget('bootstrap.widgets.BootModal', array(
    'id'=>'dialogSubjectUpdate',
    'htmlOptions'=>array('class'=>'hide'),
    'events'=>array(
        'show'=>"js:function() { console.log('modal show.'); }",
        'shown'=>"js:function() { console.log('modal shown.'); }",
        'hide'=>"js:function() { console.log('modal hide.'); }",
        'hidden'=>"js:function() { console.log('modal hidden.'); }",
    ),
)); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Update Subject</h3>
</div>
<div class="modal-body"></div>
<div class="modal-footer">
    <?php echo CHtml::link('Close', '#', array('class'=>'btn btn-primary', 'data-dismiss'=>'modal')); ?>
</div>
<?php $this->endWidget();?>

<script type="text/javascript">
// here is the magic
function updateSubject()
{
	<?php echo CHtml::ajax(array(
			'url'=>array('courseSubject/update'),
			'data'=> "js:$(this).serialize()",
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				if (data.status == 'failure')
				{
					$('#dialogSubjectUpdate div.modal-body').html(data.div);
						  // Here is the trick: on submit-> once again this function!
					$('#dialogSubjectUpdate div.modal-body form').submit(updateSubject);
				}
				else
				{
					$('#dialogSubjectUpdate div.modal-body').html(data.div);
					setTimeout(\"$('#dialogSubjectUpdate').modal('hide') \",2000);
					$('#course-subject-grid').yiiGridView.update('course-subject-grid');
				}

			} ",
			))?>;
	return false;

}
</script>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array(
    'id'=>'dialogSelectedSubjectView',
    'htmlOptions'=>array('class'=>'hide'),
    'events'=>array(
        'show'=>"js:function() { console.log('modal show.'); }",
        'shown'=>"js:function() { console.log('modal shown.'); }",
        'hide'=>"js:function() { console.log('modal hide.'); }",
        'hidden'=>"js:function() { console.log('modal hidden.'); }",
    ),
)); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Subject Details</h3>
</div>
<div class="modal-body"></div>
<div class="modal-footer">
    <?php echo CHtml::link('Close', '#', array('class'=>'btn btn-primary', 'data-dismiss'=>'modal')); ?>
</div>
<?php $this->endWidget();?>