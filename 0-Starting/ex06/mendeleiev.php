<?php

$fd = fopen("ex06.txt", 'r');


$final = [];

for ($iterator = 0; $data = fgets($fd); $iterator++)
{
	$final[$iterator] = explode(" = ", $data);
	$final[$iterator][1] = explode(", ", $final[$iterator][1]);
	for ($iter = 0; $iter < count($final[$iterator][1]); $iter++)
	{
		$final[$iterator][1][$iter] = explode(":", $final[$iterator][1][$iter]);
		$final[$iterator][1][$iter] = $final[$iterator][1][$iter][1];
	}
}

$html = 
"<!DOCTYPE html>
<html lang=\"en\">
	<head>
		<meta charset=\"UTF-8\" />
		<style>
			td, th {
				border: 1px solid black;
				padding: 15px;
			}

			.empty_cell {
				visibility: hidden;
				border: none;
			}
		</style>
	</head>
	<body>
		<main>
			<table style=\"border-collapse: collapse;\">
				<tr>
";

$position = 0;
foreach ($final as $element)
{
	if ($position - 1 > $element[1][0])
	{
		$html .="\t\t\t\t</tr>\n\t\t\t\t<tr>\n";

		$position = 0;
	}


	if ($position != $element[1][0])
	{
		while ($position != $element[1][0])
		{
			$html .="\t\t\t\t\t<td class=\"empty_cell\">\n\t\t\t\t\t</td>\n";
		
			$position++;
		}
	}

	$html .= "\t\t\t\t\t<td>\n";


	$html .= "\t\t\t\t\t\t<h4>{$element[0]}</h4>\n\t\t\t\t\t\t<ul>\n";

	foreach ($element[1] as $attr)
	{
		if ($attr === $element[1][0])
			continue;

		$value = trim($attr, " \n");
		if ($attr === $element[1][1])
		{
			$html .= "\t\t\t\t\t\t\t<li>No $value</li>\n";
		}
		elseif ($attr === $element[1][4])
		{
			$html .= "\t\t\t\t\t\t\t<li>Electrons : $value</li>\n";
		}
		else
		{
			$html .= "\t\t\t\t\t\t\t<li>$value</li>\n";
		}
	}

	$html .= "\t\t\t\t\t\t</ul>\n\t\t\t\t\t</td>\n";

	$position++;

	if ($element === $final[count($final) - 1])
	{
		$html .= "\t\t\t\t</tr>\n";
	}
}

$html .=
"			</table>
		</main>
	</body>
</html>
";

$fd_html = fopen("mendeleiev.html", 'w');
fwrite($fd_html, $html);
fclose($fd_html);


fclose($fd);

?>



<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<ul>
	<?php for ($i = 0; $i < 10; $i++): ?>
	<li><?= $i ?></li>
	<?php endfor; ?>
</ul>
</body>
</html>

<?php
$fd_html = fopen("test.html", 'w');
fwrite($fd_html, ob_get_clean());
fclose($fd_html);
?>