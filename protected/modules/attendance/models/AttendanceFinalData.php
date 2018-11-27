<?php

/**
 * This is the model class for table "attendance_final_data".
 *
 * The followings are the available columns in table 'attendance_final_data':
 * @property string $id
 * @property string $core_employee_id
 * @property string $core_employee_name
 * @property string $core_shift_id
 * @property string $core_shift_name
 * @property string $core_department_id
 * @property string $core_department_name
 * @property string $date
 * @property string $status
 * @property string $in_time
 * @property string $break_start
 * @property string $break_end
 * @property string $out_time
 * @property string $work_hour
 * @property double $over_time
 * @property string $note
 * @property string $json_log
 */
class AttendanceFinalData extends CActiveRecord
{
	public $dateFrom,$dateTo;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AttendanceFinalData the static model class
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
		return 'attendance_final_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('core_employee_id, core_employee_name, core_shift_name, core_department_name, date, status', 'required'),
			array('over_time,work_hour', 'numerical', 'integerOnly'=>true),
			array('over_time,work_hour', 'default', 'setOnEmpty' => true, 'value' => 0),
			array('in_time, break_start, break_end, out_time, json_log', 'default', 'setOnEmpty' => true, 'value' => null),
			array('core_employee_id, core_shift_id, core_department_id', 'length', 'max'=>20),
			array('core_employee_name, core_department_name', 'length', 'max'=>128),
			array('core_shift_name', 'length', 'max'=>64),
			array('status', 'length', 'max'=>16),
			array('note', 'length', 'max'=>256),
			array('dateFrom, dateTo', 'safe'),
			array('in_time, break_start, break_end, out_time, json_log', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, core_employee_id, core_employee_name, core_shift_id, core_shift_name, core_department_id, core_department_name, date, status, in_time, break_start, break_end, out_time, work_hour, over_time, note, json_log, dateFrom, dateTo', 'safe', 'on'=>'search'),
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
			'employee' => array(self::BELONGS_TO, 'CoreEmployee', 'core_employee_id'),
		);
	}
        
        public function getTimeColor($status,$date)
        {
            if (strpos($status,'L') !== false) {
                return '<p style="color:red">'.$date.'</p>';
            }
            else return $date;
            
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('attendance', 'ID'),
			'core_employee_id' => Yii::t('attendance', 'Employee'),
			'core_employee_name' => Yii::t('attendance', 'Employee'),
			'core_shift_id' => Yii::t('attendance', 'Shift'),
			'core_shift_name' => Yii::t('attendance', 'Shift'),
			'core_department_id' => Yii::t('attendance', 'Department'),
			'core_department_name' => Yii::t('attendance', 'Department'),
			'date' => Yii::t('attendance', 'Date'),
			'status' => Yii::t('attendance', 'Status'),
			'in_time' => Yii::t('attendance', 'In Time'),
			'break_start' => Yii::t('attendance', 'Break Start'),
			'break_end' => Yii::t('attendance', 'Break End'),
			'out_time' => Yii::t('attendance', 'Out Time'),
			'work_hour' => Yii::t('attendance', 'Work Hour'),
			'over_time' => Yii::t('attendance', 'Over Time'),
			'note' => Yii::t('attendance', 'Note'),
			'json_log' => Yii::t('attendance', 'Json Log'),
			'dateFrom' => Yii::t('attendance', 'Date From'),
			'dateTo' => Yii::t('attendance', 'Date To'),

			'present' => Yii::t('attendance', 'Prasent'),
			'late_in' => Yii::t('attendance', 'Late In'),
			'early_out' => Yii::t('attendance', 'Early Out'),
			'day_off' => Yii::t('attendance', 'Day Off'),
			'leave' => Yii::t('attendance', 'Leave'),
			'absent' => Yii::t('attendance', 'Absent'),
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

		$criteria->compare('core_employee_id',$this->core_employee_id,false);
		$criteria->compare('core_shift_id',$this->core_shift_id,false);
		$criteria->compare('core_department_id',$this->core_department_id,false);
		$criteria->compare('date',$this->date,false);
		if(isset($this->dateFrom,  $this->dateTo))
			$criteria->addBetweenCondition('t.date', $this->dateFrom, $this->dateTo);
		$criteria->compare('status',$this->status,true);
		$criteria->order = 'date DESC, core_department_id ASC, core_employee_id ASC, core_shift_id ASC';

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState(get_class($this).'_pageSize'),
				
			),
			'criteria' => $criteria,
		));
	}
	public function searchEmpAtt()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('core_employee_id',$this->core_employee_id,false);
		$criteria->compare('core_shift_id',$this->core_shift_id,false);
		$criteria->compare('core_department_id',$this->core_department_id,false);
		$criteria->compare('date',$this->date,false);
		if(isset($this->dateFrom,  $this->dateTo))
			$criteria->addBetweenCondition('t.date', $this->dateFrom, $this->dateTo);
		$criteria->compare('status',$this->status,true);
		$criteria->order = 'date DESC, core_department_id ASC, core_shift_id ASC';

		return new CActiveDataProvider($this, array(
			'pagination'=>false,
			'criteria' => $criteria,
		));
	}
	public function behaviors() {
		return array(
			'ERememberFiltersBehavior' => array(
				'class' => 'application.components.ERememberFiltersBehavior',
				'defaults' => array(), /* default value of attributes */
				'defaultStickOnClear' => false /* Put default value if user clear the attributes */
			),
		);
	}

	public static function getStatusList() 
	{
		return array(
			'P '=> Yii::t('attendance', 'Prasent'),
			'L '=>  Yii::t('attendance', 'Late In'),
			'E '=> Yii::t('attendance', 'Early Out'),
			'A '=> Yii::t('attendance', 'Absent'),
			'X '=> Yii::t('attendance', 'Day Off'),

			'HF '=> Yii::t('attendance', 'Festival Holiday'),
			'HO '=> Yii::t('attendance', 'Others Holiday'),
			'HW '=> Yii::t('attendance', 'Weekly Holiday'),

			'LC '=> Yii::t('attendance', 'Casual Leave'),
			'LE '=> Yii::t('attendance', 'Earn leave'),
			'LM '=> Yii::t('attendance', 'Maternity leave'),
			'LO '=> Yii::t('attendance', 'Others leave'),
			'LS '=> Yii::t('attendance', 'Sick Leave'),
			'LW '=> Yii::t('attendance', 'Leave without pay'),
		);
	}
