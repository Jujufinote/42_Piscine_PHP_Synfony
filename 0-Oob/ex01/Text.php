<?php

class Text
{
	private $data = [];

	public function __construct(array $data)
	{
		$this->data = $data;
	}

	public function append($str)
	{
		$this->data[] = $str;
	}

	public function readData() : array
	{
		$temp = [];

		foreach ($this->data as $str)
		{
			$temp[] = "<p>" . $str . "</p>";
		}

		return $temp;
	}
}

?>
