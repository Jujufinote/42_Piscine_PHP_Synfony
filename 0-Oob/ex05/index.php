<?php

require_once 'MyException.php';
require_once 'TemplateEngine.php';
require_once 'Elem.php';

try {

/*----------------------------------------------*/
/*-------------------- INIT --------------------*/
/*----------------------------------------------*/

	// $elem = new Elem('undefined');

	$elem = new Elem('html');

	$head = new Elem('head');
	$body = new Elem('body');

	$title = new Elem('title');
	$meta = new Elem('meta', null, ['charset'=> 'ex']);

	$p = new Elem('p', 'Lorem ipsum', ['class' => 'text-muted']);
	$p2 = new Elem('p', '<a>Lorem ipsum</a>', ['class' => 'text-muted']);

	$table = new Elem('table', null , ['style'=> 'border-collapse: collapse;']);
	$tr = new Elem('tr');
	$th = new Elem('th', null, ['style'=> 'border: 1px solid black']);
	$td = new Elem('td', null, ['style'=> 'border: 1px solid black']);
	
	$ol = new Elem('ol');
	$ul = new Elem('ul');
	$li = new Elem('li');


/*----------------------------------------------*/
/*-------------------- TEST --------------------*/
/*----------------------------------------------*/

// no other than li in ul or ol

	// $ol->pushElement($p);
	$ol->pushElement($li);
	$ol->pushElement($li);
	
	if ($ol->validPage() === false)
		throw new MyException("Invalid page : ol");

	// $ul->pushElement($p);
	$ul->pushElement($li);
	$ul->pushElement($li);
	
	if ($ul->validPage() === false)
		throw new MyException("Invalid page : ul");

// no problem here

	$td->pushElement($ul);
	$th->pushElement($ol);
	
	if ($td->validPage() === false)
		throw new MyException("Invalid page : td");
	
	if ($th->validPage() === false)
		throw new MyException("Invalid page : th");

// no other than th or td in tr

	// $tr->pushElement($p);
	$tr->pushElement($th);
	$tr->pushElement($th);
	$tr->pushElement($td);
	$tr->pushElement($td);
	
	if ($tr->validPage() === false)
		throw new MyException("Invalid page : tr");

// no other than tr in table

	// $table->pushElement($p);
	$table->pushElement($tr);
	$table->pushElement($tr);
	
	if ($table->validPage() === false)
		throw new MyException("Invalid page : table");

// no other element in p

	// $p->pushElement($p);
	
	if ($p->validPage() === false)
		throw new MyException("Invalid page : p");

// example of html in body (not really a parsing test)

	$body->pushElement($p);
	$body->pushElement($table);
	
	if ($body->validPage() === false)
		throw new MyException("Invalid page : body");

// not more than one title and more than one meta charset in head

	// $head->pushElement($title);
	$head->pushElement($title);
	$head->pushElement($meta);
	// $head->pushElement($meta);
	
	if ($head->validPage() === false)
		throw new MyException("Invalid page : head");

// not more nor less than one head and one body in html

	$elem->pushElement($head);
	// $elem->pushElement($head);
	// $elem->pushElement($body);
	$elem->pushElement($body);
	
	if ($elem->validPage() === false)
		throw new MyException("Invalid page : html");

/*----------------------------------------------*/
/*-------------------- HTML --------------------*/
/*----------------------------------------------*/

	$template = new TemplateEngine($elem);
	$template->createFile("test.html");

} catch(MyException $e) {

	echo 'Error: ' . $e->getMessage() . PHP_EOL;

}

?>
