/* German initialisation for the jQuery UI date picker plugin. */
/* Written by Milian Wolff (mail@milianw.de). */

$.datepicker.regional['bn'] = {
    closeText: 'সম্পূর্ণ',
    prevText: 'পূর্ববর্তী',
    nextText: 'পরবর্তী',
    currentText: 'বর্তমান',
    monthNames: ['জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন',
    'জুলাই','আগস্ট','সেপ্টেম্বর','অক্টবর','নভেম্বর','ডিসেম্বর'],
    monthNamesShort: ['জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন',
    'জুলাই','আগস্ট','সেপ্টেম্বর','অক্টবর','নভেম্বর','ডিসেম্বর'],
    dayNames: ['রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহ:বার','শুক্রবার','শনিবার'],
    dayNamesShort: ['রবি','সোম','মঙ্গল','বুধ','বৃহ','শুক্র','শনি'],
    dayNamesMin: ['রবি','সোম','মঙ্গল','বুধ','বৃহ','শুক্র','শনি'],
    weekHeader: 'Wo',
    dateFormat: 'dd-mm-yy',
    timeFormat: 'hh:mm:ss',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''};

$.timepicker.regional['bn'] = {
    timeOnlyTitle: 'সময়',
    timeText: 'সময়',
    hourText: 'ঘন্টা',
    minuteText: 'মিনিট',
    secondText: 'সেকেন্ড',
    currentText: 'বর্তমান',
    closeText: 'সম্পূর্ণ',
    ampm: false
};

$.datepicker.setDefaults($.datepicker.regional['bn']);
$.timepicker.setDefaults($.timepicker.regional['bn']);
