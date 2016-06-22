<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 17.06.2016
 * Time: 17:10
 */
require_once ('initial.php');
require_once ('database_connection.php');
require_once('model/wall.model.php');
require_once('model/realty.model.php');

if (isset($_GET['cat']))
{
    $controller= $_GET['cat'];
}
else
{
    $controller='realty';
}


if (isset($_GET['view']))
{
    $controller_action = $_GET['view'];
}
else
{
    $controller_action = 'index_and_add';
}


if (file_exists("controller/{$controller}.controller.php"))
{
    require_once "controller/{$controller}.controller.php";
}
else
{
    die('404');
}


$controller_function_name = $controller."_".$controller_action;

if (function_exists($controller_function_name))
{
    $controller_function_name();
}
else
{
    die('404');
}
mysqli_close($link);