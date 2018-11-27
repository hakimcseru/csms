<?php
class DateRangeForm extends CFormModel
{
	public $start_date;
	public $end_date;
	public $session;
	

	public function rules()
	{
		return array(
			// username and password are required
			array('start_date, end_date, session', 'required'),	
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			
		);
	}

	
	
}
