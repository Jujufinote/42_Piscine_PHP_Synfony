<?php

function array2hash($array)
{
	$new = [];
	foreach ($array as $element)
	{
		$new[$element[1]] = $element[0];
	}

	return $new;
}

?>