<?php

/**
 * This is the model class for table "auth_user_role".
 *
 * The followings are the available columns in table 'auth_user_role':
 * @property string $id
 * @property string $name
 * @property string $active
 */
class AuthUserRole extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AuthUserRole the static model class
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
		return 'auth_user_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>250),
			array('active', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, active', 'safe', 'on'=>'search'),
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
		'AuthUserRoleTouser' => array(self::HAS_MANY, 'AuthUser', 'role_id'),
		'AuthUserRoleToAura' => array(self::HAS_MANY, 'AuthUserRoleAccess', 'role_id'),
		
		
		
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'active' => 'Active',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}