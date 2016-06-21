<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 21.06.2016
 * Time: 19:32
 */
require_once ('initial.php');
require_once ('database_connection.php');
require_once('model/realty.model.php');
require_once('model/wall.model.php');

//Проверка, передан ли в GET запросе id материала
if (isset($_GET['id']))
{
    $id=$_GET['id'];
}
else {
    header('Location:index.php');
    die();
}

//Получение информации об просматриваемой записи
if ($wall_information=get_wall_information_by_id($id))
{
    foreach ($wall_information as $wall)
    {
        $disabled=false;
        $material=$wall['material'];
        $description=$wall['description'];
        $count=$wall['count'];
        if ($count>0) $disabled='disabled';
    }
}
else {
    header('Location:index.php');
    die();
}
mysqli_close($link);
require 'views/preview_types.php';
