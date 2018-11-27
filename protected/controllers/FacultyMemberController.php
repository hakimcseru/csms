<?php

class FacultyMemberController extends Controller
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
				'actions'=>array('admin','delete','Upload'),
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


	public function actionUpload($id)
	{



		Yii::import("ext.EAjaxUpload.qqFileUploader");

		//if($er) echo "Ase"; else "Nai";

		$folder=Yii::app()->basePath.'/../images/faculty/';// folder for uploaded files

		$allowedExtensions = array("jpg");//array("jpg","jpeg","gif","exe","mov" and etc...
		$sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($folder);
		$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

		$fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
		$fileName=$result['filename'];//GETTING FILE NAME

		if($fileName)
		{
		$model=$this->loadModel($id);

		if(isset($model->member_image) && file_exists($folder.$model->member_image)) unlink($folder.$model->member_image);

		$model->member_image=$fileName;

		$model->save();
		}
		echo $return;// it's array
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new FacultyMember;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FacultyMember']))
		{
			$model->attributes=$_POST['FacultyMember'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->member_pk));
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

		if(isset($_POST['FacultyMember']))
		{
			$model->attributes=$_POST['FacultyMember'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->member_pk));
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
		
		
		if(isset($_POST['yt2']))
		{
		
		
		$this->renderpartial('print',array(
			'tids'=>$_POST['tlist'],
		));
		}
		else
		{
		$dataProvider=FacultyMember::model()->findAll();
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		
		}
		
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FacultyMember('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacultyMember']))
			$model->attributes=$_GET['FacultyMember'];

		$this->render('admin',array(
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
		
                
        $model=new FacultyMember('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FacultyMember']))
			$model->attributes=$_GET['FacultyMember'];
                
                
                

		$this->widget('application.extensions.EExcelView', array(
                'dataProvider'=> $model->search(),
                'grid_mode'=>'export',
				'columns'=>array(
		'member_id'=>array('name'=>'member_id','value'=>'Bndate::t($data->member_id)'),
		'member_name',
                array('name'=>'member_image','value'=>'CHtml::image( $data->getStImage($data->member_image),"",array(\'width\'=>30, \'height\'=>45))','type'=>'raw'),
		'faculty_id'=>array('name'=>'faculty_id','value'=>'$data->faculty->faculty_name','filter'=>CHtml::listData(Faculty::model()->findAll(array('order'=>'faculty_name')),'id','faculty_name')),
		'department_id'=>array('name'=>'department_id','value'=>'$data->department->department_name','filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'department_name')),'id','department_name')),
		/*
		 * 'member_father_name',

		'member_mother_name',
		'member_present_address',
		'member_permanent_address',

		'member_nationality',
		'member_gender',
		'member_dob',
		'member_profession',
		'member_email',
		'member_contact',
		'member_blood_group',
		'member_qualification',
		'member_alternate_contact',
		'member_pk',
		'member_image',
		'faculty_id',
		*/
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
	),

                'exportType'=>'Excel5',
                'filename'=>'Faculty_member',
                ));
                
                
	}
        
	public function loadModel($id)
	{
		$model=FacultyMember::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='faculty-member-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
