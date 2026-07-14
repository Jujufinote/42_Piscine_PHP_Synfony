<?php

require_once "HotBeverage.php";

class Tea extends HotBeverage
{
	private $description;
	private $comment;

	public function __construct()
	{
		$this->name = "Tea";
		$this->price = 4;
		$this->resistence = 1;
		$this->description = "This tea helps to sleep, for my insomniac friends ;)";
		$this->comment = "Don't really like the taste but i slept under 2min after i finished 'til the last drop";
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getComment()
	{
		return $this->comment;
	}
}

?>
