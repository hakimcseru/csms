
<h1><?php echo Yii::t('core','Course Wise Deposit Reports')?></h1>


<?php
if(isset($result))
{
 ?>
<table class="items table" width="100%" border="1">
<tr>
<th><?php echo Yii::t('core','SN');?></th>
<th><?php echo Yii::t('core','Session');?></th>
<th><?php echo Yii::t('core','Course');?></th>
<th>পূবালী ব্যাংক লিমিটেড </th>
<th>যমুনা ব্যাংক লিমিটেড </th>
<th><?php echo Yii::t('core','Total');?></th>
</tr>
<?php
$i=1;
$total_pub=0;
$total_jam=0;
$total=0;
foreach($result as $res):

 ?>
<tr>
<td><?php echo Bndate::t($i++); ?></td>
<td><?php echo $res['session_id']; ?></td>
<td><?php echo $res['course_id']?Course::model()->findByPk($res['course_id'])->course_name:"Null"; ?></td>
<td><?php $pubali_bank=StudentCollectionDetail::model()->getTotalCoursewise($res['course_id'],1,$res['session_id'],$_POST['DateRangeForm']['start_date'],$_POST['DateRangeForm']['end_date']); 
$total_pub=$total_pub+$pubali_bank;
echo $pubali_bank;
?></td>
<td><?php $jamuna_bank=StudentCollectionDetail::model()->getTotalCoursewise($res['course_id'],2,$res['session_id'],$_POST['DateRangeForm']['start_date'],$_POST['DateRangeForm']['end_date']); 
$total_jam=$total_jam+$jamuna_bank;
echo $jamuna_bank;?></td>
<td><?php 
$total=$total+$jamuna_bank+$pubali_bank;
echo ($jamuna_bank+$pubali_bank); ?></td>
</tr>
<?php
endforeach;
 ?>
 
 <tr>
<th></th>
<th></th>
<th></th>
<th><?php echo $total_pub;?></th>
<th><?php echo $total_jam;?></th>
<th><?php echo $total;?></th>
</tr>
</table>
<?php }?>
