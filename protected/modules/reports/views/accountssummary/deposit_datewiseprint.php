
<h1><?php echo Yii::t('core','Date Wise Deposit Reports')?></h1>

<?php
if(isset($result))
{
 ?>
<table class="items table" width="100%" border="1">
<tr>
<th>ক্রমিক নম্বর</th>
<th>তারিখ</th>
<th> পূবালী ব্যাংক লিমিটেড </th>
<th>যমুনা ব্যাংক লিমিটেড </th>
<th>মোট</th>
</tr>
<?php
$i=1;
$total_pub=0;
$total_jam=0;
$total=0;
foreach($result as $res):

 ?>
<tr>
<td><?php echo $i++; ?></td>
<td><?php echo $res['deposite_date']; ?></td>
<td><?php $pubali_bank=StudentCollectionDetail::model()->getDaybankdeposit($res['deposite_date'],1,$res['session_id']); 
$total_pub=$total_pub+$pubali_bank;
echo $pubali_bank;
?></td>
<td><?php $jamuna_bank=StudentCollectionDetail::model()->getDaybankdeposit($res['deposite_date'],2,$res['session_id']); 
$total_jam=$total_jam+$jamuna_bank;
echo $jamuna_bank;?></td>
<td><?php 

$total=$total+$pubali_bank+$jamuna_bank;
echo ($pubali_bank+$jamuna_bank); ?></td>
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
