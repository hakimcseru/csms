<?php
$student_collection_fine = new StudentFine('search');
$student_collection_fine->unsetAttributes();  // clear any default values
$student_collection_fine->student_pk = $model->student_pk;
$student_collection_fine->session_id = $eninfo->session;



$this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-collection-fine-grid',
	'dataProvider'=>$student_collection_fine->search(),
	
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
                    'name'=>'amount',
                    'type'=>'raw',
                    'value'=>'Bndate::t($data->amount)',
                    'footer'=>$student_collection_fine->getTotals('amount',$model->student_pk,$eninfo->session),
                    
                )
		
		
		
		
	),
));


?>


