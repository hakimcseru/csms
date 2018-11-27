<?php

/**
 * This is the model class for table "student_fine".
 *
 * The followings are the available columns in table 'student_fine':
 * @property string $id
 * @property string $student_pk
 * @property string $student_id
 * @property double $amount
 * @property integer $session_id
 * @property string $fine_date
 * @property string $year
 * @property string $month
 * @property string $comment
 */
class StudentFine extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StudentFine the static model class
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
		return 'student_fine';
	}

        
        
        public function getTotals($column,$student_pk,$session_id=0)
        {
   
                 
 
                 $connection=Yii::app()->db;
				 if($session_id)
                 $command=$connection->createCommand("SELECT SUM($column) FROM student_fine where student_pk=".$student_pk." and session_id='".$session_id."'");
				 else
				 $command=$connection->createCommand("SELECT SUM($column) FROM student_fine where student_pk=".$student_pk);
                 return '<span style="color:red;">'.Bndate::t($command->queryScalar()).'</span>';
 				//return '100';
 				
 				
 		

        }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_pk, student_id, amount, session_id', 'required'),
			array('session_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('student_pk', 'length', 'max'=>20),
			array('student_id', 'length', 'max'=>16),
			array('year, month, comment', 'length', 'max'=>250),
			array('fine_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_pk, student_id, amount, session_id, fine_date, year, month, comment', 'safe', 'on'=>'search'),
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
			'amount' => 'Amount',
			'session_id' => 'Session',
			'fine_date' => 'Fine Date',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('student_pk',$this->student_pk,false);
		$criteria->compare('student_id',$this->student_id,false);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('session_id',$this->session_id);
		$criteria->compare('fine_date',$this->fine_date,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}