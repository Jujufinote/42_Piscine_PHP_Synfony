<?php

require_once "MyException.php";

class Elem
{
	static private $alone_tag = ["meta", "img", "hr", "br"];
	static private $large_tag = ["html", "head", "body", "div", "table", "tr", "th", "td", "ul", "ol"];
	static private $normal_tag = ["title", "h1", "h2", "h3", "h4", "h5", "h6", "p", "span", "li"];

	private string $element;
	private string|null $content;
	private array|null $attributes;
	private array $children = [];

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

		$this->children[] = $child_element;
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
			// ternary because we dont want empty lines with tabs
		else if (in_array($this->element, Elem::$normal_tag))
			$html = "<". $this->element . $tmp_attributes . ">" . $tmp_content . "</" . $this->element . ">";
		
		return ($html);
	}

	public function __getElement() : string
	{
		return $this->element;
	}

	public function __getAttributes() : array|null
	{
		return $this->attributes;
	}

	public function __getChildren() : array
	{
		return $this->children;
	}

	public function validPage() : bool
	{
		$names = [];
		foreach ($this->children as $child)
		{
			$names[] = $child->__getElement();
		}

		if ($this->__getElement() === "html"
		&& (count($names) !== 2 
		|| in_array("body", $names) === false || in_array("head", $names) === false))
		{
			return false;
		}
		if ($this->__getElement() === "head")
		{
			if (in_array("meta", $names) === true && array_count_values($names)["meta"] > 1)
			{
				$cnt = 0;
				foreach ($this->children as $child)
				{
					if ($child->__getElement() === "meta" && $child->__getAttributes() !== null && array_key_exists("charset", $child->__getAttributes()))
						$cnt++;
				}
				if ($cnt > 1)
					return false;
			}
			elseif (in_array("title", $names) === true && array_count_values($names)["title"] > 1)
				return false;
		}
		if ($this->__getElement() === "p" && count($names) !== 0)
		{
			return false;
		}
		if ($this->__getElement() === "table"
			&& ((in_array("tr", $names) === true && array_count_values($names)["tr"] !== count($names))
			|| (in_array("tr", $names) === false && count($names) > 0)))
		{
			return false;
		}
		if ($this->__getElement() === "tr")
		{
			$nb_td = 0;
			$nb_th = 0;
			if (in_array("td", $names) === true)
				$nb_td = array_count_values($names)["td"];
			if (in_array("th", $names) === true)
				$nb_th = array_count_values($names)["th"];
			if ($nb_td + $nb_th !== count($names))
				return false;
		}
		if (($this->__getElement() === "ul" || $this->__getElement() === "ol") 
			&& ((in_array("li", $names) === true && array_count_values($names)["li"] !== count($names))
			|| (in_array("li", $names) === false && count($names) > 0)))
		{
			return false;
		}

		foreach ($this->children as $child)
		{
			if ($child->validPage() === false)
				return false;
		}

		return true;
	}
}

?>
