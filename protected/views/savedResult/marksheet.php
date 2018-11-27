
<h1>Saved Student Result</h1>



<form method="post" action="<?php echo Yii::app()->createUrl("savedResult/printmarksheet");?>" id="dcad-res-addl-export-form" >  
<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Print Marksheet',
		)); ?>
	
		
	</div>
<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'saved-result-grid',
	'dataProvider'=>$model->search2(),
	
		
	//'filter'=>$model,
	'columns'=>array(
	array(
                 'class' => 'CCheckBoxColumn',
                 'selectableRows' => '2',
                 'header'=>'Selected',
                 'id'=>'someChecks', 
                 'checked'=>'Yii::app()->user->getState($data->id)',
            ),
		//'id',
		'student_id'=>array('name'=>'student_id','value'=>'Bndate::t($data->student_id)'),
		'name',
		'roll_no'=>array('name'=>'roll_no','value'=>'Bndate::t($data->roll_no)'),
		'session_id'=>array('name'=>'session_id','value'=>'Bndate::t($data->session_id)'),
		'course',
		'department',
		'semester',
		'batch_group',
		/*
		'course_id',
		'department_id',
		'semester_id',
		'batch_group_id',*/
		
		
		
		'total_number'=>array('name'=>'total_number','value'=>'Bndate::t(ceil($data->total_number))'),
		'result',
		'position'=>array('name'=>'position','value'=>'Bndate::t($data->position)'),
		/*
		'published_date',
		'saved_date',
		'saved_by',
		*/
		
	),
)); ?>

 

<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Print Marksheet',
		)); ?>
	
		
	</div>
</form>
