<?php
require_once 'core.php';
Error_reporting(E_ALL);
$numTest = htmlspecialchars($_GET["numTest"]);
$dir    = 'uploads';
$files = scandir($dir, 1);

if (!array_key_exists("$numTest", $files )) {
header ('"'.$_SERVER['SERVER_PROTOCOL']." 404 Not Found");
header("Location: 404.php");
exit();
}

echo "<h1>Тест № ".$numTest."</h1>";
echo "<br/>";
echo "<br/>";
$content = file_get_contents ('uploads/'.$files[$numTest].'');
$decodeData = json_decode ($content, true);
echo "<br/>";
echo "<br/>";
$countQuestions = count($decodeData);
?>

<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
echo '<form action="" method="POST">';
for ($i=0; $i<$countQuestions; $i++) {
	echo "<fieldset><legend>".$decodeData["$i"]["testQuestion"]."</legend>";
	$countTestAnswers = count($decodeData["$i"]["testAnswers"]);
	$wrightAnswers[] = ($decodeData["$i"]["wrightAnswer"]);

	for ($j=0; $j<$countTestAnswers; $j++) {
		echo '<label><input name="'.$i.'" type="radio" value="' . $decodeData["$i"]["testAnswers"][$j] . '">' . $decodeData["$i"]["testAnswers"][$j] . '</label>';
	}
	echo "</fieldset>";
}

echo '<input type="submit" value="Отправить"></form>';
echo "<br/>";
echo "<br/>";
echo "<br/>";

$result = 0;
for ($i=0; $i<$countQuestions; $i++) {
	if (!isset($_POST[$i])){
		echo "<br/>";
		echo "Ответьте на все вопросы и нажмите кнопку 'Отправить'";
		exit();
	}
	elseif ($wrightAnswers[$i] == $_POST[$i]) {
		$result = $result + 1;
	}
}

//Запись имя пользователя и оценки в файл json
$file = 'src/people.txt';
$arr = array('a' => getUserName(), 'b' => $result);
$jsonEncode = json_encode($arr);
file_put_contents($file, $jsonEncode);
//Вывод результатов теста
echo "Ваше имя: " . getUserName();
echo "<br/>";
echo "Верных ответов: ".$result;
echo "<br/>";
echo "Ваш сертификат:";
echo "<br/>";
echo '<img src="img.php">';
?>
<br />
<br />
<br />
<br />
<a href="admin.php">Загрузить тест</a>
<br />
<a href="list.php">Список тестов</a>
</body>
</html>