<?php

class AttendanceDevice extends CFormModel{

	public $EnrollNo,	$Year, $Month, $Day, $Hour, $Minute, $Second, $VerifyMode, $InOutMode, $WorkCode;
	public $username, $password, $apiKey;

	//public $optionInOUtMode = array('0'=>'IN', '1'=>'OUT');
        public $optionInOUtMode = array(0=>'IN', 1=>'OUT',2=>'OUT', 3=>'IN', 4=>'IN',5=>'OUT');

	public function rules()
	{
		return array(
			array('EnrollNo, Year, Month, Day, Hour, Minute, Second, VerifyMode, InOutMode, WorkCode,
				username, password, apiKey', 'required'),
		);
	}

	public function afterValidate() {
		if($this->username != 'admin')
			$this->addError ('username', 'Invalid Username.');
		if($this->password !== '01041419')
			$this->addError ('password', 'Invalid Password.');
		if($this->apiKey != 'ynpwyfnchiwpfvgf')
			$this->addError ('apiKey', 'Invalid API Key.');
		return parent::afterValidate();
	}

	public function save()
	{
		$datetime = date('Y-m-d H:i:s', strtotime($this->Year.'-'.$this->Month.'-'.$this->Day.' '.$this->Hour.':'.$this->Minute.':'.$this->Second));
		$data = new AttendanceTempData();
		$data->core_employee_id = $this->EnrollNo;
		$data->date = substr($datetime, 0, 10);
		$data->time = $datetime;
		$data->mode = $this->optionInOUtMode[$this->InOutMode];
		
		$data2 = new AttendanceTempData2();
		$data2->core_employee_id = $this->EnrollNo;
		$data2->date = substr($datetime, 0, 10);
		$data2->time = $datetime;
		$data2->mode = $this->optionInOUtMode[$this->InOutMode];
		$data2->save(false);
		return $data->save(false);
	}
}
?>
