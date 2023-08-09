<?php
session_start();

$_SESSION['auth'] = '';

header('Location: login.php');