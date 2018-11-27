<?php

class ExportStudentIDCardController extends Controller
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
				'actions'=>array('index','view','Course','Cemester'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','qcreate','DisCoor','Group'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('manage','delete','qcreate','DisCoor','Upload'),
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
	
	public function actionDisCoor() {
				$model = Batch::model()->findAll("batch_ref_course_pk=".$_POST['Student']['batch_ref_course_pk']);
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
				
				$model = Course::model()->findByPk($_POST['Student']['batch_ref_course_pk']);
				
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
				
					$clebel=CourseSemesterLebel::model()->find("course_id=".$_POST['Student']['batch_ref_course_pk']." and semester_id=".$i);
					echo CHtml::tag('option',
							   array('value'=>$i),$clebel->lebel,true);
				}
				}
				}
				
  }
	
	public function actionCourse() {
				$model = CourseDepartment::model()->findAll("course_id=".$_POST['Student']['batch_ref_course_pk']);
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
				$model = BatchGroup::model()->findAll("batch_id=".$_POST['Student']['batch_ref']);
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Student;
		
	
               
    



		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Student']))
		{
			$where="";
			$course=$_POST['Student']['batch_ref_course_pk'];
			if($course) {if($where) $where .=" and course_id =".$course; else $where.=" course_id =".$course;}
			
			
			$department=$_POST['Student']['department_id'];
			if($department) {if($where) $where .=" and department_id =".$department; else $where.=" department_id =".$department;}
			
			$batch=$_POST['Student']['batch_ref'];
			if($batch) {if($where) $where .=" and batch_id =".$batch; else $where.=" batch_id =".$batch;}
			
			
			$batch_group=$_POST['Student']['batch_group'];
			if($batch_group) {if($where) $where .=" and batch_group =".$batch_group; else $where.=" batch_group =".$batch_group;}
			
			$semester=$_POST['Student']['semester'];
			if($semester) {if($where) $where .=" and semester =".$semester; else $where.=" semester =".$semester;}
			
			$session=$_POST['Student']['session'];
			if($session) {if($where) $where .=" and session =".$session; else $where.=" session =".$session;}
			
			//$card_type=$_POST['Student']['card_type'];
			
			
			//$studentEnInfo=StudentEnrollmentInfo::model()->findAll($where);
			
			//echo $where; die();
			
			$criteria=new CDbCriteria;
			/*$criteria->together = true;
			$criteria->with=array(
                                        'student' => array(
                                                'select' => 'student.student_name AS st_name,t.student_id',
                                                'together' => true,
                                                
                                        )
                                );
			*/
			//$criteria->select='t.student_id';
			
			$criteria->condition=$where;
			
			$criteria->order="roll_no ASC";
			
			
			$dataprovider=new CActiveDataProvider('StudentEnrollmentInfo', array(
			
			'criteria'=>$criteria,
		));
		
                $this->widget('application.extensions.EExcelView', array(
                'dataProvider'=> $dataprovider,
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
                'filename'=>'report',
                ));
			
			/*
			$this->layout='//layouts/'.$card_type;
			
			$this->renderPartial('_'.$card_type,array(
			'model'=>$studentEnInfo,
		));
		exit();*/
		/*
			$model->attributes=$_POST['Student'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->student_pk));
				*/
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

		if(isset($_POST['Student']))
		{
			$model->attributes=$_POST['Student'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->student_pk));
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
		$dataProvider=new CActiveDataProvider('Student');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Student('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Student']))
			$model->attributes=$_GET['Student'];

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
		$model=Student::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
