<?php

require_once 'TemplateEngine.php';

$template = new TemplateEngine();

$parameters = [
	"nom" => "Les expériences de KakouKakou",
	"auteur" => "AkouAkou",
	"description" => "Ce livre est une extrême daube finie",
	"prix" => "10 000"
];

$template->createFile("result.html", "book_description.html", $parameters);

?>
