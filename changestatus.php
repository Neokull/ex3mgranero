<?php
session_start();
require_once './autoload.php';

if (isset($_GET['id'], $_GET['status'])) {
    
    $id = $_GET['id'];
    $status = $_GET['status'];

    $lighting = new Lighting();
    $lighting->changeStatus($id, $status);
}

header('Location: index.php');
exit;