//$data["core_employee_id"]?CoreEmployee::model()->findByPk($data["core_employee_id"])->name:""

public function get_name($data)
{


if(isset($data["core_employee_id"])) 
{
$new=CoreEmployee::model()->findByPk($data["core_employee_id"]);

if($new) return $new->name;
else "ID:".$data["core_employee_id"];
}
else return 0;

}
	public function attendanceLateSummary(){
		$command = Yii::app()->db->createCommand();
		$command->select(array(
			'id AS id',
			'date AS date', 
			'core_employee_id as core_employee_id',
			'sum( if( `status` LIKE "%P%", 1, 0 ) ) AS `present`',
			'sum( if( `status` LIKE "%A%", 1, 0 ) ) AS `absent`',
			'sum( if( `status` LIKE "%L%" && `status` NOT LIKE "%LS%" && `status` NOT LIKE "%LC%", 1, 0 ) ) AS `late_in`',
			'sum( if( `status` LIKE "%E%", 1, 0 ) ) AS `early_out`',
			'sum( if( `status` LIKE "%O%", 1, 0 ) ) AS `day_off`',
			'sum( if( `status` LIKE "%LS%", 1, 0 ) ) AS `sick_leave`',
			'sum( if( `status` LIKE "%LC%", 1, 0 ) ) AS `casual_leave`',
		));
		$command->from('{{attendance_final_data}}');

		$dept = $this->core_department_id ? "AND core_department_id = $this->core_department_id" : null;
		$shift = $this->core_shift_id ? "AND core_shift_id = $this->core_shift_id" : null;
		$command->where("date BETWEEN '$this->dateFrom' AND '$this->dateTo' $dept $shift");

		$command->group('core_employee_id');
		$command->order = 'core_employee_id ASC';

		return new CArrayDataProvider($command->queryAll(), array(
			'pagination'=>false,
		));
	}
	
	public function attendanceSummary(){
		$command = Yii::app()->db->createCommand();
		$command->select(array(
			'id AS id',
			'date AS date',
			'sum( if( `status` LIKE "%P %", 1, 0 ) ) AS `present`',
			'sum( if( `status` LIKE "%A %", 1, 0 ) ) AS `absent`',
			'sum( if( `status` LIKE "%L %", 1, 0 ) ) AS `late_in`',
			'sum( if( `status` LIKE "%E %", 1, 0 ) ) AS `early_out`',
			'sum( if( `status` LIKE "%X %", 1, 0 ) ) AS `day_off`',
			'sum( if( `status` LIKE "%L. %", 1, 0 ) ) AS `leave`',
		));
		$command->from('{{attendance_final_data}}');

		$dept = $this->core_department_id ? "AND core_department_id = $this->core_department_id" : null;
		$shift = $this->core_shift_id ? "AND core_shift_id = $this->core_shift_id" : null;
		$command->where("date BETWEEN '$this->dateFrom' AND '$this->dateTo' $dept $shift");

		$command->group('date');
		$command->order = 'date DESC';

		return new CArrayDataProvider($command->queryAll(), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState(get_class($this).'_pageSize'),
			),
		));
	}
        
        public function allAttendanceSummary(){
		$command = Yii::app()->db->createCommand();
		$command->select(array(
			'id AS id',
			'core_employee_id as core_employee_id',
                    'core_employee_name as core_employee_name',
                    'core_department_name AS core_department_name',
                    
			'sum( if( `status` LIKE "%P %", 1, 0 ) ) AS `present`',
			'sum( if( `status` LIKE "%A %", 1, 0 ) ) AS `absent`',
			'sum( if( `status` LIKE "%L %", 1, 0 ) ) AS `late_in`',
			'sum( if( `status` LIKE "%E %", 1, 0 ) ) AS `early_out`',
			'sum( if( `status` LIKE "%X %", 1, 0 ) ) AS `day_off`',
			'sum( if( `status` LIKE "%L. %", 1, 0 ) ) AS `leave`',
		));
		$command->from('{{attendance_final_data}}');

		$dept = $this->core_department_id ? "AND core_department_id = $this->core_department_id" : null;
		$shift = $this->core_shift_id ? "AND core_shift_id = $this->core_shift_id" : null;
		$command->where("date BETWEEN '$this->dateFrom' AND '$this->dateTo' $dept $shift");

		$command->group('core_employee_id');
		$command->order = 'core_employee_name ASC'; 

                return new CArrayDataProvider($command->queryAll(), array(
			'pagination'=>false,
		));
                /*
		return new CArrayDataProvider($command->queryAll(), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState(get_class($this).'_pageSize'),
			),
		));*/
	}
}