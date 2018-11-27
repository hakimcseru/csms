<?php

class StudentFineController extends Controller
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 
	  public function actionExport()
	{
		
                
        $model=new StudentFine('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentFine']))
			$model->attributes=$_GET['StudentFine'];
                 
		$this->widget('application.extensions.EExcelView', array(
                'dataProvider'=> $model->search(),
                'grid_mode'=>'export',
			'columns'=>array(
		array('name'=>'student_id','value'=>'Bndate::BanglaNumDate($data->student_id)'),
		array('name'=>'student_id','value'=>'$data->students->student_name'),
		array('name'=>'month','value'=>'Bndate::BanglaNumMonth($data->month)',),
array('header'=>'Course','value'=>'$data->studentsenrollment?$data->studentsenrollment->course->course_name:""',),
		
		
		array('header'=>'Departmet','value'=>'$data->studentsenrollment?$data->studentsenrollment->department->department_name:""',),
		
		array('header'=>'Batch','value'=>'$data->studentsenrollment?$data->studentsenrollment->batch->batch_id:""',),
		

array('header'=>'Batch Group','value'=>'$data->studentsenrollment?$data->studentsenrollment->batchgroup->group_name:""'),
		
		array('header'=>'Semester','value'=>'$data->studentsenrollment?$data->studentsenrollment->semesterLevel->lebel:""',),
		
		array('header'=>'Roll','value'=>'$data->studentsenrollment?Bndate::BanglaNumDate($data->studentsenrollment->roll_no):""'),
		
		//array('header'=>'','value'=>'$data->students->student_name','filter'=>false),
		
		//'collection_id',
	
		array('name'=>'amount','value'=>'Bndate::BanglaNumDate($data->amount)'),
		'comment',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
			'template'=>'{view}',
		),
	),
	
			 'exportType'=>'Excel5',
			 'filename'=>'Student Fine Reports',
                ));
                
                
	}
	 
	public function actionCreate()
	{
		$model=new StudentFine;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StudentFine']))
		{
			$model->attributes=$_POST['StudentFine'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['StudentFine']))
		{
			$model->attributes=$_POST['StudentFine'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('StudentFine');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new StudentFine('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentFine']))
			$model->attributes=$_GET['StudentFine'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=StudentFine::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-fine-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
