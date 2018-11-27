<?php

/**
 * This is the model class for table "exam_routine_detail".
 *
 * The followings are the available columns in table 'exam_routine_detail':
 * @property integer $id
 * @property integer $session_id
 * @property integer $faculty_member_id
 * @property integer $batch_section_id
 * @property integer $room_id
 * @property integer $exam_date_id
 * @property integer $additional_faculty_member_id
 * @property integer $course_id
 * @property integer $department_id
 * @property integer $batch_id
 * @property integer $batch_group_id
 * @property string $weekday
 * @property integer $exam_routine_id
 * @property integer $semester_id
 * @property integer $subject_id
 */
class ExamRoutineDetail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExamRoutineDetail the static model class
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
		return 'exam_routine_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session_id, faculty_member_id, batch_section_id, room_id, exam_date_id, course_id, department_id, batch_id, batch_group_id, exam_routine_id, semester_id, subject_id', 'required'),
			array('session_id, faculty_member_id, batch_section_id, room_id, exam_date_id, additional_faculty_member_id, course_id, department_id, additional_faculty_member_id2, additional_faculty_member_id3, additional_faculty_member_id4, additional_faculty_member_id5,  batch_id, batch_group_id, exam_routine_id, semester_id, subject_id', 'numerical', 'integerOnly'=>true),
			array('weekday', 'length', 'max'=>50),
			array('exam_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, session_id,exam_time, faculty_member_id, batch_section_id, room_id, exam_date_id, additional_faculty_member_id, course_id, department_id, batch_id, batch_group_id, weekday, exam_routine_id, semester_id, subject_id, additional_faculty_member_id2, additional_faculty_member_id3, additional_faculty_member_id4, additional_faculty_member_id5', 'safe', 'on'=>'search'),
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
			'batch_section' => array(self::BELONGS_TO, 'BexamRoutineGroup', 'batch_section_id'),
			'room' => array(self::BELONGS_TO, 'Room', 'room_id'),
			'classPeriod' => array(self::BELONGS_TO, 'ClassPeriod', 'class_period_id'),
			'facultyMember' => array(self::BELONGS_TO, 'FacultyMember', 'faculty_member_id'),
			'A_facultyMember' => array(self::BELONGS_TO, 'FacultyMember', 'additional_faculty_member_id'),
			'A_facultyMember2' => array(self::BELONGS_TO, 'FacultyMember', 'additional_faculty_member_id2'),
			'A_facultyMember3' => array(self::BELONGS_TO, 'FacultyMember', 'additional_faculty_member_id3'),
			'A_facultyMember4' => array(self::BELONGS_TO, 'FacultyMember', 'additional_faculty_member_id4'),
			'A_facultyMember5' => array(self::BELONGS_TO, 'FacultyMember', 'additional_faculty_member_id5'),
			//'A_facultyMember' => array(self::BELONGS_TO, 'FacultyMember', 'additional_faculty_member_id'),
			'semesterLevel' => array(self::HAS_ONE, 'CourseSemesterLebel', array('semester_id' => 'semester_id','course_id'=>'course_id')),
			'coursesubject' => array(self::HAS_ONE, 'CourseSubject', array('course_subject_ref_course_pk' => 'course_id','course_subject_ref_subject_pk'=>'subject_id','course_subject_department_id'=>'department_id')),
			'exam_routine' => array(self::BELONGS_TO, 'ExamRoutine', 'exam_routine_id'),
			'exam_date' => array(self::BELONGS_TO, 'ExamRoutineDate', 'exam_date_id'),
			'students'=>array(self::HAS_MANY, 'StudentEnrollmentInfo', array('session' => 'session_id','course_id'=>'course_id','department_id'=>'department_id','batch_id'=>'batch_id','batch_group'=>'batch_group_id','semester'=>'semester_id')),
			
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'session_id' => 'Session',
			'faculty_member_id' => 'Faculty Member',
			'batch_section_id' => 'Exam Group',
			'room_id' => 'Room',
			'exam_date_id' => 'Exam Date',
			'additional_faculty_member_id' => 'Additional Faculty Member',
			'course_id' => 'Course',
			'department_id' => 'Department',
			'batch_id' => 'Batch',
			'batch_group_id' => 'Batch Group',
			'weekday' => 'Weekday',
			'exam_routine_id' => 'Exam Routine',
			'semester_id' => 'Semester',
			'subject_id' => 'Subject',
			'exam_time' => 'Time',
		);
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
		$criteria->compare('session_id',$this->session_id);
		$criteria->compare('faculty_member_id',$this->faculty_member_id);
		$criteria->compare('batch_section_id',$this->batch_section_id);
		$criteria->compare('room_id',$this->room_id);
		$criteria->compare('exam_date_id',$this->exam_date_id);
		$criteria->compare('additional_faculty_member_id',$this->additional_faculty_member_id);
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('batch_group_id',$this->batch_group_id);
		$criteria->compare('weekday',$this->weekday,true);
		$criteria->compare('exam_routine_id',$this->exam_routine_id);
		$criteria->compare('semester_id',$this->semester_id);
		$criteria->compare('subject_id',$this->subject_id);
		$criteria->compare('time',$this->time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}