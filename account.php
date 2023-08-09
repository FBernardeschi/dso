<?php
session_start();
$auth = isset($_SESSION['auth']) ? 'true' : '';

require_once 'vendor/autoload.php';
require_once 'PDO.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

if($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['id']) {
    $id = $_GET['id'];

    $sql = 'SELECT * FROM account WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
        'id'=>$id
    ));

    $account = $stmt->fetch();
};

$photo = explode(',', $account['photo']);

echo $twig->render('account.html', [
    'title'=>'Аккаунт',
    'photo'=>$photo,
    'account'=>$account,
    'auth'=>$auth
]);