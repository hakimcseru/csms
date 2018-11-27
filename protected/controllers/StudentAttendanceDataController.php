<?php

class StudentAttendanceDataController extends Controller
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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','view','attendancedate','attendancedatedetail'),
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
		$model=new StudentAttendanceData;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['StudentAttendanceData']))
		{
			$model->attributes=$_POST['StudentAttendanceData'];
			$cddd=Student::model()->find("student_id='".$model->student_reg_no."'");
			
			$model->student_id=$cddd->student_pk;
			$der=explode(" ",$model->time);
			$model->date=$der[0];
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

		if(isset($_POST['StudentAttendanceData']))
		{
			$model->attributes=$_POST['StudentAttendanceData'];
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
            $this->layout='//layouts/attendance';
            $model=new StudentAttendanceData;
		
		
                
        if(isset($_POST['StudentAttendanceData']))
		{
                        $student_reg_no=substr($_POST['StudentAttendanceData']['student_reg_no'], 1);
			//$model->attributes=$_POST['StudentAttendanceData'];
                        
                        $std=Student::model()->find("student_id='".$student_reg_no."'");
						$tec=FacultyMember::model()->find("member_id='".$student_reg_no."'");
						
                        if($std) 
                        {
                             
							 $model->student_id=$std->student_pk;
                             $model->student_reg_no=$student_reg_no;
                             $model->date=date("Y-m-d");
                             $model->time=date("Y-m-d H:i:s");
                             if($model->save())
                                    Yii::app()->user->setFlash('success', "<strong>শিক্ষার্থীঃ ".$std->student_name."(".Bndate::t($student_reg_no).')</strong> <img src="'.Yii::app()->request->getBaseUrl(TRUE).'/images/student/'.$std->student_image.'" /><br>'.Bndate::t($model->time) );
                             else 
                                 Yii::app()->user->setFlash('error', "<strong>".$student_reg_no."</strong> নিবন্ধন নাম্বারঃ নয়");
                        
                        }
						elseif($tec) 
                        {
                             
							 $model2=new FacultyMemberAttendanceData;
							 $model2->member_id=$tec->member_pk;
                             $model2->fm_reg_no=$student_reg_no;
                             $model2->date=date("Y-m-d");
							 $model2->weekday=date("l");
                             $model2->time=date("Y-m-d H:i:s");
                             if($model2->save())
                                    Yii::app()->user->setFlash('success', "<strong>শিক্ষকঃ ".$tec->member_name."(".Bndate::t($student_reg_no).')</strong> <img src="'.Yii::app()->request->getBaseUrl(TRUE).'/images/faculty/'.$tec->member_image.'" /><br>'.Bndate::t($model->time) );
                             else 
                                 Yii::app()->user->setFlash('error', "<strong>".$student_reg_no."</strong> নিবন্ধন নাম্বারঃ নয়");
                        
                        }
						

                       else 
                                 Yii::app()->user->setFlash('error', "<strong>".$student_reg_no."</strong> নিবন্ধন নাম্বারঃ নয়");
                        
                        
			
				
		}
                $model->unsetAttributes();
                $this->render('index',array(
			'model'=>$model,
		));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new StudentAttendanceData('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentAttendanceData']))
			$model->attributes=$_GET['StudentAttendanceData'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        public function actionAttendancedate()
	{
		$model=new StudentAttendanceData('searchAttendanceDatea');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentAttendanceData']))
			$model->attributes=$_GET['StudentAttendanceData'];

		$this->render('attendancedate',array(
			'model'=>$model,
		));
	}
        
        
        public function actionAttendancedatedetail($date)
	{
		$model=new StudentAttendanceData('searchdetail');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentAttendanceData']))
			$model->attributes=$_GET['StudentAttendanceData'];

		$this->render('attendancedetail',array(
			'model'=>$model,'date'=>$date,
		));
	}
	
	public function actionStudentattendance()
	{
		$model=new StudentResult('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentResult']))
			$model->attributes=$_GET['StudentResult'];

		$this->render('studentattendance',array(
			'model'=>$model,
		));
	}
	
	
	public function actionStudentattendanceinput()
	{
		$model=new ClassRoutine;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ClassRoutine']))
		{
			$model->attributes=$_POST['ClassRoutine'];
			
			$model->start_date=$_POST['ClassRoutine']['start_date']; 
			$model->end_date=$_POST['ClassRoutine']['end_date'];
			
			
			if(isset($_POST['yt1']))
			{
			$this->layout="print";
			$this->render('print',array(
			'model'=>$model,
		));}
			else{	$this->render('studentattendance',array(
			'model'=>$model,
		));}
		}
		else{
		$this->render('studentattendanceinput',array(
			'model'=>$model,
		));
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=StudentAttendanceData::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-attendance-data-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
