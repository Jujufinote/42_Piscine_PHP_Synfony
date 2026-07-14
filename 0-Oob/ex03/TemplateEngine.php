<?php

require_once "Elem.php";

class TemplateEngine
{
	private Elem $elem;

	public function __construct(Elem $elem)
	{
		$this->elem = $elem;
	}

	public function createFile(string $fileName)
	{
		$fd = fopen($fileName, "w");
		fwrite($fd, $this->elem->getHTML());
		fclose($fd);
	}
}

?>
