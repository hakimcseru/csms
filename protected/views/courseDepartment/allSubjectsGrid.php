<?php
//$subjects = new Subject('search');
$this->widget('ext.bootstrap.widgets.BootGridView',array(
	'id'=>'subject-grid',
	'dataProvider'=>$subjects->search(),
	'filter'=>$subjects,
	'columns'=>array(
		'subject_code',
		'subject_name',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{add}',
			'htmlOptions'=>array('width'=>'40px'),
			'buttons'=>array
			(
				'view' => array
				(
					'label'=>'View',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/buttons/view.png',
					'url'=>'Yii::app()->createUrl("subject/view", array("id"=>$data->subject_pk))',
					'options'=>array(  // this is the 'html' array but we specify the 'ajax' element
						 'ajax'=>array(
						   'type'=>'POST',
						   'url'=>"js:$(this).attr('href')", // ajax post will use 'url' specified above
						   'success'=>"function(data)
							{
								msg = eval('(' + data + ')');
								$('#dialogSubjectView div.modal-body').html(msg.div);
								$('#dialogSubjectView').modal('show');
								//setTimeout(\"$('#dialogSubjectView').modal('hide') \",2000);

							} ",
						 ),
					   ),
				),
				'add'=> array
				(
					'label'=>'Add to issue',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/buttons/add.png',
					'url'=>'Yii::app()->createUrl("courseSubject/create", array("course"=>'.$model->course_id.', "subject"=>$data->subject_pk,"department"=>'.$model->department_id.'))',
					//'visible'=>'$data->score > 0',
					//'click'=>'function(){ buttonClick=1; createSubject(); $("#dialogSubjectCreateForm").dialog("open");}',
					'options'=>array(  // this is the 'html' array but we specify the 'ajax' element
						 'ajax'=>array(
						   'type'=>'POST',
						   'url'=>"js:$(this).attr('href')", // ajax post will use 'url' specified above
						   'success'=>"function(data)
							{
								//buttonClick=1;
								data = eval('(' + data + ')');
								$('#dialogSubjectCreateForm div.modal-body').html(data.div);
								$('#dialogSubjectCreateForm div.modal-body form').submit(createSubject);
								$('#dialogSubjectCreateForm').modal('show');

							} ",
						 ),
					   ),
				),
			),

		),
	),
)); ?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array(
    'id'=>'dialogSubjectCreateForm',
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
    <h3>Add Subject</h3>
</div>
<div class="modal-body"></div>
<div class="modal-footer">
    <?php echo CHtml::link('Close', '#', array('class'=>'btn btn-primary', 'data-dismiss'=>'modal')); ?>
</div>
<?php $this->endWidget();?>

<script type="text/javascript">
// here is the magic
function createSubject()
{
	<?php echo CHtml::ajax(array(
			'url'=>array('courseSubject/create'),
			'data'=> "js:$(this).serialize()",
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				if (data.status == 'failure')
				{
					$('#dialogSubjectCreateForm div.modal-body').html(data.div);
						  // Here is the trick: on submit-> once again this function!
					$('#dialogSubjectCreateForm div.modal-body form').submit(createSubject);
				}
				else
				{
					$('#dialogSubjectCreateForm div.modal-body').html(data.div);
					setTimeout(\"$('#dialogSubjectCreateForm').modal('hide') \",2000);
					$('#course-subject-grid').yiiGridView.update('course-subject-grid');
				}

			} ",
			))?>;
	return false;

}
</script>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array(
    'id'=>'dialogSubjectView',
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