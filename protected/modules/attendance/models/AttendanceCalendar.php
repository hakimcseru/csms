<?php

/**
 * This is the model class for table "attendance_calendar".
 *
 * The followings are the available columns in table 'attendance_calendar':
 * @property string $id
 * @property string $date
 * @property string $type
 * @property string $title
 * @property string $note
 * @property string $processed_on
 * @property integer $status
 */
class AttendanceCalendar extends CActiveRecord
{
	public $dateFrom, $dateTo;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AttendanceCalendar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public $courses;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'attendance_calendar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('date','unique'),
			array('date, type, course_id', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('processed_on', 'default', 'setOnEmpty'=>true, 'value'=>null),
			array('processed_on', 'unsafe'),
			array('type', 'length', 'max'=>4),
			array('title', 'length', 'max'=>64),
			array('note', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, type,dateFrom,dateTo, title, course_id, note, status, processed_on', 'safe', 'on'=>'search'),
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
		'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('attendance', 'ID'),
			'date' => Yii::t('attendance', 'Date'),
			'type' => Yii::t('attendance', 'Type'),
			'title' => Yii::t('attendance', 'Title'),
			'note' => Yii::t('attendance', 'Note'),
			'processed_on' => Yii::t('attendance', 'Processed Time'),
			'status' => Yii::t('attendance', 'Status'),
			'dateFrom' => Yii::t('attendance', 'Date From'),
			'dateTo' => Yii::t('attendance', 'Date To'),
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
		if(isset($this->dateFrom) && isset($this->dateTo))
		$criteria->condition="date>='".$this->dateFrom."' and date<='".$this->dateTo."'";
		else $criteria->compare('date',$this->date,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('course_id',$this->course_id);
		
		$criteria->order = 'date DESC';

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState(get_class($this).'_pageSize'),
			),
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

	public function getTypes()
	{
		return array(
			'NH'=> Yii::t('attendance', 'National Holiday'),
			'HF'=> Yii::t('attendance', 'Festival Holiday'),
			'HO'=> Yii::t('attendance', 'Others Holiday'),
			'SH'=> Yii::t('attendance', 'Special Holiday'),
		);
	}

	public function getAllWeekDays($start_date="",$end_date="",$weekday="Wednesday" )
	{
	
		//echo "dfg".$start_date." ".$end_date." ".$weekday;
		
		$wd="";
		$sd=strtotime($start_date);
		$ed=strtotime($end_date);
		$res= array();
		//echo date("N",$sd);
		if(date("l",$sd)==$weekday) $res[]=date("Y-m-d",$sd);
		
		
		while($sd<=$ed)
		{
			
			
			
			$cdate= date("Y-m-d",strtotime("next ".$weekday,$sd));
			$sd=strtotime($cdate);
			if($sd<=$ed)
			$res[]=$cdate;
			
			
		}
		return $res;
	}
	
	
	public function getStatusList()
	{
		return array(
			'0'=> Yii::t('attendance', 'Unprocessed'),
			'1'=> Yii::t('attendance', 'Processed'),
		);
	}

	public function process()
	{
		$employees = CoreEmployee::model()->with( array(
				//'shift',
				'department',
				'leave'=>array(
					'on'=>"'$this->date' >= leave.start_date AND '$this->date' <= leave.end_date",
				),
				'attendance'=>array(
					'select'=>false,
					'joinType'=> 'LEFT OUTER JOIN',
					'on'=> "attendance.date = '$this->date'",
				)))->findAll('attendance.core_employee_id IS NULL');

		$day = date('l', strtotime($this->date));

		foreach ($employees as $employee){
			/*@var $employee CoreEmployee */
			$attendance = new AttendanceFinalData();

			$attendance->date = $this->date;
			$attendance->core_employee_id = $employee->id;
			$attendance->core_employee_name = $employee->name;
			
			$emp_shift=EmpShiftCalendar::model()->find("emp_id='".$employee->id."' and date='".$this->date."'");
			
			
			if(isset ($employee->department)){
				$attendance->core_department_id = $employee->department->id;
				$attendance->core_department_name = $employee->department->name;
			}
			
			if(isset ($emp_shift->shift->$day) && $emp_shift->shift_id!=17){
				$attendance->core_shift_id = $emp_shift->shift->$day->id;
				$attendance->core_shift_name = $emp_shift->shift->$day->name;
			}
			else{
				$attendance->status .= "X ";
			}

			//Calculate status
			if($this->type != 'WD'){
				$attendance->status .= "$this->type ";
			}

			//Employee is on Leave
			if(isset($employee->leave)){
				foreach ($employee->leave as $leave){
					/*@var $leave AttendanceLeave */
					$attendance->status .= "$leave->type ";
				}
			}
			if(empty($attendance->status)){
					$attendance->status = 'A ';
			}
			$attendance->save(false);
		}
		//Confirm Success
		return true;
	}
}