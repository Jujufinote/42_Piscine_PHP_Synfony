<?php

$states = [
	'Oregon' => 'OR',
	'Alabama' => 'AL',
	'New Jersey' => 'NJ',
	'Colorado' => 'CO',
];

$capitals = [
	'OR' => 'Salem',
	'AL' => 'Montgomery',
	'NJ' => 'trenton',
	'KS' => 'Topeka',
];

function capital_city_from($name)
{
	global $states;
	global $capitals;

	if (array_key_exists($name, $states) === true && array_key_exists($states[$name], $capitals) === true)
		return ($capitals[$states[$name]] . PHP_EOL);
	return ("Unknown" . PHP_EOL);
}

?>
