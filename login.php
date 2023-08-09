<?php
session_start();

require_once 'vendor/autoload.php';
require_once 'PDO.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

if(isset($_SESSION['auth']) && $_SESSION['auth'] === 'true') {
    header('Location: admin.php');
    die();
};

$error = '';

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    if($login === 'admin' && $pass === 'GGch6cvEfx3') {
        $_SESSION['auth'] = 'true';
        header('Location: admin.php');
    } else {
        $error = 'Неверный логин или пароль';
    };
};

echo $twig->render('login.html', [
    'title'=>'Вход',
    'error'=>$error
]);