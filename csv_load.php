<?php
// *********** 
// WARNING: You probably shouldn't leave this file unprotected on your live server after you've used it,
//  though if you remove your source data file it possibly can't harm
// ***********

/* Loads table from CSV file into this kind of structure:

CREATE TABLE {$db_settings['tables']['hours']} (
  id int(11) NOT NULL AUTO_INCREMENT, -- can be dropped, but is handy for debugging
  day date NOT NULL,
  opens datetime DEFAULT NULL,
  closes datetime DEFAULT NULL,
  PRIMARY KEY (id), -- droppable, see above
  UNIQUE KEY day_UNIQUE (day)
)

-- id field can be dropped, but is handy for debugging

** 	If you want to migrate data from your old calendar from Andrew Darby's Google Calendar tool (on which this tool was derived),
	there is some SQL in lib/config/database.php.

*/

require('lib/app.php');

if (DEBUG) error_reporting(E_ERROR);

putenv("TZ=$timezone");

$first_date = mktime(0, 0, 0); // we actually need to set it to midnight
$last_date = add_date($first_date, 0, $populate_months);

//TODO: better to select a file in browser form and load it
$calendar = load_csv_array($data_file, $first_date, $last_date);
// pretty_print_r($calendar, TRUE, '$calendar');

if (is_null($calendar)) {

	print "<p><strong>Error:</strong> Unable to load calendar data from $data_file.</p>";
	}
	else {

	$SQL[] = "DELETE FROM {$db_settings['tables']['hours']} WHERE day >= CURDATE();";

	foreach ($calendar as $day => $times) {
		$SQL[] = $times->save($day, TRUE);
	}

	runSQL($SQL);
	
	print "<p><a href=\"./\">Calendar data loaded</a> from $data_file.</p>";
}

/* **********************************************************
Functions
********************************************************** */

function load_csv_array($location, $from, $to) {
	if (($handle = fopen($location, 'r')) === FALSE) {
		return NULL;
	}
	
	// otherwise
	$header_row = fgetcsv($handle);
	if ($header_row === FALSE) {
		return array();
	}

	$data = array();
	$start_field_position = array_search('Period start', $header_row);
		
	$end_field_position = array_search('Period end', $header_row);
	if ($start_field_position === FALSE) {
		cease_to_exist("Unable to find CSV column heading 'Period start', quitting.");
	}
	if ($end_field_position === FALSE) {
		cease_to_exist("Unable to find CSV column heading 'Period end', quitting.");
	}
	
	$date_pattern = '/^\d{4}(-\d{2}){2}$/'; // dates loaded should conform to this
	while (($row = fgetcsv($handle)) !== FALSE) {
		// these vars are just set for readability
		$start_date = $row[$start_field_position];
		$end_date = $row[$end_field_position];
		if ( !preg_match($date_pattern, $start_date) ) {
			cease_to_exist("Start date value '$start_date' from $location is not in YYYY-mm-dd format, please correct and retry. No data loaded, quitting.");
		}
		elseif ( !(empty($end_date) or preg_match($date_pattern, $end_date)) ) {
			cease_to_exist("End date value '$end_date' from $location is not in YYYY-mm-dd format, please correct and retry. No data loaded, quitting.");
		}
		elseif ( ($start_date >= date('Y-m-d', $from) and $start_date <= date('Y-m-d', $to))
				or ($end_date >= date('Y-m-d', $from) and $end_date <= date('Y-m-d', $to)) ) {
			$data = array_merge($data, createOperatingDays(array_combine($header_row, $row)));
		}
	}

	fclose($handle);
	return $data;
}
