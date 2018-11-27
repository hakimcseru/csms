<?php

class AccountssummaryController extends Controller
{
	public $layout='//layouts/column2';
	
	
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	*/
	public function accessRules()

{

 if(Yii::app()->controller->module)

$module=Yii::app()->controller->module->id;

else $module="0";

$controller=Yii::app()->controller->id;

$action=Yii::app()->controller->action->id;

//echo $module."_".$controller."_".$action;

$accessrole_id=Yii::app()->user->accessrole_id;

//echo Yii::app()->user->name;//die();

$auh_access=AuthUserRoleAccess::model()->findByAttributes(array('role_id'=>$accessrole_id,'module'=>$module,'controller'=>$controller,'action'=>$action));

if($auh_access)

{
return array(

array('allow', // allow admin user to perform 'admin' and 'delete' actions

'actions'=>array($auh_access->action),

'users'=>array(Yii::app()->user->name),

),

array('deny',  // deny all users

'users'=>array("*"),

),

);

}
else{

return array(
array('deny',  // deny all users

'users'=>array('*'),

),

);

}

}
	
	
	public function actionIndex()
	{
		$model=new DateRangeForm;
		if(isset($_POST['DateRangeForm']))
		{
		$model->attributes=$_POST['DateRangeForm'];
		$model2=new StudentCollectionDetail;
		$model_result=$model2->getCollectionSummary($start_date=$model->start_date,$end_date=$model->end_date,$session=$model->session);
		
		if(isset($_POST['yt0']))
		$this->render('index',array("result"=>$model_result,"model"=>$model));
		elseif(isset($_POST['yt1']))
		$this->renderPartial('indexprint',array("result"=>$model_result,"model"=>$model));
		}
		else
		{
		$this->render('index',array("model"=>$model));
		}
		
		//print_r ($model_result);
		
		
	}
	public function actionDepositDatewise()
	{
		$model=new DateRangeForm;
		if(isset($_POST['DateRangeForm']))
		{
		$model->attributes=$_POST['DateRangeForm'];
		$model2=new StudentCollectionDetail;
		$model_result=$model2->getDepositDatewiseSummary($start_date=$model->start_date,$end_date=$model->end_date,$session=$model->session);
		if(isset($_POST['yt0']))
		$this->render('deposit_datewise',array("result"=>$model_result,"model"=>$model));
		elseif(isset($_POST['yt1']))
			$this->renderPartial('deposit_datewiseprint',array("result"=>$model_result,"model"=>$model));
		}
		else
		{
		$this->render('deposit_datewise',array("model"=>$model));
		}
		
		//print_r ($model_result);
		
		
	}
	
	public function actionSessionwise()
	{
		$model=new DateRangeForm;
		if(isset($_POST['DateRangeForm']))
		{
			$model->attributes=$_POST['DateRangeForm'];
			$model2=new StudentCollectionDetail;
			$model_result=$model2->getDepositSessionwise($start_date=$model->start_date,$end_date=$model->end_date,$session=$model->session);

			if(isset($_POST['yt0']))
			$this->render('sessionwise',array("result"=>$model_result,"model"=>$model));
			
			elseif(isset($_POST['yt1']))
			$this->renderPartial('sessionwiseprint',array("result"=>$model_result,"model"=>$model));
			
		}
		else
		{
		$this->render('sessionwise',array("model"=>$model));
		}
		
		//print_r ($model_result);
		
		
	}
	
	public function actionCollectionHeadWise()
	{
		$model=new DateRangeForm;
		if(isset($_POST['DateRangeForm']))
		{
			$model->attributes=$_POST['DateRangeForm'];
			$model2=new StudentCollection;
			$model_result=$model2->getCollectionHeadWise($start_date=$model->start_date,$end_date=$model->end_date,$session=$model->session);
			if(isset($_POST['yt0']))
			$this->render('collection_head_wise',array("result"=>$model_result,"model"=>$model));
			
			elseif(isset($_POST['yt1']))
			$this->renderPartial('collection_head_wiseprint',array("result"=>$model_result,"model"=>$model));
			
		}
		else
		{
		$this->render('collection_head_wise',array("model"=>$model));
		}
		
		}
		public function actionCoursewise()
		{
		$model=new DateRangeForm;
		if(isset($_POST['DateRangeForm']))
		{
			$model->attributes=$_POST['DateRangeForm'];
			$model2=new StudentCollectionDetail;
			$model_result=$model2->getDepositCoursewise($start_date=$model->start_date,$end_date=$model->end_date,$session=$model->session);
			if(isset($_POST['yt0']))
			$this->render('coursewise',array("result"=>$model_result,"model"=>$model));
			elseif(isset($_POST['yt1']))
			$this->renderPartial('coursewiseprint',array("result"=>$model_result,"model"=>$model));
		}
		else
		{
			$this->render('coursewise',array("model"=>$model));
		}
		//print_r ($model_result);
		
		
	}
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}