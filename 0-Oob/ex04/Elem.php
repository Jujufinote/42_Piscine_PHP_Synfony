<?php

require_once "MyException.php";

class Elem
{
	static private $alone_tag = ["meta", "img", "hr", "br"];
	static private $large_tag = ["html", "head", "body", "div", "table", "tr", "th", "td", "ul", "ol"];
	static private $normal_tag = ["title", "h1", "h2", "h3", "h4", "h5", "h6", "p", "span", "li"];

	private $element;
	private $content;
	private $attributes;

	public function __construct(string $element, string|null $content = null, array|null $attributes = null)
	{
		if (in_array($element, Elem::$alone_tag) === false && in_array($element, Elem::$normal_tag) === false && in_array($element, Elem::$large_tag) === false)
			throw new MyException("Element " . $element . " not supported");

		$this->element = $element;
		$this->content = $content ? htmlspecialchars($content) : null; // ternary because function always return a string not null
		$this->attributes = $attributes;
	}

	public function pushElement(Elem $child_element)
	{
		if ($this->content === null)
			$this->content = $child_element->getHTML();
		else
			$this->content .= PHP_EOL . $child_element->getHTML();
	}

	public function getHTML() : string
	{
		$tmp_content = str_replace(PHP_EOL, PHP_EOL . "\t", $this->content);

		$tmp_attributes = null;
		if ($this->attributes !== null)
		{
			foreach ($this->attributes as $key => $value)
			{
				$tmp_attributes .= " " . $key . "=" . "\"" . $value ."\"";
			}
		}

		if (in_array($this->element, Elem::$alone_tag))
			$html = "<" . $this->element . $tmp_attributes .">";
		else if (in_array($this->element, Elem::$large_tag))
			$html = "<". $this->element . $tmp_attributes . ">" . PHP_EOL . ($tmp_content ? ("\t" . $tmp_content . PHP_EOL) : null) . "</" . $this->element . ">";
		else if (in_array($this->element, Elem::$normal_tag))
			$html = "<". $this->element . $tmp_attributes . ">" . $tmp_content . "</" . $this->element . ">";
		
		return ($html);
	}
}

?>
