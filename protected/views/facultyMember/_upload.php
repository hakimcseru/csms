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
<?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
array(
        'id'=>'uploadFile',
        'config'=>array(
               'action'=>Yii::app()->createUrl('facultyMember/upload',array('id'=>  $id)),
               'allowedExtensions'=>array("jpg"), //array("jpg","jpeg","gif","exe","mov" and etc...
               'sizeLimit'=>10*1024*1024, // maximum file size in bytes
               'minSizeLimit'=>1*100*100,// minimum file size in bytes
               'onComplete'=>"js:function(id, fileName, responseJSON){
        		loadImage(fileName);

				}",
               //'messages'=>array(
               //                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
               //                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
               //                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
               //                  'emptyError'=>"{file} is empty, please select files again without it.",
               //                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
               //                 ),
               //'showMessage'=>"js:function(message){ alert(message); }"
              )
)); ?>
<script>
function loadImage(fileName)
{

	$("#photo").html('<img src="<?php echo Yii::app()->request->getBaseUrl(TRUE)?>/images/faculty/'+fileName+'" width="100" height="100" />');
}
</script>