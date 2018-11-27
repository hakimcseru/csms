<?php
$this->breadcrumbs=array(
	Yii::t('core','Student')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List Student','url'=>array('index')),
	array('label'=>'Manage Student','url'=>array('admin')),
);
?>
<style>
    .input-xlarge, .input-small{
        height:28px;
    }
	
</style>

<h1><?php echo Yii::t('core','Renew Student');?></h1>

<form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/student/rqcreate" id="searchForm" class="well form-search">	
    <div class="input-prepend"><span class="add-on"><i class="icon-search"></i></span><input type="text" id="TestForm_textField" name="IDSearchForm[searchid]" placeholder="Text input" class="input-xlarge">
	<input type="text" id="TestForm_session" name="IDSearchForm[session]" placeholder="Session" class="input-small">
	<input type="text" id="TestForm_deposit_date" name="IDSearchForm[deposit_date]" placeholder="" class="input-small" value="<?php echo date("Y-m-d");?>">
	</div>
	<button name="yt5" type="submit" id="yw126" class="btn">Go</button>
</form>

<?php if(isset($model->student_id))
{

if(isset($_POST['IDSearchForm']['session']))
{
//$newll=$_POST['IDSearchForm']['session']-1;

$criteria=new CDbCriteria;
$criteria->condition="student_id='".$_POST['IDSearchForm']['searchid']."'";
$criteria->order = 'session DESC';
$criteria->limit = 5;
$eninfo2=new CActiveDataProvider('StudentEnrollmentInfo', array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));

}

$eninfo=$model->EnrollmentInfoLast;
?>

<div class="tab-pane" id="present_enrollment_info">


<?php $this->widget('bootstrap.widgets.BootGridView',array(
	'id'=>'student-enrollment-info-grid',
	'dataProvider'=>$eninfo2,
    'template'=>"{items}",

	'columns'=>array(
	'id',
		'student_id'=>array('name'=>'student_id','value'=>'Bndate::t($data->student_id)'),
		'student_pk'=>array('name'=>'student_pk','value'=>'$data->student->student_name'),
			'session'=>array('name'=>'session','value'=>'Bndate::t($data->session)'),
		'course_id'=>array('name'=>'course_id','value'=>'$data->course->course_name'),
		'department_id'=>array('name'=>'department_id','value'=>'$data->department->department_name'),
		'batch_id'=>array('name'=>'batch_id','value'=>'$data->batch->batch_id'),
		'batch_group'=>array('type'=>'raw','name'=>'batch_group','value'=>'$data->batchgroup->group_name." (". $data->batchgroup->id .")"'),
		
		'semester'=>array('name'=>'semester','value'=>'CourseSemesterLebel::model()->semesterLebel($data->course_id,$data->semester,1)'),
		array('header'=>'Result','type'=>'raw','value'=>'$data->studentres?$data->studentres->result:"-"'),
		
	),
)); ?>
			
</div>
<?php
if($eninfo)
{
?>
<div class="span5">
                        <div class="well">
                        <h4>সেশান এর পুরো বকেয়া</h4>
                        <?php 
						$tdues=$eninfo->totaldues($eninfo,$model);
						echo Bndate::t($tdues);
						//$this->renderPartial('viewCollectionDuesFullGrid', array('model'=>$model,'eninfo'=>$eninfo));?>
                        </div>
                     </div>
					 
					

<div style="clear:both;"></div>
<?php } echo $this->renderPartial('_rqform', array('model'=>$model,'eninfo'=>$eninfo,'tdues'=>$tdues)); 

}
?>