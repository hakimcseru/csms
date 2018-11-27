<?php

class CalendarInfoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
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
	 /*
	public function accessRules()
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
	}*/
	
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=CalendarInfo::model()->findByPk($id);
		$model3=new ClassRoutine('search');
		$model3->unsetAttributes();  
		if(isset($_GET['ClassRoutine']))
			$model3->attributes=$_GET['ClassRoutine'];
			
		$this->render('view',array(
			'model'=>$model,'model3'=>$model3,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CalendarInfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CalendarInfo']))
		{
			$model->attributes=$_POST['CalendarInfo'];
			//echo $_POST['CalendarInfo']['copyfrom']; die();
			if($model->save())
			{
				
				if(isset($_POST['CalendarInfo']['copyfrom']))
				{
				$class_routine=ClassRoutine::model()->findAll("calendar_id=".$_POST['CalendarInfo']['copyfrom']);
				
				
				
				if($class_routine)
				{
				
					foreach($class_routine as $routine):
					
					$nee= new ClassRoutine; 
					
					$nee->session_id=$model->session_id;
					$nee->faculty_member_id=$routine->faculty_member_id;
					$nee->batch_section_id=$routine->batch_section_id;
					$nee->room_id=$routine->room_id;
					$nee->class_period_id=$routine->class_period_id;
					$nee->additional_faculty_member_id=$routine->additional_faculty_member_id;
					$nee->course_id=$routine->course_id;
					$nee->department_id=$routine->department_id;
					$nee->batch_id=$routine->batch_id;
					$nee->batch_group_id=$routine->batch_group_id;
					$nee->weekday=$routine->weekday;
					$nee->calendar_id=$model->id;
					$nee->semester_id=$routine->semester_id;
					$nee->subject_id=$routine->subject_id;
					$nee->save();
					//echo $model->session_id." ".$model->id; die();
					endforeach;
				}
				}
				
				$this->redirect(array('admin'));
				
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CalendarInfo']))
		{
			$model->attributes=$_POST['CalendarInfo'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CalendarInfo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CalendarInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CalendarInfo']))
			$model->attributes=$_GET['CalendarInfo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionDay()
	{
		$model=new CalendarInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CalendarInfo']))
			$model->attributes=$_GET['CalendarInfo'];

		$this->render('day',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	  public function actionExport()
	{
		
                
        $model=new CalendarInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CalendarInfo']))
			$model->attributes=$_GET['CalendarInfo'];
                 
		$this->widget('application.extensions.EExcelView', array(
                'dataProvider'=> $model->search(),
                'grid_mode'=>'export',
				'columns'=>array(
				'id',
				'calendar_name',
				'start_date',
				'end_date',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),
	
			 'exportType'=>'Excel5',
			 'filename'=>'Calendar_info',
                ));
                
                
	}
	public function loadModel($id)
	{
		$model=CalendarInfo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='calendar-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
