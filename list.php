<?php
require_once 'core.php';
Error_reporting(E_ALL);
echo "<h1>Загруженные тесты:</h1>";
echo '<br />';
echo '<br />';
$dir    = 'uploads';
$files = scandir($dir, 1);
echo '<br />';
for ($i=0; $i<count($files)-2; $i++) {
	echo '<br />' . $files[$i].' (Тест №  '.$i.')&nbsp;<a href="test.php?numTest=' . $i . '">Выбрать тест</a>&nbsp;&nbsp;&nbsp;';

if ($_SESSION['flag'] == 'admin') {
	echo '<a href="deltest.php?testName=' . $files[$i] . '">Удалить тест</a>';
}
}
echo '<br />';
echo '<br />';
echo '<br />';

if ($_SESSION['flag'] == 'admin') {
	echo "<a href='admin.php'>Загрузить тест</a>";
} else {
			echo "Войдите как администратор для загрузки тестов";
}

?>