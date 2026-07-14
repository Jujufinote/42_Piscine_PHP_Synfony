<?php

require_once "Text.php";

class TemplateEngine
{
	public function createFile(string $fileName, Text $text)
	{
		$html = 
"<!DOCTYPE html>
<html>
	<head>
		<title>Ex01</title>
	</head>
	<body>
		<h1>Ex01</h1>\n";

		$string_array = $text->readData();
		foreach ($string_array as $str)
		{
			$html .= "		$str\n";
		}

		$html .= 
"	</body>
</html>\n";

		$fd = fopen($fileName, "w");
		fwrite($fd, $html);
		fclose($fd);
	}
}

?>
