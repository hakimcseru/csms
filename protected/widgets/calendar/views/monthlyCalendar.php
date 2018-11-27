<div id ="event-calendar"style ="width: 100%; overflow: hidden;">
<p class="pull-right">
	<< <?php echo CHtml::ajaxLink($months['pre_month_name'], '', array('replace'=>'#event-calendar','data'=>array('month'=>'js:preMonth'))); ?> |
	<?php echo $months['cur_month_name'];?> |
	<?php echo CHtml::ajaxLink($months['next_month_name'], '', array('replace'=>'#event-calendar','data'=>array('month'=>'js:nextMonth'))); ?> >>
</p><br /><br />
	<?php echo $calendar; ?>
</div>


<script type="text/javascript">
	preMonth = "<?php echo $months['pre_month_value']; ?>";
	curMonth = "<?php echo $months['cur_month_value']; ?>";
	nextMonth = "<?php echo $months['next_month_value']; ?>";
	function loadWithAjax(url)
	{
	<?php
	echo CHtml::ajax(array(
		'type'=>'GET',
		'url'=>"js:url.href", // ajax post will use 'url' specified above
		'success'=>"function(data)
		{
			msg = eval('(' + data + ')');
			$('#dialogEventView div.modal-body').html(msg.div);
			$('#dialogEventView').modal('show');
			//setTimeout(\"$('#dialogSubjectView').modal('hide') \",2000);

		} ",
	));
	?>
	}

	function updateWithAjax(url)
	{
		<?php
	echo CHtml::ajax(array(
		'type'=>'GET',
		'url'=>"js:url.href", // ajax post will use 'url' specified above
		'success'=>"function(data)
		{
			msg = eval('(' + data + ')');
			$('#dialogEventUpdate div.modal-body').html(msg.div);
			$('#dialogEventUpdate div.modal-body form').submit(updateCalendar);
			$('#dialogEventUpdate').modal('show');

		} ",
	));
	?>
	}

	function updateCalendar()
	{
		<?php echo CHtml::ajax(array(
			'url'=>array('calendar/update'),
			'data'=> "js:$(this).serialize()",
			'type'=>'post',
			'dataType'=>'json',
			'success'=>"function(data)
			{
				if (data.status == 'failure')
				{
					$('#dialogEventUpdate div.modal-body').html(data.div);
						  // Here is the trick: on submit-> once again this function!
					$('#dialogEventUpdate div.modal-body form').submit(updateCalendar);
				}
				else
				{
					$('#dialogEventUpdate div.modal-body').html(data.div);
					setTimeout(\"$('#dialogEventUpdate').modal('hide') \",2000);
					setTimeout('refreashCalendar(curMonth)',2000);
				}

			} ",
			))?>;
		return false;
	}

	function refreashCalendar(month)
	{
	<?php echo CHtml::ajax(array(
		'replace'=>'#event-calendar',
		'data'=>array('month'=>'js:month')
	)); ?>
	}
</script>
<?php $this->beginWidget('bootstrap.widgets.BootModal', array(
    'id'=>'dialogEventView',
    'htmlOptions'=>array('class'=>'hide'),
    'events'=>array(
        'show'=>"js:function() { console.log('modal show.'); }",
        'shown'=>"js:function() { console.log('modal shown.'); }",
        'hide'=>"js:function() { console.log('modal hide.'); }",
        'hidden'=>"js:function() { console.log('modal hidden.'); }",
    ),
)); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Event Details</h3>
</div>
<div class="modal-body"></div>
<div class="modal-footer">
    <?php echo CHtml::link('Close', '#', array('class'=>'btn btn-primary', 'data-dismiss'=>'modal')); ?>
</div>
<?php $this->endWidget();?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array(
    'id'=>'dialogEventUpdate',
    'htmlOptions'=>array('class'=>'hide'),
    'events'=>array(
        'show'=>"js:function() { console.log('modal show.'); }",
        'shown'=>"js:function() { console.log('modal shown.'); }",
        'hide'=>"js:function() { console.log('modal hide.'); }",
        'hidden'=>"js:function() { console.log('modal hidden.'); }",
    ),
)); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Update Calendar</h3>
</div>
<div class="modal-body"></div>
<div class="modal-footer">
    <?php echo CHtml::link('Close', '#', array('class'=>'btn btn-primary', 'data-dismiss'=>'modal')); ?>
</div>
<?php $this->endWidget();?>