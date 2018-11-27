<?php

/**
 * This is the model class for table "room".
 *
 * The followings are the available columns in table 'room':
 * @property string $room_pk
 * @property string $room_no
 * @property string $room_description
 * @property integer $room_capacity
 * @property string $room_condition
 * @property string $room_type
 */
class Room extends CActiveRecord
{

	public $enumRoomCondition = array('GOOD'=>'Good', 'DEFECTIVE'=>'Defective','UNAVAILABLE'=>'Unavailable');
	public $enumRoomType = array(
		'CLASS'=>'শ্রেণিকক্ষ',
                'OFFICE'=>'কার্যালয়',
                'AUDITORIUM'=>'মিলনায়তন',
		'STORE'=>'রক্ষণাগার',
                'COMPUTERLAB'=>'কম্পিউটার ল্যাবরেটরি',
                'AUDIORECORDING'=>'শব্দধারণকেন্দ্র',
		'CONFERENCE'=> 'বক্তৃতা-কক্ষ',
		'HALL'=>'মিলনকেন্দ্র',
		'LAB'=>'বিজ্ঞানাগার',
		'LIBRARY'=>'পাঠাগার',
		
		);
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Room the static model class
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
		return 'room';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('room_no', 'required'),
			array('room_no', 'unique'),
			array('room_capacity', 'numerical', 'integerOnly'=>true),
			array('room_no', 'length', 'max'=>6),
			array('room_condition, room_type', 'length', 'max'=>16),
                        array('room_name', 'length', 'max'=>250),
                    
			array('room_description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('room_pk,room_name, room_no, room_description, room_capacity, room_condition, room_type', 'safe', 'on'=>'search'),
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
			'room_pk' => Yii::t('core','Room#'),
			'room_no' => Yii::t('core','Room No'),
			'room_description' => Yii::t('core','Description'),
			'room_capacity' => Yii::t('core','Capacity'),
			'room_condition' => Yii::t('core','Condition'),
			'room_type' => Yii::t('core','Type'),
                        'room_name' => Yii::t('core','Room Name'),
                    
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

		$criteria->compare('room_pk',$this->room_pk,true);
		$criteria->compare('room_no',$this->room_no,true);
		$criteria->compare('room_description',$this->room_description,true);
		$criteria->compare('room_capacity',$this->room_capacity);
		$criteria->compare('room_condition',$this->room_condition,true);
		$criteria->compare('room_type',$this->room_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}