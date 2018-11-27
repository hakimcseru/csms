<?php

/**
 * This is the model class for table "calendar".
 *
 * The followings are the available columns in table 'calendar':
 * @property string $calendar_pk
 * @property string $calendar_ref_room_pk
 * @property string $calendar_ref_room_no
 * @property string $calendar_title
 * @property string $calendar_description
 * @property string $calendar_date
 * @property string $calendar_start_time
 * @property string $calendar_end_time
 * @property string $calendar_link
 * @property string $calendar_reference
 * @property string $calendar_day
 * @property string $calendar_type
 */
class Calendar extends CActiveRecord
{
	public $enumCalendarDay = array('SAT'=>'SAT','SUN'=>'SUN','MON'=>'MON',
		'TUE'=>'TUE','WED'=>'WED','THU'=>'THU','FRI'=>'FRI');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Calendar the static model class
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
		return 'calendar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('calendar_ref_room_pk, calendar_ref_room_no, calendar_title, calendar_date, calendar_start_time, calendar_end_time, calendar_reference, calendar_day', 'required'),
			array('calendar_ref_room_pk', 'length', 'max'=>20),
			array('calendar_type', 'length', 'max'=>3),
			array('calendar_ref_room_no, calendar_reference', 'length', 'max'=>32),
			array('calendar_title', 'length', 'max'=>128),
			array('calendar_link', 'length', 'max'=>256),
			array('calendar_description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('calendar_pk, calendar_ref_room_pk, calendar_ref_room_no, calendar_title, calendar_description, calendar_date, calendar_start_time, calendar_end_time, calendar_link, calendar_reference, calendar_day, calendar_type, ', 'safe', 'on'=>'search'),
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
			'calendar_pk' => Yii::t('core','Entry#'),
			'calendar_ref_room_pk' => Yii::t('core','Room Pk'),
			'calendar_ref_room_no' => Yii::t('core','Room#'),
			'calendar_title' => Yii::t('core', 'Title'),
			'calendar_description' => Yii::t('core','Description'),
			'calendar_date' => Yii::t('core', 'Date'),
			'calendar_start_time' => Yii::t('core','Start Time'),
			'calendar_end_time' => Yii::t('core','End Time'),
			'calendar_link' => Yii::t('core','URL'),
			'calendar_reference' => Yii::t('core','Reference'),
			'calendar_day' => Yii::t('core','Day'),
			'calendar_type' => Yii::t('core','Type'),
			'calendar_day'=> Yii::t('core','Day'),
			'calendar_title'=> Yii::t('core','Title'),
		);
	}


	public function getCriteria($startDate = null, $endDate = null)
	{
		$criteria=new CDbCriteria;

		$criteria->compare('calendar_pk',$this->calendar_pk,true);
		$criteria->compare('calendar_ref_room_pk',$this->calendar_ref_room_pk,false);
		$criteria->compare('calendar_ref_room_no',$this->calendar_ref_room_no,false);

		if($startDate && $endDate)
			$criteria->addBetweenCondition('calendar_date', $startDate, $endDate);
		else
			$criteria->compare('calendar_date',$this->calendar_date,true);

//		if($this->calendar_start_time && $this->calendar_end_time)
//		{
			$criteria->compare('calendar_start_time',"<$this->calendar_end_time",false);
			$criteria->compare('calendar_end_time',">$this->calendar_start_time",false);
//		}
//		else
//		{
//			$criteria->compare('calendar_start_time',"$this->calendar_start_time",false);
//			$criteria->compare('calendar_end_time',"$this->calendar_end_time",false);
//		}

//		$criteria->compare('calendar_reference',$this->calendar_reference,false);
		$day = explode(',', $this->calendar_day);
//		$criteria->compare('calendar_day',$day, true, 'OR');
//		$criteria->compare('calendar_type',$this->calendar_type,false);
		$criteria->order = 'calendar_date, calendar_start_time';

		return $criteria;
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($startDate = null, $endDate = null)
	{
		return new CActiveDataProvider($this, array(
			'criteria'=>  $this->getCriteria($startDate, $endDate),
		));
	}

	public function isAvailable($startDate = null, $endDate = null)
	{
		$calendarPk = $this->calendar_pk;
		//unset calendar_pk to remove clash with other criteria
		unset ($this->calendar_pk);

		$criteria = $this->getCriteria($startDate, $endDate);
		//Ignore clash with own
		$criteria->compare('calendar_pk',"<>$calendarPk",false);

		//reset calendar_pk
		$this->calendar_pk = $calendarPk;
		return !$this->model()->exists($criteria);
	}

	public function beforeSave() {
		
		return parent::beforeSave();
	}
}