<?php

/**
 * This is the model class for table "faculty_member".
 *
 * The followings are the available columns in table 'faculty_member':
 * @property string $member_id
 * @property string $member_name
 * @property string $member_father_name
 * @property string $member_mother_name
 * @property string $member_present_address
 * @property string $member_permanent_address
 * @property string $member_nationality
 * @property string $member_gender
 * @property string $member_dob
 * @property string $member_profession
 * @property string $member_email
 * @property string $member_contact
 * @property string $member_blood_group
 * @property string $member_qualification
 * @property string $member_alternate_contact
 * @property string $member_pk
 * @property string $member_image
 * @property integer $faculty_id
 */
class FacultyMember extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FacultyMember the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public $enumGender = array('MALE'=> 'ছেলে', 'FEMALE'=> 'মেয়ে');
	public $enumBloodGroup = array('A+', 'A-', 'AB+', 'AB-', 'B+', 'B-', 'O+', 'O-');

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'faculty_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, member_name, faculty_id', 'required'),
			array('faculty_id, department_id', 'numerical', 'integerOnly'=>true),
			array('member_id', 'length', 'max'=>16),
			array('member_name, member_father_name, member_mother_name, member_email,designation', 'length', 'max'=>128),
			array('member_nationality, member_contact', 'length', 'max'=>32),
			array('member_gender', 'length', 'max'=>6),
			array('member_profession', 'length', 'max'=>64),
			array('member_blood_group', 'length', 'max'=>10),
			array('member_image', 'length', 'max'=>250),
			array('member_present_address, designation member_permanent_address, member_dob, department_id, member_qualification, member_alternate_contact', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('member_id, member_name, member_father_name, member_mother_name, department_id, member_present_address, member_permanent_address, member_nationality, member_gender, member_dob, member_profession,designation, member_email, member_contact, member_blood_group, member_qualification, member_alternate_contact, member_pk, member_image, faculty_id', 'safe', 'on'=>'search'),
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
			'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
			'faculty' => array(self::BELONGS_TO, 'Faculty', 'faculty_id'),
		);
	}
        
        public function getStImage($image)
	{
	return Yii::app()->request->getBaseUrl(TRUE)."/images/faculty/".$image;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'member_id' =>  Yii::t('core','Member ID'),
			'member_name' =>  Yii::t('core','Member Name'),
			'member_father_name' =>  Yii::t('core','Member Father Name'),
			'member_mother_name' =>  Yii::t('core','Member Mother Name'),
			'member_present_address' =>  Yii::t('core','Member Present Address'),
			'member_permanent_address' =>  Yii::t('core','Member Permanent Address'),
			'member_nationality' =>  Yii::t('core','Member Nationality'),
			'member_gender' =>  Yii::t('core','Member Gender'),
			'member_dob' =>  Yii::t('core','Member Dob'),
			'member_profession' =>  Yii::t('core','Member Profession'),
			'member_email' =>  Yii::t('core','Member Email'),
			'member_contact' =>  Yii::t('core','Member Contact'),
			'member_blood_group' =>  Yii::t('core','Member Blood Group'),
			'member_qualification' =>  Yii::t('core','Member Qualification'),
			'member_alternate_contact' =>  Yii::t('core','Member Alternate Contact'),
			'member_pk' =>  Yii::t('core','Member Pk'),
			'member_image' =>  Yii::t('core','Member Image'),
			'faculty_id' =>  Yii::t('core','Faculty'),
			'department_id' =>  Yii::t('core','Department'),
			'designation' =>  Yii::t('core','Designation'),
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

		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('member_name',$this->member_name,true);
		$criteria->compare('member_father_name',$this->member_father_name,true);
		$criteria->compare('member_mother_name',$this->member_mother_name,true);
		$criteria->compare('member_present_address',$this->member_present_address,true);
		$criteria->compare('member_permanent_address',$this->member_permanent_address,true);
		$criteria->compare('member_nationality',$this->member_nationality,true);
		$criteria->compare('member_gender',$this->member_gender,false);

		/*if($this->member_gender)
		$criteria->condition="member_gender='".$this->member_gender."'";*/

		$criteria->compare('member_dob',$this->member_dob,true);
		$criteria->compare('member_profession',$this->member_profession,true);
		$criteria->compare('member_email',$this->member_email,true);
		$criteria->compare('member_contact',$this->member_contact,true);
		$criteria->compare('member_blood_group',$this->member_blood_group,true);
		$criteria->compare('member_qualification',$this->member_qualification,true);
		$criteria->compare('member_alternate_contact',$this->member_alternate_contact,true);
		$criteria->compare('member_pk',$this->member_pk,true);
		$criteria->compare('member_image',$this->member_image,true);
		$criteria->compare('faculty_id',$this->faculty_id);
		$criteria->compare('designation',$this->designation);
		

		$criteria->compare('department_id',$this->department_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function searchfm()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('member_name',$this->member_name,true);
		$criteria->compare('member_father_name',$this->member_father_name,true);
		$criteria->compare('member_mother_name',$this->member_mother_name,true);
		$criteria->compare('member_present_address',$this->member_present_address,true);
		$criteria->compare('member_permanent_address',$this->member_permanent_address,true);
		$criteria->compare('member_nationality',$this->member_nationality,true);
		$criteria->compare('member_gender',$this->member_gender,false);

	

		$criteria->compare('member_dob',$this->member_dob,true);
		$criteria->compare('member_profession',$this->member_profession,true);
		$criteria->compare('member_email',$this->member_email,true);
		$criteria->compare('member_contact',$this->member_contact,true);
		$criteria->compare('member_blood_group',$this->member_blood_group,true);
		$criteria->compare('member_qualification',$this->member_qualification,true);
		$criteria->compare('member_alternate_contact',$this->member_alternate_contact,true);
		$criteria->compare('member_pk',$this->member_pk,true);
		$criteria->compare('member_image',$this->member_image,true);
		$criteria->compare('faculty_id',$this->faculty_id,true);

		$criteria->compare('department_id',$this->department_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}