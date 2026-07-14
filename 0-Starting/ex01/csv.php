<?php

$fd = fopen("ex01.txt", 'r');

if ($fd)
{
	while ($array = fgetcsv($fd, 0, ','))
	{
		foreach ($array as $element)
		{
			echo $element . PHP_EOL;
		}
		echo PHP_EOL;
	}
	fclose($fd);
}

?>
