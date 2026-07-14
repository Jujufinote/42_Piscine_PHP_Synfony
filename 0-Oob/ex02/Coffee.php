<?php

require_once "HotBeverage.php";

class Coffee extends HotBeverage
{
	private $description;
	private $comment;

	public function __construct()
	{
		$this->name = "Coffee";
		$this->price = 2;
		$this->resistence = 4;
		$this->description = "Comfort beverage for many people, but to consume at least 2h before bed";
		$this->comment = "I love this coffee, it makes me nostalgic";
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
