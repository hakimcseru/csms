<?php
$student_remaining= new StudentRemaining('search');
$student_remaining->unsetAttributes();  // clear any default values
$student_remaining->student_pk = $model->student_pk;
$student_remaining->session_id = $eninfo->session;

$this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-remaining-grid',
	'dataProvider'=>$student_remaining->search(),
	
	'columns'=>array(
		
           
		
            
                'description',
		
                array(
                       'name'=>'remaining_amount',
                       'type'=>'raw',
                        'value'=>'Bndate::t($data->remaining_amount)',
                       'footer'=>$student_remaining->getTotals('remaining_amount',$model->student_pk,$eninfo->session),

                   )
		
	),
)); 


?>


