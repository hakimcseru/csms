<?php

/**
 * This is the model class for table "faculty_member_attendance_data".
 *
 * The followings are the available columns in table 'faculty_member_attendance_data':
 * @property string $id
 * @property string $member_id
 * @property string $fm_reg_no
 * @property string $date
 * @property string $time
 * @property string $mode
 * @property string $note
 */
class FacultyMemberAttendanceData extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FacultyMemberAttendanceData the static model class
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
		return 'faculty_member_attendance_data';
	}
	//public $weekday;
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, fm_reg_no, date, time', 'required'),
			array('member_id, fm_reg_no', 'length', 'max'=>20),
			array('mode', 'length', 'max'=>4),
			array('note', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, member_id, fm_reg_no, date, time, mode, note, weekday', 'safe', 'on'=>'search'),
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
		'fm' => array(self::BELONGS_TO, 'FacultyMember', 'member_id'),
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'member_id' => 'Member',
			'fm_reg_no' => 'Fm Reg No',
			'date' => 'Date',
			'weekday' => Yii::t('core','Weekday'),
			'time' => 'Time',
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
		$criteria->compare('member_id',$this->member_id,false);
		$criteria->compare('fm_reg_no',$this->fm_reg_no,false);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('mode',$this->mode,true);
		$criteria->compare('note',$this->note,true);
		
		
		$criteria->compare('weekday',$this->weekday,false);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}