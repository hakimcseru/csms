<?php

/**
 * This is the model class for table "course_material".
 *
 * The followings are the available columns in table 'course_material':
 * @property integer $id
 * @property string $doc_title
 * @property string $doc_description
 * @property string $session_id
 * @property integer $course_id
 * @property integer $semester_id
 * @property integer $department_id
 * @property integer $subject_id
 * @property integer $group_id
 * @property string $file_location
 */
class CourseMaterial extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CourseMaterial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	 
	 protected $file_id;
	public function tableName()
	{
		return 'course_material';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doc_title, file_location', 'required'),
			array('course_id, semester_id,batch_id, department_id, subject_id, group_id', 'numerical', 'integerOnly'=>true),
			array('doc_title, file_location', 'length', 'max'=>250),
			array('doc_description, session_id', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, doc_title, doc_description, session_id,batch_id, course_id, semester_id, department_id, subject_id, group_id, file_location', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
			
			'batch' => array(self::BELONGS_TO, 'Batch', 'batch_id'),
		
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'batchgroup' => array(self::BELONGS_TO, 'BatchGroup', 'group_id'),
			//'semester' => array(self::BELONGS_TO, 'CourseSemesterLebel', 'semester_id'),
			'semesterLevel' => array(self::HAS_ONE, 'CourseSemesterLebel', array('semester_id' => 'semester_id','course_id'=>'course_id')),
			'subject' => array(self::BELONGS_TO, 'Subject', 'subject_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('core','ID'),
			'doc_title' => Yii::t('core','Doc Title'),
			'doc_description' => Yii::t('core','Doc Description'),
			'session_id' => Yii::t('core','Session'),
			'course_id' => Yii::t('core','Course'),
			'semester_id' => Yii::t('core','Semester'),
			'department_id' => Yii::t('core','Department'),
			'subject_id' => Yii::t('core','Subject'),
			'batch_id' => Yii::t('core','Batch'),
			'group_id' => Yii::t('core','Group'),
			'file_location' => Yii::t('core','File Location'),
		);
	}

	
		public function   beforeSave() {
		if(!$this->isNewRecord)
		{
			$old_image = CourseMaterial::model()->findByPk($this->id);
			
				
				$old_path = Yii::app()->basePath."/../files/".$old_image->file_location;
				$new_path = Yii::app()->basePath."/../files/".$this->file_location;
			//	if( ! (file_exists($new_path) && is_dir($new_path)))
				//{
					//mkdir($new_path,0777);
			//	}
				@copy($old_path, $new_path);
				@unlink($old_path);
				//remove temporary image from public directory
				//shell_exec('rm -r images/thumb/'.$old_image->file_path);
			
		}
		return parent::beforeSave();
	}
	
	public function  afterDelete() {
		//delete main image
		@unlink(Yii::app()->basePath."/../files/".$this->file_location);
		//delete all thumb image
	//	shell_exec('rm -r images/thumb/'.$this->file_path);

		return parent::afterDelete();
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('doc_title',$this->doc_title,true);
		$criteria->compare('doc_description',$this->doc_description,true);
		$criteria->compare('session_id',$this->session_id,true);
		$criteria->compare('course_id',$this->course_id);
		//$criteria->compare('semester_id',$this->semester_id,true);
		//$criteria->compare('semesterLevel.lebel',$this->semester_id,false);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('subject_id',$this->subject_id);
		$criteria->compare('batch_id',$this->batch_id);
		
		$criteria->compare('file_location',$this->file_location,true);
			$criteria->together = true;
		$criteria->with=array('semesterLevel','batchgroup');
		$criteria->compare('semesterLevel.lebel',$this->semester_id,false);
		$criteria->compare('batchgroup.group_name',$this->group_id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}