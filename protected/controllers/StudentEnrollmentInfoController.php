<?php

class StudentEnrollmentInfoController extends Controller
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
				'actions'=>array('create','update','Course','Cemester','DisCoor','Group','Export','Cemester2'),
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
	 
	 public function actionTebulation($id)
	{
	
	$this->layout='//layouts/print';
		$model=$this->loadModel($id);

		
		$this->render('tebulation',array(
			'model'=>$model,
		));
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
		$model=new StudentEnrollmentInfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StudentEnrollmentInfo']))
		{
			$model->attributes=$_POST['StudentEnrollmentInfo'];
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

		if(isset($_POST['StudentEnrollmentInfo']))
		{
			$model->attributes=$_POST['StudentEnrollmentInfo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionMarksheet($id)
	{
		$model=$this->loadModel($id);

		
		$this->render('marksheet',array(
			'model'=>$model,
		));
	}

        
        public function actionDisCoor() {
				$model = Batch::model()->findAll("batch_ref_course_pk=".$_POST['StudentEnrollmentInfo']['course_id']);
                 $data=CHtml::listData($model,'batch_pk','batch_id');
				
				echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
							   
				foreach($data as $value=>$name)
				{
					echo CHtml::tag('option',
							   array('value'=>$value),CHtml::encode($name),true);
				}
  }
	
	
	
	public function actionCemester() {
	
				//echo $_POST['CourseSemesterLebel']['course_id'];
				
				$model = Course::model()->findByPk($_POST['StudentEnrollmentInfo']['course_id']);
				
                 //$data=CHtml::listData($model,'batch_pk','batch_id');
				if($model->semester)
				{
				
				for($i=0;$i<=$model->semester;$i++)
				{
				if($i==0)
				echo CHtml::tag('option',
							   array('value'=>''),'Pleae Select',true);
				else
				{
				
					$clebel=CourseSemesterLebel::model()->find("course_id=".$_POST['StudentEnrollmentInfo']['course_id']." and semester_id=".$i);
					echo CHtml::tag('option',
							   array('value'=>$i),$clebel->lebel,true);
				}
				}
				}
				
  }
  
  public function actionCemester2() {
	
				//echo $_POST['CourseSemesterLebel']['course_id'];
				$batch_group=$_POST['batch_group'];
                                $course=$_POST['course'];
                                $semester=$_POST['semester'];
                                
				$model = Course::model()->findByPk($course);
				
                 //$data=CHtml::listData($model,'batch_pk','batch_id');
				if($model->semester)
				{
				
				for($i=0;$i<=$model->semester;$i++)
				{
				if($i==0)
				echo CHtml::tag('option',
							   array('value'=>''),'Pleae Select',true);
				else
				{
				
					$clebel=CourseSemesterLebel::model()->find("course_id=".$course." and semester_id=".$i);
                                        
                                        if($i==$semester)
					echo CHtml::tag('option',
							   array('value'=>$i,'selected'=>true),$clebel->lebel,true);
                                        else
                                            echo CHtml::tag('option',
							   array('value'=>$i),$clebel->lebel,true);
				}
				}
				}
				
  }
	
	public function actionCourse() {
				$model = CourseDepartment::model()->findAll("course_id=".$_POST['StudentEnrollmentInfo']['course_id']);
                 //$data=CHtml::listData($model,'course_pk','course_name');
				 
				 //echo $_POST['Student']['batch_ref_course_pk'].count($model); 
				 echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
				foreach($model as $mod)
				{
					
					echo CHtml::tag('option',
							   array('value'=>$mod->department->id),CHtml::encode($mod->department->department_name),true);
				}
  }
  
  public function actionGroup() {
				$model = BatchGroup::model()->findAll("batch_id=".$_POST['StudentEnrollmentInfo']['batch_id']);
                 //$data=CHtml::listData($model,'course_pk','course_name');
				 
				 //echo $_POST['Student']['batch_ref_course_pk'].count($model); 
				 echo CHtml::tag('option',
							   array('value'=>''),'Select',true);
				foreach($model as $mod)
				{
					
					echo CHtml::tag('option',
							   array('value'=>$mod->id),CHtml::encode($mod->group_name),true);
				}
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
			//$this->loadModel($id)->delete();
			$model=$this->loadModel($id);
			if($model->delete())
			{
			//$model2=Student::model()->findByPk($model->student_pk);
			//if(isset($model2))
			//$model2->delete();
			}
			
			
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
		$dataProvider=new CActiveDataProvider('StudentEnrollmentInfo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


 public function actionExportCommunication()
	{
		
         $model=new StudentEnrollmentInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentEnrollmentInfo']))
			$model->attributes=$_GET['StudentEnrollmentInfo'];

		    
			 
			    
        
			
                 
		$this->widget('application.extensions.EExcelView', array(
                'dataProvider'=> $model->search(),
                'grid_mode'=>'export',
				'columns'=>array(
array('name'=>'student_id','value'=>'Bndate::t($data->student_id)'),
		array('header'=>'Name','value'=>'$data->student->student_name'),
		array('header'=>'Email','value'=>'$data->student->student_email'),
		array('header'=>'Contact','value'=>'$data->student->student_contact'),
		
		array('header'=>'Present Address','value'=>'$data->student->student_present_address'),
		array('header'=>'Permanent Address','value'=>'$data->student->student_permanent_address'),
		array('header'=>'Blood Group','value'=>'$data->student->student_blood_group'),
		
		array('header'=>'Roll','value'=>'Bndate::t($data->roll_no)'),
		
		array(
			'class'=>'CButtonColumn',
		),
	),
	

                'exportType'=>'Excel5',
                'filename'=>'Student',
                ));
                
                
	}


public function actionCommunication()
	{$model=new StudentEnrollmentInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentEnrollmentInfo']))
			$model->attributes=$_GET['StudentEnrollmentInfo'];

		$this->render('communication',array(
			'model'=>$model,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new StudentEnrollmentInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentEnrollmentInfo']))
			$model->attributes=$_GET['StudentEnrollmentInfo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

  public function actionExport()
	{
		
                
        $model=new StudentEnrollmentInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentEnrollmentInfo']))
			$model->attributes=$_GET['StudentEnrollmentInfo'];
                
                
                

		$this->widget('application.extensions.EExcelView', array(
                'dataProvider'=> $model->search(),
                'grid_mode'=>'export',
				'columns' => array(
									'student_id'=>array('name'=>'student_id','value'=>'Bndate::t($data->student_id)'),
		'student_pk'=>array('name'=>'student_pk','value'=>'$data->student->student_name'),
			'session'=>array('name'=>'session','value'=>'Bndate::t($data->session)'),
		'course_id'=>array('name'=>'course_id','value'=>'$data->course->course_name'),
		'department_id'=>array('name'=>'department_id','value'=>'$data->department->department_name'),
		'batch_id'=>array('name'=>'batch_id','value'=>'$data->batch->batch_id'),
		'batch_group'=>array('name'=>'batch_group','value'=>'$data->batchgroup->group_name'),
		
		'semester'=>array('name'=>'semester','value'=>'CourseSemesterLebel::model()->semesterLebel($data->course_id,$data->semester)'),

		'roll_no'=>array('name'=>'roll_no','value'=>'Bndate::t($data->roll_no)'),
								),

                'exportType'=>'Excel5',
                'filename'=>'Student_enrollment_information',
                ));
                
                
	}
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=StudentEnrollmentInfo::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-enrollment-info-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
