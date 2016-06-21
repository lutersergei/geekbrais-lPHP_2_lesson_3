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
    header('Location:wall_types.php');
    die();
}

//Проверка на пост запрос об изменеии записи
if (isset($_POST['operation']))
{
    if ($_POST['operation']==='edit')
    {
        $material=$_POST['material'];        
        $description=$_POST['description'];
        update_wall($material,$description, $id);
        header("Location:wall_types.php");
        die();
    }
}

//Получение информации об изменяемой записи для передачи в начальные значения
if ($wall_information=get_wall_information_by_id($id))
{
    foreach ($wall_information as $wall)
    {
        $material=$wall['material'];
        $description=$wall['description'];
    }
}
else {
    header('Location:wall_types.php');
    die();
}

mysqli_close($link);
require 'views/edit_types.php';