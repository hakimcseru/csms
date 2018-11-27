<?php

/**
 * This is the model class for table "student_attendance_data".
 *
 * The followings are the available columns in table 'student_attendance_data':
 * @property string $id
 * @property string $student_id
 * @property string $student_reg_no
 * @property string $date
 * @property string $time
 * @property string $mode
 * @property string $note
 */
class StudentAttendanceData extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StudentAttendanceData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	 public $weekday;
	public function tableName()
	{
		return 'student_attendance_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, student_reg_no, date, time', 'required'),
			array('student_id, student_reg_no', 'length', 'max'=>20),
			array('mode', 'length', 'max'=>4),
			array('note', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, student_reg_no, date, time, mode, note', 'safe', 'on'=>'search'),
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
                    'student' => array(self::BELONGS_TO, 'Student', 'student_id'),
					//'student2' => array(self::HAS_ONE, 'Student', array('student_id'=>'student_reg_no'))
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'student_id' => Yii::t('core','ID'),
			'student_reg_no' => Yii::t('core','ID'),
			'date' => Yii::t('core','Date'),
			'time' => Yii::t('core','Time'),
			'weekday' => Yii::t('core','Weekday'),
			'mode' => 'Mode',
			'note' => 'Note',
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
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('student_reg_no',$this->student_reg_no,false);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('mode',$this->mode,true);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
		public function allattendance()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->group='date';
		$criteria->compare('id',$this->id,true);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('student_reg_no',$this->student_reg_no,false);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('mode',$this->mode,true);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function searchdetail($date)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->condition="date='".$date."'";
		$criteria->compare('id',$this->id,true);
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('student_reg_no',$this->student_reg_no,true);
		//$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('mode',$this->mode,true);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchAttendanceDate()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->group='date';
		
		$criteria->compare('date',$this->date,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
}