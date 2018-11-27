<?php
/**
 * Image ajax upload form.
 * 
 * @package Image
 * @subpackage View 
 * @author Ali Hasan Imam <mail@alihasan.info>
 * @copyright Drik ICT Ltd. <{@link http://www.drikict.net}>
 * @see Image
 * @see ImageController
 * @since v1.1
 */
?>




<?php /* @var artistID String */ ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->getBaseUrl(TRUE).'/css/fileuploader.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->getBaseUrl(TRUE).'/js/fileuploader.js'); ?>




<div id="file-uploader">
	<noscript>
		<tr><td>Please enable JavaScript to use file uploader.</td></tr>
		<!-- or put a simple form for upload here -->
	</noscript>
</div>
<script type="text/javascript">
function createUploader(){
	var uploader = new qq.FileUploader({
		element: document.getElementById('file-uploader'),
		multiple: false,
		action: '<?= $this->createUrl('courseMaterial/upload')?>',
		allowedExtensions: ['jpg', 'jpeg', 'tif'],
		debug: true,
		onComplete: function(id, fileName, responseJSON){
			//alert("image uploaded with name= "+fileName);
			$('#Resources_filelocation').val(fileName);
		}
	})
}
window.onload = function(){
	createUploader();
	//initImage();
	//loadOnScrollEnd();
}
</script>