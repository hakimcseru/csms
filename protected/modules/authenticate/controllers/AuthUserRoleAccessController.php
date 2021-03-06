<?php

class AuthUserRoleAccessController extends Controller
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

public function accessRules()
	{
	if(Yii::app()->controller->module)
		$module=Yii::app()->controller->module->id;
	else $module="0";

	$controller=Yii::app()->controller->id;
	$action=Yii::app()->controller->action->id;

	if(isset(Yii::app()->user->accessrole_id))
	{
		$accessrole_id=Yii::app()->user->accessrole_id;
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
	else $this->redirect(Yii::app()->createUrl("/site/login"));
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
public function actionCreate()
{
$model=new AuthUserRoleAccess;

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

if(isset($_POST['AuthUserRoleAccess']))
{
$model->attributes=$_POST['AuthUserRoleAccess'];
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

if(isset($_POST['AuthUserRoleAccess']))
{
$model->attributes=$_POST['AuthUserRoleAccess'];
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
$dataProvider=new CActiveDataProvider('AuthUserRoleAccess');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new AuthUserRoleAccess('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['AuthUserRoleAccess']))
$model->attributes=$_GET['AuthUserRoleAccess'];

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
$model=AuthUserRoleAccess::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='auth-user-role-access-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
