<?php

/**
 * This is the model class for table "student_dues".
 *
 * The followings are the available columns in table 'student_dues':
 * @property string $id
 * @property string $student_pk
 * @property string $student_id
 * @property string $collection_id
 * @property double $due_amount
 * @property integer $session_id
 * @property string $due_date
 * @property string $course_id
 * @property string $year
 * @property string $month
 * @property string $comment
 */
class StudentDues extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StudentDues the static model class
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
		return 'student_dues';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
        
        
        public function getTotals($column,$student_pk,$session_id=0)
{
   
                 
 
                 $connection=Yii::app()->db;
				 if($session_id)
                 $command=$connection->createCommand("SELECT SUM($column) FROM student_dues where student_pk=".$student_pk." and session_id='".$session_id."'");
				 else
				 $command=$connection->createCommand("SELECT SUM($column) FROM student_dues where student_pk=".$student_pk);
                 return '<span style="color:red;">'.Bndate::t($command->queryScalar()).'</span>';
 				//return '100';
 				
 				
 		

}
        
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_pk, student_id, collection_id, due_amount, session_id, course_id', 'required'),
			array('session_id', 'numerical', 'integerOnly'=>true),
			array('due_amount', 'numerical'),
			array('student_pk, collection_id, course_id', 'length', 'max'=>20),
			array('student_id', 'length', 'max'=>16),
			array('year, month, comment', 'length', 'max'=>250),
			array('due_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_pk, student_id, collection_id, due_amount, session_id, due_date, course_id, year, month, comment', 'safe', 'on'=>'search'),
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
		'students' => array(self::BELONGS_TO, 'Student', 'student_pk'),
		'studentsenrollment' => array(self::HAS_ONE, 'StudentEnrollmentInfo', array('session'=>'session_id','student_pk'=>'student_pk')),
		'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'student_pk' => 'Student Pk',
			'student_id' => 'Student',
			'collection_id' => 'Collection',
			'due_amount' => 'Due Amount',
			'session_id' => 'Session',
			'due_date' => 'Due Date',
			'course_id' => 'Course',
			'year' => 'Year',
			'month' => 'Month',
			'comment' => 'Comment',
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
                
                
                //if($spk) $criteria->condition="student_pk=".$spk;
                
		$criteria->compare('id',$this->id,true);
		$criteria->compare('student_pk',$this->student_pk,false);
		$criteria->compare('student_id',$this->student_id,false);
		$criteria->compare('collection_id',$this->collection_id,true);
		$criteria->compare('due_amount',$this->due_amount);
		$criteria->compare('session_id',$this->session_id,false);
		$criteria->compare('due_date',$this->due_date,false);
		$criteria->compare('course_id',$this->course_id,false);
		$criteria->compare('year',$this->year,false);
		$criteria->compare('month',$this->month,false);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}