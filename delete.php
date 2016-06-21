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
}
else {
    header('Location:index.php');
}

//Проверка на пост запрос об удалении записи
if (isset($_POST['operation']))
{
    if ($_POST['operation']==='delete')
    {
        if (delete_by_id ($id)) header('Location:index.php');
        else die('WRONG ID'); //Не реагирует, если попытаться удалить строку, которой и так нет
    }
    else header('Location:index.php');
}

//Получение информации об просматриваемой записи
if ($realty_information=get_realty_information($id))
{
    foreach ($realty_information as $realty_one)
    {
        $rooms=$realty_one['rooms'];
        $floor=$realty_one['floor'];
        $adress=$realty_one['adress'];
        $material=$realty_one['material'];
        $area=$realty_one['area'];
        $price=$realty_one['price'];
        $description=$realty_one['description'];
    }
}
else {
    header('Location:index.php');
}
mysqli_close($link);
require_once 'views/delete.php';