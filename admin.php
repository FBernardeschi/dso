<?php
session_start();
$auth = isset($_SESSION['auth']) ? 'true' : '';

if(!isset($_SESSION['auth']) && !($_SESSION['auth'] === 'true')) {
    header('Location: login.php');
};

require_once 'vendor/autoload.php';
require_once 'PDO.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$country = array(
    'es', 'us'
);

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete']) && $_SESSION['auth'] === 'true') {
    $id = $_GET['delete'];

    $sql = 'DELETE FROM account WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
        'id'=>$id
    ));
};

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $id_pers = $_POST['id_pers'];
    $level = $_POST['level'];
    $price = $_POST['price'];
    $region = $_POST['region'];
    $class = $_POST['class'];
    $photo = $_POST['photo'];

    $sql = 'INSERT INTO account(id_pers, region, class, level_acc, price, photo) VALUES(:id_pers, :region, :class, :level_acc, :price, :photo)';
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
        'id_pers'=>$id_pers,
        'region'=>$region,
        'class'=>$class,
        'level_acc'=>$level,
        'price'=>$price,
        'photo'=>str_replace(' ', '', $photo)
    ));
};

$class = array(
    'Воин Дракона', 'Маг круга', 'Следопыт', 'Паромеханист',
);

$sql = 'SELECT * FROM account';
$stmt = $db->prepare($sql);
$stmt->execute();
$acc = $stmt->fetchAll();

echo $twig->render('admin.html', [
    'title'=>'Админ панель',
    'auth'=>$auth,
    'country'=>$country,
    'class'=>$class,
    'acc'=>$acc
]);