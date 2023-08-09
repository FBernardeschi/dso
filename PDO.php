<?php

$db = new PDO('mysql:host=localhost;dbname=dso;port=3306;charset=utf8', 'root', 'root');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$sql = 'CREATE TABLE IF NOT EXISTS account (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    id_pers VARCHAR(100),
    region VARCHAR(100),
    class VARCHAR(100),
    level_acc INT(11),
    price INT(11),
    photo VARCHAR(255)
)';

$db->exec($sql);

return $db;