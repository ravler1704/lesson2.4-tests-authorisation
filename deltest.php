<?php
unlink(__DIR__ . "/uploads/" . $_GET["testName"]);
echo "Тест '" . $_GET["testName"] . "' удален."
?>