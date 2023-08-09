<?php
session_start();

$auth = (isset($_SESSION['auth']) && $_SESSION['auth'] === 'true') ? 'true' : '';
$column = isset($_SESSION['column']) ? $_SESSION['column'] : 'price';
$desc = isset($_SESSION['desc']) ? $_SESSION['desc'] : 'asc';

require_once 'vendor/autoload.php';
require_once 'PDO.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$sql = 'SELECT * FROM account';

if(isset($_GET['sorted']) && isset($_GET['desc'])) {
    $column = $_GET['sorted'];
    $desc = $_GET['desc'];
    $_SESSION['column'] = $column;
    $_SESSION['desc'] = $desc;
};

$sql .= ' ORDER BY ' . $column . ' ' . strtoupper($desc);
$stmt = $db->prepare($sql);
$stmt->execute();

$accounts = $stmt->fetchAll();

$country = array(
    'es', 'us'
);

$title_account = array(
    ['region', 'Регион'],
    ['id_pers', 'Ид персонажа'],
    ['class', 'Класс'],
    ['level_acc', 'Уровень'],
    ['price', 'Цена']
);

$select_desc = array(
    ['desc', 'По убыванию'],
    ['asc', 'По возрастанию']
);

echo $twig->render('index.html', [
    'title'=>'Главная',
    'accounts'=>$accounts,
    'auth'=>$auth,
    'title_account'=>$title_account,
    'column'=>$column,
    'select_desc'=>$select_desc,
    'desc'=>$desc
]);