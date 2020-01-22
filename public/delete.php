<?php 
ini_set('display_errors', 1);
require '../src/bootstrap.php';
$pdo = getPdo();
$events = new Calendar\Events($pdo);
$errors = [];
if (!isset($_GET['id'])) {
    header('location: /calendar/public/404.php');
}

try {
    $event = $events->find($_GET['id']);
    $events->delete($event);
    header('Location: /calendar/public/index.php?deleted=1');
} catch (\Exception $e) {
    e404();
   
}
