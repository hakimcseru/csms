<?php

/**
 * This is the model class for table "{{contact}}".
 *
 * The followings are the available columns in table '{{contact}}':
 * @property string $contact_pk
 * @property string $contact_type
 * @property string $contact_name
 * @property string $contact_organization
 * @property string $contact_email
 * @property string $contact_phone
 * @property string $contact_address
 * @property string $contact_mou
 */
class ContactManager extends CActiveRecord
{
	public $enumContactType = array('AFFILIATED'=> 'Affiliated', 'LOGISTICAL'=> 'Logistical', 'THIRD_PARTY'=> 'Third Party');
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContactManager the static model class
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
		return '{{contact}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_type, contact_name', 'required'),
			array('contact_type', 'length', 'max'=>11),
			array('contact_name, contact_organization, contact_email', 'length', 'max'=>128),
			array('contact_phone', 'length', 'max'=>32),
			array('contact_address, contact_mou', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('contact_pk, contact_type, contact_name, contact_organization, contact_email, contact_phone, contact_address, contact_mou', 'safe', 'on'=>'search'),
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
			'contact_pk' => Yii::t('core','Contact No'),
			'contact_type' => Yii::t('core','Type'),
			'contact_name' => Yii::t('core','Name'),
			'contact_organization' => Yii::t('core','Organization'),
			'contact_email' => Yii::t('core','Email'),
			'contact_phone' => Yii::t('core','Phone'),
			'contact_address' => Yii::t('core','Address'),
			'contact_mou' => Yii::t('core','MOU'),
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

		$criteria->compare('contact_pk',$this->contact_pk,true);
		$criteria->compare('contact_type',$this->contact_type,true);
		$criteria->compare('contact_name',$this->contact_name,true);
		$criteria->compare('contact_organization',$this->contact_organization,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('contact_address',$this->contact_address,true);
		$criteria->compare('contact_mou',$this->contact_mou,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}