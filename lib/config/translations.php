﻿<?php

$languages = array('en', 'mi');

$translatable_text = array_merge(
	$monthNames_en,
	$dayNames_en,
	array(
		'Closed',
		'Library Hours of Opening',
		'Opening Hours',
		'Library, Teaching and Learning',
		)
	);

// **** English ****
$language_settings['en'] = array(
	'timeFormat' => 'g[:i]a',
	);
	
// **** Māori (Ngāi Tahu dialect) ****
$translations['mi'] = array(
	'January' => 'Kohi-t&#257;tea / H&#257;nuere',
	'February' =>  'Hui-ta<u>k</u>uru / P&#275;puere',
	'March' => 'Pout&#363;-te-ra<u>k</u>i / M&#257;ehe',
	'April' => 'Pae<u>k</u>a-wh&#257;wh&#257; / &#256;perira',
	'May' => 'Haratua / Mei',
	'June' => 'Pipiri / Hune',
	'July' => 'H&#333;<u>k</u>o<u>k</u>oi / H&#363;rae',
	'August' => 'Here-turi-k&#333;k&#257; / &#256;kuhata',
	'September' => 'Mahuru / Hepetema',
	'October' => 'Whiri<u>k</u>a-&#257;-nuku / Oketopa',
	'November' => 'Whiri<u>k</u>a-&#257;-ra<u>k</u>i / Noema',
	'December' => 'Hakihea / T&#299;hema',
	'Monday' => 'R&#257;hina / Mane',
	'Tuesday' => 'R&#257;t&#363; / Turei',
	'Wednesday' => 'R&#257;apa / Wenerei',
	'Thursday' => 'R&#257;pare / Taite',
	'Friday' => 'R&#257;mere / Paraire',
	'Saturday' => 'R&#257;horoi',
	'Sunday' => 'R&#257;tapu',
	'Closed' => 'Kua kati',
	'Library Hours of Opening' => 'K&#257; W&#257; Puare o te Wharep&#363;r&#257;kau',
	'Opening Hours' => 'K&#257; W&#257; Puare',
	'Library, Teaching and Learning' => 'Te Wharep&#363;r&#257;kau',
	);

$language_settings['mi'] = array(
	'timeFormat' => array(
		0 => 'g[:i] (\a\t\a)',
		12 => 'g[:i] (\a\h\i\a\h\i)',
		18 => 'g[:i] (\p&#333;)',
		'fallback' => 'g[:i]',
		),
	);

// **** German ****
$translations['de'] = array(
	'January' => 'Januar',
	'February' =>  'Februar',
	'March' => 'März',
	'April' => 'April',
	'May' => 'Mai',
	'June' => 'Juni',
	'July' => 'Juli',
	'August' => 'August',
	'September' => 'September',
	'October' => 'Oktober',
	'November' => 'November',
	'December' => 'Dezember',
	'Monday' => 'Montag',
	'Tuesday' => 'Dienstag',
	'Wednesday' => 'Mittwoch',
	'Thursday' => 'Donnerstag',
	'Friday' => 'Freitag',
	'Saturday' => 'Samstag',
	'Sunday' => 'Sonntag',
	'Closed' => 'geschlossen',
	'Library Hours of Opening' => 'Öffnungszeiten der Bibliothek',
	'Opening Hours' => 'Öffnungszeiten',
	'Library, Teaching and Learning' => 'Bibliothek, Lehren und Lernen',
	); # thanks/blames to Google translate (http://translate.google.com) for some of these last phrases

$language_settings['de'] = array(
	'timeFormat' => 'G.i',
	);