<?php

class MonthlyCalendar extends CWidget {

	public $roomNo;
	public $date;
	public $startTime;
	public $endTime;
	private $events = null;

	public function init() {
		$calendar = new Calendar('search');
		$calendar->unsetAttributes();
		$calendar->calendar_ref_room_no = $this->roomNo;
		$calendar->calendar_start_time = $this->startTime;
		$calendar->calendar_end_time = $this->endTime;
		$calendar->calendar_date = date('Y-m', strtotime($this->date));
		$this->events = Calendar::model()->findAll($calendar->getCriteria());
	}

	/* draws a calendar */

	private function buildCalendar() {
		$tempDate = explode('-', $this->date);
		$year = $tempDate[0];
		$month = $tempDate[1];

		/* draw table */
		$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

		/* table headings */
		$headings = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
		$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td><td class="calendar-day-head">', $headings) . '</td></tr>';

		/* days and weeks vars now ... */
		$running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
		$days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
		$days_in_this_week = 1;
		$day_counter = 0;
		$dates_array = array();

		/* row for week one */
		$calendar.= '<tr class="calendar-row">';

		/* print "blank" days until the first of the current week */
		for ($x = 0; $x < $running_day; $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
			$days_in_this_week++;
		endfor;

		/* keep going with days.... */
		for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
			$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">' . $list_day . '</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! * */
			foreach ($this->events as $event) {
				/* @var $event Calendar */
				if (date('j', strtotime($event->calendar_date)) == $list_day) {
					$divClass = $event->isAvailable() ? "alert-success" : "alert-error";

					$calendar.= "<div class='alert $divClass'>" . CHtml::link("$event->calendar_title ($event->calendar_start_time-$event->calendar_end_time)",
							array('calendar/view', 'id' => $event->calendar_pk), array(
										'onclick'=>'loadWithAjax(this); return false',
									)) . "<br />
						<em>" . CHtml::link('update',
							array('calendar/update', 'id' => $event->calendar_pk), array(
										'onclick'=>'updateWithAjax(this); return false',
									)) .
						"</em>
					</div>";
				}
			}

			$calendar.= '</td>';
			if ($running_day == 6):
				$calendar.= '</tr>';
				if (($day_counter + 1) != $days_in_month):
					$calendar.= '<tr class="calendar-row">';
				endif;
				$running_day = -1;
				$days_in_this_week = 0;
			endif;
			$days_in_this_week++;
			$running_day++;
			$day_counter++;
		endfor;

		/* finish the rest of the days in the week */
		if ($days_in_this_week < 8):
			for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
				$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
			endfor;
		endif;

		/* final row */
		$calendar.= '</tr>';

		/* end the table */
		$calendar.= '</table>';

		/* all done, return result */
		return $calendar;
	}

	public function run() {
		$months = array(
			'pre_month_name' => date('F, Y', strtotime($this->date) - 10 * 24 * 60 * 60),
			'pre_month_value' => date('Y-m', strtotime($this->date) - 10 * 24 * 60 * 60),
			'cur_month_name' => date('F, Y', strtotime($this->date)),
			'cur_month_value' => $this->date,
			'next_month_name' => date('F, Y', strtotime($this->date) + 40 * 24 * 60 * 60),
			'next_month_value' => date('Y-m', strtotime($this->date) + 40 * 24 * 60 * 60),
		);

		$calendar = $this->buildCalendar();

		$this->render('monthlyCalendar', array('months' => $months, 'calendar' => $calendar));
	}

}