<?php
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
    header('Location:index.php');
    die();
}

//Проверка на пост запрос об изменеии записи
if (isset($_POST['operation']))
{
    if ($_POST['operation']==='edit')
    {
        $rooms=$_POST['rooms'];
        $floor=$_POST['floor'];
        $adress=$_POST['adress'];
        $material=$_POST['material'];
        $area=$_POST['area'];
        $price=$_POST['price'];
        $description=$_POST['description'];
        $update=update_realty($rooms, $floor, $adress, $material, $area, $price, $description, $id);
        header("Location:index.php");
        die();
    }
}

//Получение информации об изменяемой записи для передачи в начальные значения
if ($realty_information=get_realty_information($id))
{
    foreach ($realty_information as $realty_one)
    {
        $rooms=$realty_one['rooms'];
        $floor=$realty_one['floor'];
        $adress=$realty_one['adress'];
        $material=$realty_one['wall_id'];
        $area=$realty_one['area'];
        $price=$realty_one['price'];
        $description=$realty_one['description'];
    }
}
else {
    header('Location:index.php');
    die();
}

//Запрашиваем все значения из таблицы Типы_Стен
$walls=get_all_walls_and_count();

mysqli_close($link);
require 'views/edit.php';