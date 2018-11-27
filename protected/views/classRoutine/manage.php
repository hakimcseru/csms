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
        
			
		     
<h1 style="text-align:center"><?php echo $model->calendar_name." : ".Bndate::BanglaWeekDay($weekday);?></h1>

<br/>
<style>
.table th, .table td {
    border: 1px solid #DDDDDD !important;
	}
</style>


<div id="parent">
<table class="table" id="fixTable">
<thead style="background-color:#099">
    <tr class="z-index:1000">
    <th style="background-color:#EFEFEF;z-index:1000">&nbsp;</th>
    <?php foreach ($period as $per):?>
    <th style="background-color:#EFEFEF;z-index:1000"><?php echo $per->name;?></th>
    <?php endforeach;?>
    </tr>
</thead>
<tbody>
			<?php 
            
            foreach ($room as $rm):
            echo '<tr>
            <th width="80">'.$rm->room_no.'</th>';
                foreach ($period as $per):
            ?>
            <td>
            <?php $mmd2=ClassRoutine::model()->findAll("session_id='".$model->session_id."' and  room_id='".$rm->room_pk."' and class_period_id='".$per->id."' and weekday='".$weekday."' and calendar_id='".$model->id."'");
            
            if($mmd2)
            {
            //echo '<table><tr>';
            foreach($mmd2 as $mmd):
            echo '<div class="float:left; width:300px !important; ">';
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
            echo $mmd->sescion?$mmd->sescion->section_name:"";
            echo "<br />";
            //echo $mmd->subject?$mmd->subject->subject_name:"";
            echo "<br />";
            echo $mmd->facultyMember->member_name;
            echo "<br />";
            echo $mmd->A_facultyMember?$mmd->A_facultyMember->member_name:"";
            echo "<br />";
            echo '<a href="'.Yii::app()->createUrl('classRoutine/update',array('id'=>$mmd->id)).'"  >
            Update</a>';
            
            echo CHtml::link(CHtml::encode('Remove'), array('classRoutine/delete', 'id'=>$mmd->id),
            array(
            'submit'=>array('classRoutine/delete', 'id'=>$mmd->id),
            'class' => 'delete btn btn-danger','confirm'=>'This will remove the image. Are you sure?'
            )
            );
            
            
            echo "</div>";
            endforeach;
           // echo "</tr>";
            //echo "</table>";
            
            echo '<a href="'.Yii::app()->createUrl('classRoutine/create',array('session_id'=>$model->session_id,'room_id'=>$rm->room_pk,'class_period_id'=>$per->id,'weekday'=>$weekday,'calendar_id'=>$model->id)).'"  >
            Add</a>';
            }else{?>
            <a href="<?php echo Yii::app()->createUrl('classRoutine/create',array('session_id'=>$model->session_id,'room_id'=>$rm->room_pk,'class_period_id'=>$per->id,'weekday'=>$weekday,'calendar_id'=>$model->id));?>"  >
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
$model2=new ClassRoutine;
$this->renderpartial('//classRoutine/create',array('model'=>$model2));?>
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