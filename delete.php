<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 18.06.2016
 * Time: 19:47
 */
require_once ('initial.php');
require_once ('database_connection.php');
require_once('model/realty.model.php');

//Проверка, передан ли в GET запросе id объекта недвижимости
if (isset($_GET['id']))
{
    $id=$_GET['id'];
    if (delete_by_id ($id)) header('Location:index.php');
    else die('WRONG ID'); //Не реагирует, если попытаться удалить строку, которой и так нет
}
else {
    header('Location:index.php');
}
mysqli_close($link);