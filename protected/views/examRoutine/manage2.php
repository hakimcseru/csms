<script src="<?php echo Yii::app()->request->baseUrl; ?>/resources/fixedtable/jquery.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/resources/fixedtable/tableHeadFixer.js"></script>
<style>
			#parent {
				height: 600px;
			}
			
			#fixTable {
				width: 1800px !important;
			}
		</style>
		<script>
			$(document).ready(function() {
				$("#fixTable").tableHeadFixer({"left" : 1}); 
			});
		</script>
<h1><?php echo $model->name;?> (কক্ষ বরাদ্দ)</h1>

<br/>
<style>
.table th, .table td {
    border: 1px solid #DDDDDD !important;
	}
</style>


<div id="parent">
<table class="table" id="fixTable">
<thead style="background-color:#099">

<tr>
<th>&nbsp;</th>
<?php foreach ($dates as $per):?>
<th><?php echo $per->exam_date;?></th>
<?php endforeach;?>
</tr>
</thead>
<tbody>
<?php 

foreach ($room as $rm):
echo '<tr>
<th width="80">'.$rm->room_no.'</th>';
	foreach ($dates as $per):
?>
<td>
<?php $mmd2=ExamRoutineDetail::model()->findAll("session_id='".$model->session_id."' and  room_id='".$rm->room_pk."' and exam_date_id='".$per->id."'  and exam_routine_id='".$model->id."'");

if($mmd2)
{
	foreach($mmd2 as $mmd):
echo $mmd->course?$mmd->exam_time."<br />":"";

	endforeach;

}?>


</td>
<?php 
	endforeach;
echo '</tr>';	
endforeach;
?>
</tbody>
</table>
</div>            
<?php 
$this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'CView')); 
?>
<div>
<a data-dismiss="modal">&times;</a>
<h4 id="content_header"></h4>
</div>
<div>
<?php 
$model2=new examRoutineDetail;
//$this->renderpartial('//examRoutineDetail/create',array('model'=>$model2));?>
</div>    
<?php $this->endWidget(); ?>

<script type="text/javascript">
var CUrl;
function CViewForm()
{
$('#content_header').html(CHeader);

    <?php echo CHtml::ajax(array(
            'url'=>  "js:CUrl",
            'data'=> "js:$(this).serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#CView div.modal-body').html(data.div);
                    $('#CView div.modal-body form').submit(CViewForm);
                }
                else
                {
                   $('#CView div.modal-body').html(data.div);
                   setTimeout(\"$('#CView').modal('hide') \",2000);
                   $.fn.yiiGridView.update('client-grid');
                }

            } ",
            ))?>;
    return false;

}
</script>