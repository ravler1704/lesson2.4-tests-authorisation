<?php
require_once 'core.php';
$errors = array();
if (isPOST()) {
    if (login(getParam('login'), getParam('password'))) {
        location('admin');
	
    } elseif (loginGuest(getParam('loginGuest'))){
		location('list');
	}	else {
        $errors[] = 'Неверный логин или пароль.';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
<ul>
    <? foreach ($errors as $error): ?>
        <li><?= $error ?></li>
    <? endforeach; ?>
</ul>

<form method="POST">
    <label for="login">Логин</label>
    <input name="login" id="login">

    <label for="password">Пароль</label>
    <input name="password" id="password">

    <button type="submit">Войти</button>
</form>
<br />
<br />
<br />
<form method="POST">
    <label for="loginGuest">Введите имя, чтобы войти как гость</label>
    <input name="loginGuest" id="loginGuest">

    <button type="submit">Войти</button>
</form>
</html>