<?php

require_once 'TemplateEngine.php';
require_once 'Elem.php';

$elem = new Elem('html');
$body = new Elem('body');
$body->pushElement(new Elem('p', 'Lorem ipsum'));
$elem->pushElement($body);

$template = new TemplateEngine($elem);

$template->createFile("test.html");

?>
