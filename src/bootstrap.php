<?php 
require '../vendor/autoload.php';
function e404() 
{
    include '../public/404.php';
    exit();
    
}
function dd($vars) 
{
    foreach($vars as $var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    }
}

function getPdo(): \PDO {
    return new \PDO('mysql:host=localhost;dbname=calendar;charset=utf8', 'root', '', [ \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,   
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC]);
    $sql = "SELECT * FROM events WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'";
    $statement = $pdo->query($sql);
    $results = $statement->fetchAll();
    return $results;
}

function h(?string $value): string
{
    if ($value === null) {
        return '';
    }
    return htmlentities($value);
}
function render(string $view, $parameters = []) 
{
    extract($parameters);
    include "../views/{$view}.php";

}