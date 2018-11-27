<?php
class registerScript extends CWidget {

	public $assets = '';
	public $language;

	public function init() {
		$this->assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');

		Yii::app()->clientScript
		->registerCoreScript( 'jquery' )
		->registerCoreScript( 'jquery.ui' )

		->registerScriptFile( $this->assets.'/js/jquery.ui.timepicker.js' )

		->registerCssFile( $this->assets.'/css/ui.theme.smoothness/jquery-ui-1.7.3.css' )
		->registerCssFile( $this->assets.'/css/timepicker.css' );

		//language support
		if (empty($this->language))
			$this->language = Yii::app()->language;

		if(!empty($this->language)){
			$path = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
			$langFile = '/js/jquery.ui.timepicker.'.$this->language.'.js';

			if (is_file($path.DIRECTORY_SEPARATOR.$langFile))
				Yii::app()->clientScript->registerScriptFile($this->assets.$langFile);
		}

		parent::init();
	}

	public function run(){
		$this->render('registerScript');
	}
}
?>