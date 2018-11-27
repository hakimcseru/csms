<?php

/**
 * This is the model class for table "batch".
 *
 * The followings are the available columns in table 'batch':
 * @property string $batch_pk
 * @property string $batch_id
 * @property string $batch_start_date
 * @property string $batch_end_date
 * @property string $batch_status
 * @property string $batch_ref_course_pk
 * @property string $batch_ref_course_name
 *
 * The followings are the available relations of the Batch model:
 * @property Course $course
 * @property Class $class
 * @property Student $students[]
 */
class Batch extends CActiveRecord
{
	public $enumBatchStatus = array('NEW'=>'নতুন', 'CANCELED'=>'বাতিল', 'RUNNING'=>'চলমান', 'COMPLETED'=>'সমাপ্ত');


	public function getBatchStatus()
	{
	return array(
		array('id'=>'NEW', 'title'=>Yii::t('core','New')),
		array('id'=>'CANCELED', 'title'=>Yii::t('core','Canceled')),
		array('id'=>'RUNNING', 'title'=>Yii::t('core','Running')),
		array('id'=>'COMPLETED', 'title'=>Yii::t('core','Completed'))	);
	}
	/*public function getBatchStatus($st)
	{
	if($st == 'NEW')
		return 'New';
	elseif($st == 'CANCELED')
		return 'Canceled';

	elseif($st == 'RUNNING')
		return 'Running';

	elseif($st == 'COMPLETED')
		return 'Completed';

	else		return FALSE;
	}
*/
	public $enumGroup = array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4','5'=>'5');

	public $group;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Batch the static model class
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
		return 'batch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_id', 'required'),
			array('batch_id', 'unique'),
			//array('minimum_fees', 'numerical'),
			//array('batch_ref_course_name', 'required', 'on'=>'update'),
			array('batch_ref_course_pk, department_id', 'required', 'on'=>'insert'),
			array('batch_id', 'length', 'max'=>32),
			array('batch_status', 'length', 'max'=>16),
			array('batch_ref_course_pk, department_id', 'length', 'max'=>20),
			array('batch_ref_course_name', 'length', 'max'=>128),
			array('batch_start_date, batch_end_date, ', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('batch_pk, batch_id, batch_start_date, batch_end_date, department_id, batch_status, batch_ref_course_pk, batch_ref_course_name, minimum_fees', 'safe', 'on'=>'search'),
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
			'batchgrp' => array(self::HAS_MANY, 'BatchGroup', 'batch_id)'),
			'class' => array(self::HAS_MANY, 'ClassModel', 'class_ref_batch_pk)'),
			'course' => array(self::BELONGS_TO, 'Course', 'batch_ref_course_pk'),
			'students' => array(self::HAS_MANY, 'Student', 'student_ref_batch_pk'),
			'studentsCount' => array(self::STAT, 'Student', 'student_ref_batch_pk'),
			'classCount' => array(self::STAT, 'ClassModel', 'class_ref_batch_pk'),
			'department'=>array(self::BELONGS_TO, 'Department', 'department_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'batch_pk' => Yii::t('core','Batch Pk'),
			'batch_id' => Yii::t('core','Batch'),
			'batch_start_date' => Yii::t('core','Start Date'),
			'batch_end_date' => Yii::t('core','End Date'),
			'batch_status' => Yii::t('core','Status'),
			'batch_ref_course_pk' => Yii::t('core','Course'),
			'batch_ref_course_name' => Yii::t('core','Course Name'),
			'minimum_fees' => Yii::t('core','Minimum Fees'),
			'department_id' => Yii::t('core','Department'),
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

		$criteria->compare('batch_pk',$this->batch_pk,false);
		$criteria->compare('batch_id',$this->batch_id,false);
		$criteria->compare('batch_start_date',$this->batch_start_date,false);
		$criteria->compare('batch_end_date',$this->batch_end_date,false);
		$criteria->compare('batch_status',$this->batch_status,false);
		$criteria->compare('batch_ref_course_pk',$this->batch_ref_course_pk,false);
		$criteria->compare('batch_ref_course_name',$this->batch_ref_course_name,true);
		$criteria->compare('minimum_fees',$this->minimum_fees,false);

		$criteria->compare('department_id',$this->department_id,false);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function afterSave() {

		if($this->isNewRecord){
			$subjects = CourseSubject::model()->with('subject')->findAll("course_subject_ref_course_pk = $this->batch_ref_course_pk");
			//print_r($subjects->attributes); exit;
			foreach($subjects as $subject)
			{
				//print_r($subject->attributes);				continue;
				$class = new ClassModel();
				$class->class_ref_batch_pk = $this->batch_pk;
				$class->class_ref_batch_id = $this->batch_id;
				$class->class_ref_subject_pk = $subject->subject->subject_pk;
				$class->class_ref_subject_name = $subject->subject->subject_name;
				$class->class_semester = $subject->course_subject_semester_no;


				$class->save(false);
			}
		}

		return parent::afterSave();
	}
}