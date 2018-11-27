<?php

/**
 * This is the model class for table "exam_marks".
 *
 * The followings are the available columns in table 'exam_marks':
 * @property integer $id
 * @property integer $examseting_id
 * @property integer $teacher_id
 * @property double $marks
 * @property integer $session
 * @property integer $course
 * @property integer $department
 * @property integer $subject
 * @property integer $student_pk
 * @property integer $student_id
 * @property integer $semester
 * @property integer $batch_id
 * @property integer $batch_group
 */
class ExamMarks extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExamMarks the static model class
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
		return 'exam_marks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('examseting_id, teacher_id, marks, session, course, department, subject, student_id, semester', 'safe'),
			array('examseting_id, teacher_id, session, course, department, subject, student_pk, student_id, semester, batch_id, batch_group', 'numerical', 'integerOnly'=>true),
			array('marks','length', 'max'=>128),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, examseting_id, teacher_id, marks, session, course, department, subject, student_pk, student_id, semester, batch_id, batch_group', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'examseting_id' => 'Examseting',
			'teacher_id' => 'Teacher',
			'marks' => 'Marks',
			'session' => 'Session',
			'course' => 'Course',
			'department' => 'Department',
			'subject' => 'Subject',
			'student_pk' => 'Student Pk',
			'student_id' => 'Student',
			'semester' => 'Semester',
			'batch_id' => 'Batch',
			'batch_group' => 'Batch Group',
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
		$criteria->compare('examseting_id',$this->examseting_id);
		$criteria->compare('teacher_id',$this->teacher_id);
		$criteria->compare('marks',$this->marks);
		$criteria->compare('session',$this->session);
		$criteria->compare('course',$this->course);
		$criteria->compare('department',$this->department);
		$criteria->compare('subject',$this->subject);
		$criteria->compare('student_pk',$this->student_pk);
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('semester',$this->semester);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('batch_group',$this->batch_group);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}