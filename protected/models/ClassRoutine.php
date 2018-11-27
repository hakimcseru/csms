<?php

/**
 * This is the model class for table "class_routine".
 *
 * The followings are the available columns in table 'class_routine':
 * @property integer $id
 * @property integer $session_id
 * @property integer $faculty_member_id
 * @property integer $batch_section_id
 * @property integer $room_id
 * @property integer $class_period_id
 * @property integer $additional_faculty_member_id
 * @property integer $course_id
 * @property integer $department_id
 * @property integer $batch_id
 * @property integer $batch_group_id
 */
class ClassRoutine extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClassRoutine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public $start_date, $end_date,$range;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'class_routine';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session_id,semester_id, subject_id, faculty_member_id,weekday,calendar_id, batch_section_id, room_id, class_period_id, course_id, department_id, batch_id, batch_group_id', 'required'),
			array('session_id, faculty_member_id, batch_section_id, room_id, class_period_id, additional_faculty_member_id, course_id, department_id, batch_id, batch_group_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, session_id, faculty_member_id, batch_section_id, room_id, class_period_id, additional_faculty_member_id, course_id, department_id, batch_id, batch_group_id', 'safe', 'on'=>'search'),
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
			'subject' => array(self::BELONGS_TO, 'Subject', 'subject_id'),
			'batchgroup' => array(self::BELONGS_TO, 'BatchGroup', 'batch_group_id'),
			'sescion' => array(self::BELONGS_TO, 'BatchSection', 'batch_section_id'),
			'room' => array(self::BELONGS_TO, 'Room', 'room_id'),
			'classPeriod' => array(self::BELONGS_TO, 'ClassPeriod', 'class_period_id'),
			'facultyMember' => array(self::BELONGS_TO, 'FacultyMember', 'faculty_member_id'),
			'A_facultyMember' => array(self::BELONGS_TO, 'FacultyMember', 'additional_faculty_member_id'),
			'semesterLevel' => array(self::HAS_ONE, 'CourseSemesterLebel', array('semester_id' => 'semester_id','course_id'=>'course_id')),
			'calendar' => array(self::BELONGS_TO, 'CalendarInfo', 'calendar_id'),
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	 
	  public function getSemesterAll($course_id) {
  
				$course=Course::model()->findByPk($course_id);
				//echo $course->semester; die();
				if($course_id)
				{
				$semester=$course->allSemisterLebelsArray($course_id,$course->semester);
				
				return $semester;
				}
				else return 0;
  }
  
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('core', 'ID'),
			'session_id' => Yii::t('core','Session'),
			'faculty_member_id' =>Yii::t('core','Faculty Member'),
			'batch_section_id' =>Yii::t('core','Section'),
			'room_id' =>Yii::t('core','Rooms'),
			'class_period_id' =>Yii::t('core', 'Class Period'),
			'additional_faculty_member_id' =>Yii::t('core','Additional Faculty Member'),
			'course_id' =>Yii::t('core','Course'),
			'department_id' =>Yii::t('core','Department'),
			'batch_id' => Yii::t('core','Batch'),
			'batch_group_id' =>Yii::t('core', 'Batch Group'),
			'semester_id' =>Yii::t('core', 'Semester'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	/*public function search($nd="")
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->compare('id',$this->id);
		$criteria->compare('session_id',$this->session_id);
		$criteria->compare('faculty_member_id',$this->faculty_member_id);
		$criteria->compare('batch_section_id',$this->batch_section_id);
		$criteria->compare('room_id',$this->room_id);
		$criteria->compare('class_period_id',$this->class_period_id);
		$criteria->compare('additional_faculty_member_id',$this->additional_faculty_member_id);
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('batch_group_id',$this->batch_group_id);
		$criteria->compare('weekday',$this->weekday);
		//$criteria->compare('calendar_id',$this->calendar_id);
		
		$criteria->together = true;
		$criteria->with=array('semesterLevel');
		
		//if($nd) $criteria->condition='calendar_id='.$nd;
		if($nd) $criteria->compare('calendar_id',$nd);
		
		$criteria->compare('semesterLevel.lebel',$this->semester_id,false);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}*/
	
	public function search($nd="")
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->compare('id',$this->id);
		$criteria->compare('t.session_id',$this->session_id);
		$criteria->compare('t.faculty_member_id',$this->faculty_member_id);
		
		$criteria->compare('t.room_id',$this->room_id);
		
		$criteria->compare('t.additional_faculty_member_id',$this->additional_faculty_member_id);
		$criteria->compare('t.course_id',$this->course_id);
		$criteria->compare('t.department_id',$this->department_id);
		$criteria->compare('t.batch_id',$this->batch_id);
		
		$criteria->compare('t.weekday',$this->weekday);
		//$criteria->compare('calendar_id',$this->calendar_id);
		
		$criteria->together = true;
		$criteria->with=array('semesterLevel','batchgroup','sescion','subject','classPeriod');
		
		$criteria->compare('batchgroup.group_name',$this->batch_group_id);
		
		$criteria->compare('sescion.section_name',$this->batch_section_id);
		$criteria->compare('subject.subject_name',$this->subject_id);
		
		$criteria->compare('classPeriod.name',$this->class_period_id);
		
		//if($nd) $criteria->condition='calendar_id='.$nd;
		if($nd) $criteria->compare('t.calendar_id',$nd);
		
		$criteria->compare('semesterLevel.lebel',$this->semester_id,false);
		
		
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}