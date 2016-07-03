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
require_once ('model/realty_tags.model.php');
require_once ('functions.php');

spl_autoload_register('class_autoload');

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

$controller_class_name = name2controller_class_name($controller);
$controller_function_name = $controller."_".$controller_action;

$controller_object = new $controller_class_name();

$result = $controller_object ->  $controller_function_name();
if ($result) echo $result;

mysqli_close($link);