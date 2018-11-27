
<h1><?php echo Yii::t('core','Bank Wise Deposit Account Reports')?></h1>


<?php
if(isset($result))
{
 ?>
<table class="items table" width="100%" border="1">
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
