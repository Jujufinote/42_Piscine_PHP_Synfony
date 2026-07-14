<?php

class TemplateEngine
{
	public function createFile(string $fileName, string $templateName, array $parameters)
	{
		$string_file = file_get_contents($templateName);

		$table = preg_split(
			"/\{(.*?)\}/",
			$string_file,
			-1,
			PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY
		);

		for ($i = 0; $i < count($table); $i++)
		{
			if ($i % 2 === 1)
			{
				if (array_key_exists($table[$i], $parameters) === true)
					$table[$i] = $parameters[$table[$i]];
				else
					$table[$i] = "Unknown";
			}
		}

		$string_file = implode("", $table);

		$fd = fopen($fileName, "w");
		fwrite($fd, $string_file);
		fclose($fd);
	}
}

?>
