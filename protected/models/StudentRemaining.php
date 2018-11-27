<?php

/**
 * This is the model class for table "student_remaining".
 *
 * The followings are the available columns in table 'student_remaining':
 * @property string $id
 * @property string $student_pk
 * @property string $student_id
 * @property double $remaining_amount
 * @property string $description
 */
class StudentRemaining extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StudentRemaining the static model class
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
		return 'student_remaining';
	}

	
	
	 public function getTotals($column,$student_pk,$session_id=0)
        {
   
                 
 
                 $connection=Yii::app()->db;
                 
				 if($session_id)
				 $command=$connection->createCommand("SELECT SUM($column) FROM student_remaining where student_pk=".$student_pk." and session_id='".$session_id."'");
				 else
				 $command=$connection->createCommand("SELECT SUM($column) FROM student_remaining where student_pk=".$student_pk);
                 return '<span style="color:red;">'.Bndate::t($command->queryScalar()).'</span>';
 				//return '100';
 				
 				
 		

        }
	/**
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_pk, student_id', 'required'),
			array('remaining_amount,session_id', 'numerical'),
			array('student_pk, student_id', 'length', 'max'=>20),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_pk, session_id, student_id, remaining_amount, description', 'safe', 'on'=>'search'),
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
			'remaining_amount' => 'Remaining Amount',
			'description' => 'Description',
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
		$criteria->compare('remaining_amount',$this->remaining_amount);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('session_id',$this->session_id,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>100)
		));
	}
}