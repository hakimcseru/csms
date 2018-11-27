<?php
class Bndate
{
	private $timestamp;	//timestamp as input
	private $morning;	//when the date will change?

	private $engHour;	//Current hour of English Date
	private $engDate;	//Current date of English Date
	private $engMonth;	//Current month of English Date
	private $engYear;	//Current year of English Date

	private $bangDate;	//generated Bangla Date
	private $bangMonth;	//generated Bangla Month
	private $bangYear;	//generated Bangla	Year

	/*
	 * Set the initial date and time
	 *
	 * @param	int timestamp for any date
	 * @param	int, set the time when you want to change the date. if 0, then date will change instantly.
	 *			If it's 6, date will change at 6'0 clock at the morning. Default is 6'0 clock at the morning
	 */
	function __construct($timestamp, $hour = 6)
	{
		$this->BanglaDate($timestamp, $hour);
	}

	/*
	* PHP4 Legacy constructor
	*/
	function BanglaDate($timestamp, $hour = 6)
	{
		$this->engDate = date('d', $timestamp);
		$this->engMonth = date('m', $timestamp);
		$this->engYear = date('Y', $timestamp);
		$this->morning = $hour;
		$this->engHour = date('G', $timestamp);

		//calculate the bangla date
		$this->calculate_date();

		//now call calculate_year for setting the bangla year
		$this->calculate_year();

		//convert english numbers to Bangla
		$this->convert();
	}

	function set_time($timestamp, $hour = 6)
	{
		$this->BanglaDate($timestamp, $hour);
	}

