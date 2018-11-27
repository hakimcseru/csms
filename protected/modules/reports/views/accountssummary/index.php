<?php
$this->breadcrumbs=array(
	'Accountssummary',
);?>
<h1><?php echo Yii::t('core','Bank Wise Deposit Account Reports')?></h1>


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

<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=> Yii::t('core','Search'))); ?>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>Yii::t('core','Print'))); ?>
 
<?php $this->endWidget(); ?>
<?php
if(isset($result))
{
 ?>
<table class="items table">
<tr>
<th><?php echo Yii::t('core','Sn');?></th>
<th><?php echo Yii::t('core','Bank');?></th>
<th><?php echo Yii::t('core','Amount');?></th>
</tr>
<?php
$i=1;
$tott=0;
foreach($result as $res):

 ?>
<tr>
<td><?php echo Bndate::t($i++); ?></td>
<td><?php echo BankInfo::model()->findByPk($res['bank_id'])->name;?> </td>
<td><?php $tott=$tott+$res['ca'];echo Bndate::t($res['ca']); ?></td>
</tr>
<?php
endforeach;
 ?>
 <tr>
<td></td>
<td></td>
<td><?php echo Bndate::t($tott); ?></td>
</tr>
</table>
<?php }?>
