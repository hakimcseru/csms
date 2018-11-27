<script>
$(function () {
       $('#select-all').click(function (event) {

           var selected = this.checked;
           // Iterate each checkbox
           $(':checkbox').each(function () {    this.checked = selected; });

       });
    });
</script>
<form action="<?php echo Yii::app()->createUrl('facultyMember/index');?>" method="POST">
<input type="checkbox" name="select-all" id="select-all" />
<table class="table">
<tr>
<th></th>
<th><strong>পরিচিতি</strong></th>

<th>নাম</th>
<th>পদবী</th>



</tr>

<?php foreach($dataProvider as $th):?>
<tr>
<td>
<input type="checkbox" value="<?php echo $th->member_pk;?>" name="tlist[]" />
</td>
<td><?php echo $th->member_id;?></td>
<td><?php echo $th->member_name;?></td>
<td><?php echo $th->designation;?></td>


</tr>
<?php endforeach;
?>
</table>

<input class="btn btn-primary" name="yt2" type="submit" value="<?php echo Yii::t('core','Print');?>">
</form>

