<?php

class CourseSemesterLebelController extends Controller
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
				'actions'=>array('index','view','Cemester','Lebel'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','Cemester'),
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
	public function actionCreate()
	{
		$model=new CourseSemesterLebel;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CourseSemesterLebel']))
		{
			$model=CourseSemesterLebel::model()->find("course_id=".$_POST['CourseSemesterLebel']['course_id']." and semester_id=".$_POST['CourseSemesterLebel']['semester_id']);
			if(!$model)	$model=new CourseSemesterLebel;
			
			$model->attributes=$_POST['CourseSemesterLebel'];
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

		if(isset($_POST['CourseSemesterLebel']))
		{
			$model->attributes=$_POST['CourseSemesterLebel'];
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
		$dataProvider=new CActiveDataProvider('CourseSemesterLebel');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	
	public function actionLebel() {
	
				$model = CourseSemesterLebel::model()->find("semester_id=".$_POST['CourseSemesterLebel']['semester_id']." and course_id=".$_POST['CourseSemesterLebel']['course_id']);
				
				
				$value="";
				
				if(isset($model->lebel)) $value=$model->lebel;
				
				echo '<label class="required" for="CourseSemesterLebel_lebel">Lebel <span class="required">*</span></label>';
				
                 //$data=CHtml::listData($model,'batch_pk','batch_id');
				
			
				
				echo CHtml::tag('input', array( 'type'=>'text', 'class'=>'span5' , 'value' => $value, 'name'=>'CourseSemesterLebel[lebel]', 'id'=>'CourseSemesterLebel_lebel'));

				
				//echo $_POST['CourseSemesterLebel']['course_id'];
				
				//$model = Course::model()->findByPk($_POST['CourseSemesterLebel']['course_id']);
                 //$data=CHtml::listData($model,'batch_pk','batch_id');
				/*if($model->semester)
				{
				
				for($i=1;$i<=$model->semester;$i++)
				{
					echo CHtml::tag('option',
							   array('value'=>$i),$i,true);
				}
				}*/
				
  }
	
	
	public function actionCemester() {
	
				//echo $_POST['CourseSemesterLebel']['course_id'];
				
				$model = Course::model()->findByPk($_POST['CourseSemesterLebel']['course_id']);
                 //$data=CHtml::listData($model,'batch_pk','batch_id');
				if($model->semester)
				{
				
				for($i=0;$i<=$model->semester;$i++)
				{
				if($i==0)
				echo CHtml::tag('option',
							   array('value'=>''),'Pleae Select',true);
				else
					echo CHtml::tag('option',
							   array('value'=>$i),$i,true);
				}
				}
				
  }
  
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CourseSemesterLebel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CourseSemesterLebel']))
			$model->attributes=$_GET['CourseSemesterLebel'];

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
		
                
        $model=new CourseSemesterLebel('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CourseSemesterLebel']))
			$model->attributes=$_GET['CourseSemesterLebel'];
                 
		$this->widget('application.extensions.EExcelView', array(
                'dataProvider'=> $model->search(),
                'grid_mode'=>'export',
				'columns'=>array(

							array(
							'name'=>'course_id',
							'value'=>'Course::model()->findByPk($data->course_id)->course_name',
							'filter'=>CHtml::listData(Course::model()->findAll(array('order'=>'course_pk')),'course_pk','course_name'),
							),
					
					
							array(
							'name'=>'semester_id',
							'value'=>'Bndate::t($data->semester_id)',
							'filter'=>  CHtml::listData(CourseSemesterLebel::model()->findAll(array('order'=>'semester_id')), 'semester_id','semester_id'),
					
							),
					
							'lebel',
							array(
								'class'=>'bootstrap.widgets.BootButtonColumn',
							),
						),
			 'exportType'=>'Excel5',
			 'filename'=>'Course_semester_level',
                ));
                
                
	}
	public function loadModel($id)
	{
		$model=CourseSemesterLebel::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='course-semester-lebel-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
