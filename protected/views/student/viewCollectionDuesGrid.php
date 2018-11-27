<?php
$student_dues = new StudentDues('search');
$student_dues->unsetAttributes();  // clear any default values
$student_dues->student_pk = $model->student_pk;
$student_dues->session_id = $eninfo->session;

$this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-dues-grid',
	'dataProvider'=>$student_dues->search(),
	
	'columns'=>array(
		
            array(
                        'name'=>'year',
                       'type'=>'raw',
                       'value'=>'Bndate::BanglaNumDate($data->year)',

                
                ),
		
            array(
                        'name'=>'month',
                       'type'=>'raw',
                       'value'=>'Bndate::BanglaNumMonth($data->month)',

                
                ),
                'comment',
		
                array(
                       'name'=>'due_amount',
                       'type'=>'raw',
                        'value'=>'Bndate::t($data->due_amount)',
                       'footer'=>$student_dues->getTotals('due_amount',$model->student_pk,$eninfo->session),

                   )
		
	),
)); 


?>


