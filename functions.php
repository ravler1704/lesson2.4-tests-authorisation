<?php
function loginGuest($loginGuest)
{
    $_SESSION['user'] = $loginGuest;
	$_SESSION['flag'] = 'user';
	return true;
}

function login($login, $password)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['login'] == $login && $user['password'] == getPassword($password)) {
            unset($user['password']);
            $_SESSION['user'] = $user;
			$_SESSION['flag'] = 'admin';
            return true;
        }
    }
    return false;
}
function getPassword($password)
{
    return $password;
}
function getLoggedUserData()
{
    if (empty($_SESSION['user'])) {
        return null;
    }
    return $_SESSION['user'];
}
function isAuthorized()
{
    return getLoggedUserData() !== null;
}

function getUsers()
{
    $path = __DIR__ . '/data/users.json';
    $fileData = file_get_contents($path);
    $data = json_decode($fileData, true);
    if (!$data) {
        return array();
    }
    return $data;
}

function getUserName()
{
	if (is_string($_SESSION['user'])){
		return $_SESSION['user'];
	} else {
	return $_SESSION['user']['name'];
	}
}

function isPOST()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function getParam($name)
{
    return filter_input(INPUT_POST, $name);
}
function location($path)
{
    header("Location: $path.php");
    die;
}

function logout()
{
    session_destroy();
    location('index');
}

?>