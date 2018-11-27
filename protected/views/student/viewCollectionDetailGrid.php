<?php
$student_collection_detail = new StudentCollectionDetail('search');
$student_collection_detail->unsetAttributes();  // clear any default values
$student_collection_detail->student_pk = $model->student_pk;
$student_collection_detail->session_id = $eninfo->session;


$this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-collection-detail-grid',
	'dataProvider'=>$student_collection_detail->search(),
	
	'columns'=>array(
		

                array(
                       'name'=>'deposite_date',
                       'type'=>'raw',
                       'value'=>'Bndate::t(date("Y-m-d",strtotime($data->deposite_date)))',
                       

                   ),
                'collection_for',
		
            array(
                    'name'=>'collection_amount',
                    'type'=>'raw',
                    'value'=>'Bndate::t($data->collection_amount)',
                    'footer'=>$student_collection_detail->getTotals('collection_amount',$model->student_pk,$eninfo->session),
                    
                )
		
		
		
		
	),
));


?>


