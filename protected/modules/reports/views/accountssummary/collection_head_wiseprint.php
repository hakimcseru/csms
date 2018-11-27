
<h1><?php echo Yii::t('core','Collection Head Wise Deposit Reports')?></h1>

<?php
if(isset($result))
{
 ?>
<table class="items table" width="100%" border="1">
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
