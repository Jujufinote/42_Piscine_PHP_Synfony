<?php

function array2hash_sorted($array)
{
	$new = [];
	foreach ($array as $element)
	{
		$new[$element[0]] = $element[1];
	}

	krsort($new);
	return $new;
}

?>