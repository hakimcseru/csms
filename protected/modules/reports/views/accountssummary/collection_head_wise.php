﻿<?php
$this->breadcrumbs=array(
	'Accountssummary',
);?>
<h1><?php echo Yii::t('core','Collection Head Wise Deposit Reports')?></h1>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'inlineForm',
    'type'=>'inline',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 <?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'DateRangeForm[start_date]',
				'value'=> $model->start_date,
				'options' => array(
					'dateFormat' => 'yy-mm-dd',
					//'altFormat' => 'yy-mm-dd', // show to user format
					'changeMonth' => true,
					'changeYear' => true,
					'showOn' => 'focus',
					'buttonImageOnly' => false,
				),
				'htmlOptions'=>array(
					'class'=>'input-small',
				),
			));
			?>
			<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'name' => 'DateRangeForm[end_date]',
				'value'=> $model->end_date,
				'options' => array(
					'dateFormat' => 'yy-mm-dd',
					//'altFormat' => 'yy-mm-dd', // show to user format
					'changeMonth' => true,
					'changeYear' => true,
					'showOn' => 'focus',
					'buttonImageOnly' => false,
				),
				'htmlOptions'=>array(
					'class'=>'input-small',
				),
			));
			?>
<?php echo $form->textFieldRow($model,'session',array('class'=>'input-small','maxlength'=>128)); ?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>Yii::t('core','Search'))); ?>
 <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>Yii::t('core','Print'))); ?>
<?php $this->endWidget(); ?>
<?php
if(isset($result))
{
 ?>
<table class="items table">
<tr>
<th>ক্রমিক নম্বর</th>
<th>সংগ্রহের খাত</th>
<th> পূবালী ব্যাংক লিমিটেড </th>
<th>যমুনা ব্যাংক লিমিটেড </th>
<th>মোট</th>
</tr>
<?php
$i=1;
$total_pub=0;
$total_jam=0;
$total=0;
//echo $_POST['DateRangeForm']['session']; die;
foreach($result as $res):

 ?>
<tr>
<td><?php echo $i++; ?></td>
<td><?php echo $res['comment']; ?></td>
<td><?php $pubali_bank=StudentCollection::model()->getTotalCollectionHeadWise($res['comment'],$_POST['DateRangeForm']['session'],1,$_POST['DateRangeForm']['start_date'],$_POST['DateRangeForm']['end_date']); 
$total_pub=$total_pub+$pubali_bank;
echo $pubali_bank;
?></td>
<td><?php $jamuna_bank=StudentCollection::model()->getTotalCollectionHeadWise($res['comment'],$_POST['DateRangeForm']['session'],2,$_POST['DateRangeForm']['start_date'],$_POST['DateRangeForm']['end_date']); 
$total_jam=$total_jam+$jamuna_bank;
echo $jamuna_bank;?></td>
<td><?php 
$total=$total+$jamuna_bank+$pubali_bank;
echo $jamuna_bank+$pubali_bank; ?></td>
</tr>
<?php
endforeach;
 ?>
 
 <tr>
<th></th>
<th></th>
<th><?php echo $total_pub;?></th>
<th><?php echo $total_jam;?></th>
<th><?php echo $total;?></th>
</tr>
</table>
<?php }?>
