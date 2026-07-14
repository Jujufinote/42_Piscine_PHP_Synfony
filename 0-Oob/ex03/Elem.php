<?php

class Elem
{
	static private $alone_tag = ["meta", "img", "hr", "br"];
	static private $large_tag = ["html", "head", "body"];

	private $element;
	private $content;

	public function __construct(string $element, string|null $content = null)
	{
		$this->element = $element;
		$this->content = $content ? htmlspecialchars($content) : null; // ternary because function always return a string not null
	}

	public function pushElement(Elem $child_element)
	{
		$this->content .= $child_element->getHTML();
	}

	public function getHTML() : string
	{
		$tmp_content = str_replace(PHP_EOL, PHP_EOL . "\t", $this->content);

		if (in_array($this->element, Elem::$alone_tag))
			$html = "<" . $this->element .">";
		else if (in_array($this->element, Elem::$large_tag))
			$html = "<". $this->element . ">" . PHP_EOL . ($tmp_content ? ("\t" . $tmp_content . PHP_EOL) : null) . "</" . $this->element . ">";
		else
			$html = "<". $this->element . ">" . $tmp_content. "</". $this->element . ">";
		
		return ($html);
	}
}

?>