	/*
	 * Calculate the Bangla date and month
	 */
	function calculate_date()
	{
		//when English month is January
		if($this->engMonth == 1)
		{
			if($this->engDate == 1) //Date 1
			{
				
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "পৌষ";
				
			}
			else if($this->engDate < 14 && $this->engDate > 1) // Date 2-13
			{
				
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "পৌষ";
				
					
			}

			else if($this->engDate == 14) //Date 14
			{
				
					$this->bangDate = $this->engDate - 13;
					$this->bangMonth = "মাঘ";
				
			}
			else //Date 15-31
			{
				
					$this->bangDate = $this->engDate - 13;
					$this->bangMonth = "মাঘ";
				
			}
		}


		//when English month is February
		else if($this->engMonth == 2)
		{
			if($this->engDate == 1) //Date 1
			{
				
					$this->bangDate = $this->engDate + 18;
					$this->bangMonth = "মাঘ";
				
			}
			else if($this->engDate < 13 && $this->engDate > 1) // Date 2-12
			{
				
					$this->bangDate = $this->engDate + 18;
					$this->bangMonth = "মাঘ";
				
			}

			else if($this->engDate == 13) //Date 13
			{
				
					$this->bangDate = $this->engDate - 12;
					$this->bangMonth = "ফাল্গুন";
				
			}
			else //Date 15-31
			{
				
					$this->bangDate = $this->engDate - 12;
					$this->bangMonth = "ফাল্গুন";
				
			}
		}

		//when English month is March
		else if($this->engMonth == 3)
		{
			if($this->engDate == 1) //Date 1
			{
				
					if($this->is_leapyear())$this->bangDate = $this->engDate + 17;
					else $this->bangDate = $this->engDate + 16;
					$this->bangMonth = "ফাল্গুন";
				
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-13
			{
				
					if($this->is_leapyear()) $this->bangDate = $this->engDate + 17;
					else $this->bangDate = $this->engDate + 16;
					$this->bangMonth = "ফাল্গুন";
				
			}

			else if($this->engDate == 15) //Date 14
			{
				
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "চৈত্র";
				
			}
			else //Date 15-31
			{
				
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "চৈত্র";
				
			}
		}

		//when English month is April
		else if($this->engMonth == 4)
		{
			if($this->engDate == 1) //Date 1
			{
				
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "চৈত্র";
				
			}
			else if($this->engDate < 14 && $this->engDate > 1) // Date 2-13
			{
				
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "চৈত্র";
				
			}

			else if($this->engDate == 14) //Date 14
			{
				
					$this->bangDate = $this->engDate - 13;
					$this->bangMonth = "বৈশাখ";
				
			}
			else //Date 15-31
			{
				
					$this->bangDate = $this->engDate - 13;
					$this->bangMonth = "বৈশাখ";
				
			}
		}


		//when English month is May
		else if($this->engMonth == 5)
		{
			if($this->engDate == 1) //Date 1
			{
				
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "বৈশাখ";
				
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "বৈশাখ";
				
			}

			else if($this->engDate == 15) //Date 14
			{
				
						$this->bangDate = $this->engDate - 14;
						$this->bangMonth = "জ্যৈষ্ঠ";
					
			}
			else //Date 16-31
			{
				
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "জ্যৈষ্ঠ";
				
			}
		}


		//when English month is June
		else if($this->engMonth == 6)
		{
			if($this->engDate == 1) //Date 1
			{
				
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "জ্যৈষ্ঠ";
				
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				
					$this->bangDate = $this->engDate + 17;
					$this->bangMonth = "জ্যৈষ্ঠ";
				
			}

			else if($this->engDate == 15) //Date 15
			{
				
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "আষাঢ়";
				
			}
			else //Date 15-31
			{
				
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "আষাঢ়";
				
			}
		}


		//when English month is July
		else if($this->engMonth == 7)
		{
			if($this->engDate == 1) //Date 1
			{
				
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "আষাঢ়";
				
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "আষাঢ়";
				
			}

			else if($this->engDate == 16) //Date 16
			{
				
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "শ্রাবণ";
				
			}
			else //Date 17-31
			{
				
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "শ্রাবণ";
				
			}
		}


		//when English month is August
		else if($this->engMonth == 8)
		{
			if($this->engDate == 1) //Date 1
			{
				
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "শ্রাবণ";
				
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "শ্রাবণ";
				
			}

			else if($this->engDate == 16) //Date 16
			{
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "ভাদ্র";
				
			}
			else //Date 15-31
			{
				
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "ভাদ্র";
				
			}
		}


		//when English month is September
		else if($this->engMonth == 9)
		{
			if($this->engDate == 1) //Date 1
			{
				
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "ভাদ্র";
				
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "ভাদ্র";
				
			}

			else if($this->engDate == 16) //Date 14
			{
				
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "আশ্বিন";
				
			}
			else //Date 15-31
			{
				
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "আশ্বিন";
				
			}
		}


		//when English month is October
		else if($this->engMonth == 10)
		{
			if($this->engDate == 1) //Date 1
			{
				
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "আশ্বিন";
				
			}
			else if($this->engDate < 16 && $this->engDate > 1) // Date 2-15
			{
				
					$this->bangDate = $this->engDate + 15;
					$this->bangMonth = "আশ্বিন";
				
			}

			else if($this->engDate == 16) //Date 14
			{
				
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "কার্তিক";
				
			}
			else //Date 17-31
			{
				
					$this->bangDate = $this->engDate - 15;
					$this->bangMonth = "কার্তিক";
				
			}
		}


		//when English month is November
		else if($this->engMonth == 11)
		{
			if($this->engDate == 1) //Date 1
			{
				
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "কার্তিক";
				
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "কার্তিক";
				
			}

			else if($this->engDate == 15) //Date 14
			{
				
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "অগ্রাহায়ণ";
				
			}
			else //Date 15-31
			{
				
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "অগ্রহায়ণ";
				
			}
		}


		//when English month is December
		else if($this->engMonth == 12)
		{
			if($this->engDate == 1) //Date 1
			{
				
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "অগ্রহায়ণ";
				
			}
			else if($this->engDate < 15 && $this->engDate > 1) // Date 2-14
			{
				
					$this->bangDate = $this->engDate + 16;
					$this->bangMonth = "অগ্রহায়ণ";
				
			}

			else if($this->engDate == 15) //Date 14
			{
				
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "পৌষ";
				
			}
			else //Date 15-31
			{
				
					$this->bangDate = $this->engDate - 14;
					$this->bangMonth = "পৌষ";
				
			}
		}
	}

	/*
	 * Checks, if the date is leapyear or not
	 *
	 * @return boolen. True if it's leap year or returns false
	 */
	function is_leapyear()
	{
		if($this->engYear%400 ==0 || ($this->engYear%100 != 0 && $this->engYear%4 == 0))
			return true;
		else
			return false;
	}

	/*
	 * Calculate the Bangla Year
	 */
	function calculate_year()
	{
		if($this->engMonth >= 4)
		{
			if($this->engMonth == 4 && $this->engDate < 14) //1-13 on april when hour is greater than 6
				{
					$this->bangYear = $this->engYear - 594;
				}
			else if($this->engMonth == 4 && $this->engDate == 14 && $this->engHour <=5)
				{
					$this->bangYear = $this->engYear - 593;
				}
			else if($this->engMonth == 4 && $this->engDate == 14 && $this->engHour >=6)
				{
					$this->bangYear = $this->engYear - 593;
				}
			/*else if($this->engMonth == 4 && ($this->engDate == 14 && $this->engDate) && $this->engHour <=5) //1-13 on april when hour is greater than 6
				{
					$this->bangYear = $this->engYear - 593;
				}
				*/
			else
				$this->bangYear = $this->engYear - 593;
		}
		else $this->bangYear = $this->engYear - 594;
		
		//$this->bangYear = $this->engYear - 593; //added by hakim
	}

	function get_year($date)
	{
		$ddate=strtotime($date);
		$enday=date("d",$ddate);
		$enmonth=date("m",$ddate);
		$enyear=date("Y",$ddate);
		
		if($enmonth >= 4)
		{
			if($enmonth == 4 && $enmonth < 14) //1-13 on april when hour is greater than 6
				{
					$enyear = $enyear - 594;
				}
			
			else if($enmonth == 4 && $enmonth == 14 )
				{
					$enyear = $enyear - 593;
				}
			/*else if($this->engMonth == 4 && ($this->engDate == 14 && $this->engDate) && $this->engHour <=5) //1-13 on april when hour is greater than 6
				{
					$this->bangYear = $this->engYear - 593;
				}
				*/
			else
				$enyear = $enyear - 593;
		}
		else $enyear = $enyear - 594;
		
		return $enyear;
	}
	
	
	/*
	 * Convert the English character to Bangla
	 *
	 * @param int any integer number
	 * @return string as converted number to bangla
	 */
	static function bangla_number($int)
	{
		$engNumber = array(1,2,3,4,5,6,7,8,9,0);
		$bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');

		$converted = str_replace($engNumber, $bangNumber, $int);
		return $converted;
	}

	
	static function eng_number($int)
	{
		$engNumber = array(1,2,3,4,5,6,7,8,9,0);
		$bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');

		$converted = str_replace( $bangNumber, $engNumber, $int);
		return $converted;
	}
        
        static function getBnToEnYear($texxt)
	{
		$engNumber = array(1,2,3,4,5,6,7,8,9,0);
		$bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');

		$converted = str_replace( $bangNumber, $engNumber, $texxt);
		return $converted;
	}
        
	/*
	 * Convert the English bunmer to Bangla
	 *
	 * @param string any number
	 * @return string as converted number to bangla
	 */
	static function t($value, $date=false, $concat=true)
	{
		if(Yii::app()->language == 'bn'){
			if($date)
			{
				$bndate = new Bndate(strtotime($value));
				$value = $bndate->get_date();
				if($concat)
				{
					$value = $value[0].' '.$value[1].' '.$value[2];
				}
			}
			else
			{
				$engNumber = array(1,2,3,4,5,6,7,8,9,0,'AM','PM');
				$bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','পূ:','অপ:');
				$value = str_replace($engNumber, $bangNumber, $value);
			}
		}
		return $value;
	}

	/*
	 * Calls the converter to convert numbers to equivalent Bangla number
	 */
	function convert()
	{
		$this->bangDate = $this->bangla_number($this->bangDate);
		$this->bangYear = $this->bangla_number($this->bangYear);
	}

	/*
	 * Returns the calculated Bangla Date
	 *
	 * @return array of converted Bangla Date
	 */
	function get_date()
	{
		return array($this->bangDate, $this->bangMonth, $this->bangYear);
	}

	static function BanglaWeekDay ($text) {
	$text = str_replace('Saturday', 'শনিবার', $text);
		$text = str_replace('Sunday', 'রবিবার', $text);
		$text = str_replace('Monday', 'সোমবার', $text);
		$text = str_replace('Tuesday', 'মঙ্গলবার', $text);
		$text = str_replace('Wednesday', 'বুধবার', $text);
		$text = str_replace('Thursday', 'বৃহস্পতিবার', $text);
		$text = str_replace('Friday', 'শুক্রবার', $text);
		return $text;
	}
		
	static function BanglaNumDate ($text) {
		$text = str_replace('1', '১', $text);
		$text = str_replace('2', '২', $text);
		$text = str_replace('3', '৩', $text);
		$text = str_replace('4', '৪', $text);
		$text = str_replace('5', '৫', $text);
		$text = str_replace('6', '৬', $text);
		$text = str_replace('7', '৭', $text);
		$text = str_replace('8', '৮', $text);
		$text = str_replace('9', '৯', $text);
		$text = str_replace('0', '০', $text);

		$text = str_replace('th', '-এ', $text);
		$text = str_replace('st', '-এ', $text);
		$text = str_replace('rd', '-এ', $text);
		$text = str_replace('th', '-এ', $text);

		$text = str_replace('January', 'জানুয়ারি', $text);
		$text = str_replace('February', 'ফেব্রুয়ারি', $text);
		$text = str_replace('March', 'মার্চ', $text);
		$text = str_replace('April', 'এপ্রিল', $text);
		$text = str_replace('May', 'মে', $text);
		$text = str_replace('June', 'জুন', $text);
		$text = str_replace('July', 'জুলাই', $text);
		$text = str_replace('August', 'অগাস্ট', $text);
		$text = str_replace('September', 'সেপ্টেম্বর', $text);
		$text = str_replace('October', 'অক্টোবর', $text);
		$text = str_replace('November', 'নভেম্বর', $text);
		$text = str_replace('December', 'ডিসেম্বর', $text);

		$text = str_replace('Jan', 'জানুয়ারি', $text);
		$text = str_replace('Feb', 'ফেব্রুয়ারি', $text);
		$text = str_replace('Mar', 'মার্চ', $text);
		$text = str_replace('Apr', 'এপ্রিল', $text);
		$text = str_replace('May', 'মে', $text);
		$text = str_replace('Jun', 'জুন', $text);
		$text = str_replace('Jul', 'জুলাই', $text);
		$text = str_replace('Aug', 'অগাস্ট', $text);
		$text = str_replace('Sep', 'সেপ্টেম্বর', $text);
		$text = str_replace('Oct', 'অক্টোবর', $text);
		$text = str_replace('Nov', 'নভেম্বর', $text);
		$text = str_replace('Dec', 'ডিসেম্বর', $text);

		$text = str_replace('Saturday', 'শনিবার', $text);
		$text = str_replace('Sunday', 'রবিবার', $text);
		$text = str_replace('Monday', 'সোমবার', $text);
		$text = str_replace('Tuesday', 'মঙ্গলবার', $text);
		$text = str_replace('Wednesday', 'বুধবার', $text);
		$text = str_replace('Thursday', 'বৃহস্পতিবার', $text);
		$text = str_replace('Friday', 'শুক্রবার', $text);

		$text = str_replace('Sat', 'শনি', $text);
		$text = str_replace('Sun', 'রবি', $text);
		$text = str_replace('Mon', 'সোম', $text);
		$text = str_replace('Tue', 'মঙ্গল', $text);
		$text = str_replace('Tues', 'মঙ্গল', $text);
		$text = str_replace('Wed', 'বুধ', $text);
		$text = str_replace('Thurs', 'বৃহস্পতি', $text);
		$text = str_replace('Thu', 'বৃহস্পতি', $text);
		$text = str_replace('Fri', 'শুক্র', $text);

		$text = str_replace('Boishakh', 'বৈশাখ', $text);
		$text = str_replace('Joishtho', 'জ্যৈষ্ঠ', $text);
		$text = str_replace('Ashar', 'আষাঢ়', $text);
		$text = str_replace('Srabon', 'শ্রাবণ', $text);
		$text = str_replace('Bhadro', 'ভাদ্র', $text);
		$text = str_replace('Ashin', 'আশ্বিন', $text);
		$text = str_replace('Kartrik','কার্তিক', $text);
		$text = str_replace('Agrohayon','অগ্রহায়ণ', $text);
		$text = str_replace('Poush', 'পৌষ', $text);
		$text = str_replace('Magh', 'মাঘ', $text);
		$text = str_replace('Falgun', 'ফাল্গুন ', $text);
		$text = str_replace('Chaitro', 'চৈত্র', $text);

		return $text;
	}
	
	static function BanglaNumMonth ($text) {
		
		$text = str_replace('10', 'মাঘ', $text);
		$text = str_replace('11', 'ফাল্গুন ', $text);
		$text = str_replace('12', 'চৈত্র', $text);
		$text = str_replace('1', 'বৈশাখ', $text);
		$text = str_replace('2', 'জ্যৈষ্ঠ', $text);
		$text = str_replace('3', 'আষাঢ়', $text);
		$text = str_replace('4', 'শ্রাবণ', $text);
		$text = str_replace('5', 'ভাদ্র', $text);
		$text = str_replace('6', 'আশ্বিন', $text);
		$text = str_replace('7','কার্তিক', $text);
		$text = str_replace('8','অগ্রহায়ণ', $text);
		$text = str_replace('9', 'পৌষ', $text);
		
		

		return $text;
	}
	
	static function BanglaNumMonthArray () {
		
		$text= array();
		
		$text[12]='চৈত্র';
		$text[1]='বৈশাখ';
		$text[2]='জ্যৈষ্ঠ';
		$text[3]='আষাঢ়';
		$text[4]='শ্রাবণ';
		$text[5]='ভাদ্র';
		$text[6]='আশ্বিন';
		$text[7]='কার্তিক';
		$text[8]='অগ্রহায়ণ';
		$text[9]='পৌষ';
		$text[10]='মাঘ';
		$text[11]='ফাল্গুন';
		

		return $text;
	}
        
        function BanglaNumMonth2 () {
		
               $text=$this->bangMonth;
		$text = str_replace( 'বৈশাখ','1', $text);
		$text = str_replace( 'জ্যৈষ্ঠ','2', $text);
		$text = str_replace( 'আষাঢ়','3', $text);
		$text = str_replace( 'শ্রাবণ', '4',$text);
		$text = str_replace( 'ভাদ্র','5', $text);
		$text = str_replace( 'আশ্বিন','6', $text);
		$text = str_replace('কার্তিক','7', $text);
		$text = str_replace('অগ্রহায়ণ','8', $text);
		$text = str_replace( 'পৌষ','9', $text);
		$text = str_replace( 'মাঘ','10', $text);
		$text = str_replace( 'ফাল্গুন','11', $text);
		$text = str_replace( 'চৈত্র','12', $text);
                
                
               

		return $text;
	}
        
        
	/*
	 * Convert the English character to Bangla for Prayers time
	 *
	 * @param string
	 * @return string as converted english to bangla
	 */
	function banglaPTime($string)
	{
		$engNumber = array(1,2,3,4,5,6,7,8,9,0);
		$bangNumber = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');

		$ptime = explode(':', $string);
		$converted_1 = str_replace($engNumber, $bangNumber, $ptime[0]);
		$converted_2 = str_replace($engNumber, $bangNumber, $ptime[1]);
		return $converted_1 . ':' . $converted_2;
	}

}
/* End of file Bndate.php */