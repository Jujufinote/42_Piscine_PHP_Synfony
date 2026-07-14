<?php

require_once "HotBeverage.php";

class TemplateEngine
{
	public function createFile(HotBeverage $text, string $template = "template.html")
	{
		$string_file = file_get_contents($template);
		// in the given template.html, a vraiable to replace is named "nom" insted of "name"

		$table = preg_split(
			"/\{(.*?)\}/",
			$string_file,
			-1,
			PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY
		);


        $reflexion = new ReflectionClass($text);
        for ($i = 0; $i < count($table); $i++)
        {
            if ($i % 2 === 1)
            {
                $method = "get" . ucfirst($table[$i]);
                if ($reflexion->hasMethod($method))
                    $table[$i] = $reflexion->getMethod($method)->invoke($text);
                else
                    $table[$i] = "Unknown";
            }
        }

		$string_file = implode("", $table);

		$fd = fopen($reflexion->getShortName() . ".html", "w");
		fwrite($fd, $string_file);
		fclose($fd);
	}
}

?>
