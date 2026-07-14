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

function search_by_states($str)
{
	global $states;
	global $capitals;

	$state = null;
	$capital = null;

	$array = explode(", ", $str);
	foreach ($array as $element)
	{
		if (array_key_exists($element, $states) === true && array_key_exists($states[$element], $capitals) === true)
		{
			$state = $element;
			$capital = $capitals[$states[$element]];
		}
		elseif (in_array($element, $capitals) === true && in_array(array_search($element, $capitals), $states) === true)
		{
			$state = array_search(array_search($element, $capitals), $states);
			$capital = $element;
		}
		else
		{
			echo "$element is neither a capital nor a state." . PHP_EOL;
			continue ;
		}

		echo "$capital is the capital of $state." . PHP_EOL;
	}
}

?>
