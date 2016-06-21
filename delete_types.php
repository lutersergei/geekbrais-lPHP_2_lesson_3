<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 21.06.2016
 * Time: 22:51
 */
require_once ('initial.php');
require_once ('database_connection.php');
require_once('model/wall.model.php');
require_once('model/realty.model.php');

//Проверка, передан ли в GET запросе id объекта недвижимости
if (isset($_GET['id']))
{
    $id=$_GET['id'];
}
else {
    header('Location:wall_types.php');
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
    header('Location:wall_types.php');
    die();
}

//Проверка на пост запрос об удалении записи
if (isset($_POST['operation']))
{
    if (($_POST['operation']==='delete') && (!$disabled))
    {
        if (delete_wall_by_id ($id)) header('Location:wall_types.php');
        //тут можно придумать месседж об успешности
    }
    else {
        header('Location:wall_types.php');
        die();
    }
}

mysqli_close($link);
require_once 'views/delete_types.php';