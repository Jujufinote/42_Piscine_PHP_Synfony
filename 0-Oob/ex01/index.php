<?php

require_once 'TemplateEngine.php';

$template = new TemplateEngine();

$text = new Text(["Première phrase"]);

$text->append("Deuxième phrase");

$template->createFile("result.html", $text);

?>
