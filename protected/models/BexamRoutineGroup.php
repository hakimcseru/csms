<?php

/**
 * This is the model class for table "bexam_routine_group".
 *
 * The followings are the available columns in table 'bexam_routine_group':
 * @property integer $id
 * @property integer $batch_group_id
 * @property string $group_name
 * @property integer $start_role
 * @property integer $end_role
 * @property integer $session_id
 * @property integer $course_id
 * @property integer $department_id
 * @property integer $batch_id
 */
class BexamRoutineGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BexamRoutineGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bexam_routine_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_group_id, group_name, start_role, end_role, session_id, course_id, department_id, batch_id', 'required'),
			array('batch_group_id, semester, start_role, end_role, session_id, course_id, department_id, batch_id', 'numerical', 'integerOnly'=>true),
			array('group_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, batch_group_id, group_name, start_role, end_role, session_id, course_id, department_id, batch_id', 'safe', 'on'=>'search'),
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
		 'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
		 'batch' => array(self::BELONGS_TO, 'BatchGroup', 'batch_group_id'),
		 'batch_group' => array(self::BELONGS_TO, 'BatchGroup', 'batch_group_id'),
		'semesterLevel' => array(self::HAS_ONE, 'CourseSemesterLebel', array('semester_id' => 'semester','course_id'=>'course_id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'batch_group_id' => Yii::t('core','Batch Group'),
			'group_name' =>  Yii::t('core','Group Name'),
			'group_id' =>  Yii::t('core','Group'),
			'start_role' => 'Start Role',
			'end_role' => 'End Role',
			'session_id' => Yii::t('core','Session'),
			'semester' => Yii::t('core','Semester'),
			'department_id' => Yii::t('core','Department'),
			'batch_id' => Yii::t('core','Batch'),
			'course_id' => Yii::t('core','Course'),
			
		);
	}

	public $group_name,$department_id,$course_id,$group_id;
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		
		
		$criteria->together = true;
		$criteria->with=array('semesterLevel','batch_group','department','course'); 
		$criteria->compare('course.course_name',$this->course_id,true);
		//'course','student','batch','department','batchgroup',
		$criteria->compare('semesterLevel.lebel',$this->semester,false);
		
		$criteria->compare('batch_group.group_name',$this->batch_group_id,true);
		
		$criteria->compare('department.department_name',$this->department_id,true);
		
		$criteria->compare('id',$this->id);
		//$criteria->compare('batch_group_id',$this->batch_group_id);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('start_role',$this->start_role);
		$criteria->compare('end_role',$this->end_role);
		$criteria->compare('session_id',$this->session_id);
		//$criteria->compare('course_id',$this->course_id);
		//$criteria->compare('department_id',$this->department_id);
		$criteria->compare('batch_id',$this->batch_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'pagination'=>array(
                'pageSize'=>100,
            ),

		));
	}
}