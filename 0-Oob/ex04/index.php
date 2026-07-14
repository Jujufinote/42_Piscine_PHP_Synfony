<?php

require_once 'MyException.php';
require_once 'TemplateEngine.php';
require_once 'Elem.php';

try {

	$elem = new Elem('html');
	$body = new Elem('body');
	$body->pushElement(new Elem('p', 'Lorem ipsum', ['class' => 'text-muted']));
	$elem->pushElement($body);

	$template = new TemplateEngine($elem);

	$template->createFile("test.html");

	$elem = new Elem('undefined');

} catch(MyException $e) {

	echo 'Error: ' . $e->getMessage() . PHP_EOL;

}

?>
