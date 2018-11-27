<?php $this->beginContent('//layouts/main'); ?>

<div class="span12 well main">
	<!-- <div class="row-fluid"> -->
		<?php
		if(isset($this->breadcrumbs))
		{
			$this->widget('bootstrap.widgets.BootBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				//'htmlOptions'=>array('class'=>'bredcrumbs'),
			));

		}
		?>
	<!-- </div> -->
	<?php echo $content ?>
</div>

<?php $this->endContent(); ?>