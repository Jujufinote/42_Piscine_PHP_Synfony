<?php

require_once 'TemplateEngine.php';
require_once 'Coffee.php';
require_once 'Tea.php';

$template = new TemplateEngine();

$coffee = new Coffee();
$tea = new Tea();

$template->createFile($coffee);
$template->createFile($tea);

?>
