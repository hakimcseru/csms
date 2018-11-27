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
<h1><?php echo $model->session_id." : ".$model->name;?></h1>

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
<th style="background-color:#EFEFEF;z-index:1000">&nbsp;</th>
<?php foreach ($dates as $per):?>
<th style="background-color:#EFEFEF;z-index:1000"><?php echo $per->exam_date;?></th>
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
if($rm->room_pk==9 && $per->id==9 ) echo "session_id='".$model->session_id."' and  room_id='".$rm->room_pk."' and exam_date_id='".$per->id."'  and exam_routine_id='".$model->id."'";

if($mmd2)
{
$count=count($mmd2)*200;
echo '<div style="width:'.$count.'px;">';
foreach($mmd2 as $mmd):
echo '<div style="width:200px; float:left;">';

echo $mmd->course?$mmd->exam_time:""."<br />";
echo "<br />";
echo $mmd->course?$mmd->course->course_name:""."<br />";
echo "<br />";
echo $mmd->department?$mmd->department->department_name:"";
echo "<br />";
echo $mmd->batch?$mmd->batch->batch_id:"";
echo "<br />";
echo $mmd->batchgroup?$mmd->batchgroup->group_name:"";
echo "<br />";
echo CourseSemesterLebel::model()->semesterLebel($mmd->course_id,$mmd->semester_id,1);
echo "<br />";
echo $mmd->batch_section?$mmd->batch_section->group_name:"";
echo "<br />";
//echo 	$mmd->subject?$mmd->subject->subject_name:"";
echo "<br />";
echo $mmd->facultyMember->member_name;
echo "<br />";
echo $mmd->A_facultyMember?$mmd->A_facultyMember->member_name."<br />":"";

echo $mmd->A_facultyMember2?$mmd->A_facultyMember2->member_name."<br />":"";

echo $mmd->A_facultyMember3?$mmd->A_facultyMember3->member_name."<br />":"";

echo $mmd->A_facultyMember4?$mmd->A_facultyMember4->member_name."<br />":"";

echo $mmd->A_facultyMember5?$mmd->A_facultyMember5->member_name."<br />":"";


echo '<a href="'.Yii::app()->createUrl('examRoutineDetail/update',array('id'=>$mmd->id)).'"  >
Update</a>';

echo CHtml::link(CHtml::encode('Remove'), array('examRoutineDetail/delete', 'id'=>$mmd->id),
array(
'submit'=>array('examRoutineDetail/delete', 'id'=>$mmd->id),
'class' => 'delete btn btn-danger','confirm'=>'This will remove the image. Are you sure?'
)
);
echo '<a href="'.Yii::app()->createUrl('examRoutineDetail/printBlankMarkSheet',array('id'=>$mmd->id)).'"  >
Blank Marksheet</a>';

echo "</div>";
endforeach;
echo "</div>";


echo '<a href="'.Yii::app()->createUrl('examRoutineDetail/create',array('session_id'=>$model->session_id,'room_id'=>$rm->room_pk,'exam_date_id'=>$per->id,'exam_routine_id'=>$model->id)).'"  >
Add</a> <br />';

}else{?>
<a href="<?php echo Yii::app()->createUrl('examRoutineDetail/create',array('session_id'=>$model->session_id,'room_id'=>$rm->room_pk,'exam_date_id'=>$per->id,'exam_routine_id'=>$model->id));?>"  >
Add</a>
<?php }?>


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