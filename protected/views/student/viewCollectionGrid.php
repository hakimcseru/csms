<?php
$student_collection = new StudentCollection('search');
$student_collection->unsetAttributes();  // clear any default values
$student_collection->student_pk = $model->student_pk;
$student_collection->session_id = $eninfo->session;

$this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-collection-grid',
	'dataProvider'=>$student_collection->search(),
	
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
                    'name'=>'collection_amount',
                    'type'=>'raw',
                    'value'=>'Bndate::t($data->collection_amount)',
                    'footer'=>$student_collection->getTotals('collection_amount',$model->student_pk,$eninfo->session),
                    
                )
                
            ,
            
            
		
		
	),
)); ?>


