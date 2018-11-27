<?php

class BatchController extends Controller
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
				'actions'=>array('index','view','Group'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','addStudent'),
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
		$model=new Batch;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Batch']))
		{
			
		
			$model->attributes=$_POST['Batch'];
			if($model->save())
			{
			
			if(isset($_POST['group']))
			{
			foreach($_POST['group'] as $gp):
			
			$model2=new BatchGroup;
			$model2->group_name=$gp;
			$model2->batch_id=$model->batch_pk;
			$model2->save();
			endforeach;
			}
			$this->redirect(array('view','id'=>$model->batch_pk));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/*
	public function actionGroup() {
	
	
	echo '
	
	
	<label class="required" for="Course_course_name">Group Name <span class="required">*</span></label>
	<input type="text" id="Course_course_name" name="group[]" value="" maxlength="128" class="span5">
	
	
	';
	
  }
	*/
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model->scenario = 'update';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Batch']))
		{
			$model->attributes=$_POST['Batch'];
			if($model->save())
			
			{
			if(isset($_POST['group']))
			{
			foreach($_POST['group'] as $gp):
			
			$model2=new BatchGroup;
			$model2->group_name=$gp;
			$model2->batch_id=$model->batch_pk;
			$model2->save();
			endforeach;
			}

			$this->redirect(array('view','id'=>$model->batch_pk));
			
			
			
			
			}
		}
		
		$model2=BatchGroup::model()->findAll("batch_id=".$id);
		
		$this->render('update',array(
			'model'=>$model,'group'=>$model2,
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
		$dataProvider=new CActiveDataProvider('Batch');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Batch('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Batch']))
			$model->attributes=$_GET['Batch'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


 public function actionExport()
	{
		
                
        $model=new Batch('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Batch']))
			$model->attributes=$_GET['Batch'];
                 
		$this->widget('application.extensions.EExcelView', array(
                'dataProvider'=> $model->search(),
                'grid_mode'=>'export',
				'columns'=>array(
		//'batch_pk'=>array('name'=>'batch_pk','value'=>'Bndate::t($data->batch_pk)'),


		'batch_id'=>array('name'=>'batch_id','value'=>'Bndate::t($data->batch_id)', 'filter'=>CHtml::listData(Batch::model()->findAll(array('order'=>'batch_id')),'batch_id','batch_id'),),
		'batch_start_date'=>array('name'=>'batch_start_date','value'=>'Bndate::t($data->batch_start_date)'),
		'batch_end_date'=>array('name'=>'batch_end_date','value'=>'Bndate::t($data->batch_end_date)'),

		'batch_status'=>array('name'=>'batch_status','value'=>'Yii::t("core",$data->batch_status)', 'filter'=>CHtml::listData(Batch::model()->getBatchStatus(), 'id', 'title'),),

		'department_id'=>array('name'=>'department_id','value'=>'$data->department->department_name', 'filter'=>CHtml::listData(Department::model()->findAll(array('order'=>'id')),'id','department_name'),),
		'batch_ref_course_pk'=>array('name'=>'batch_ref_course_pk','value'=>'$data->course->course_name', 'filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_pk')),'course_pk','course_name'),),
		/*
		'batch_ref_course_name',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
	
			 'exportType'=>'Excel5',
			 'filename'=>'Batch',
                ));
                
                
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Batch::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='batch-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionAddStudent($id)
	{
		$model = $this->loadModel($id);
		if(isset ($_POST['Student']['student_pk']))
		{
			$student = Student::model()->findByPk($_POST['Student']['student_pk']);

			if(!empty ($student))
			{
				$student->student_ref_batch_pk = $id;
				$student->save(false);
				echo CJSON::encode(array(
					'status'=>'success',
					'div'=> 'Success Message',
				));
			}
		}
	}
}
