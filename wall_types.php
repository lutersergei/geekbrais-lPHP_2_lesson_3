<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 21.06.2016
 * Time: 14:45
 */
require_once ('initial.php');
require_once ('database_connection.php');
require_once('model/wall.model.php');
require_once('model/realty.model.php');

//Запрашиваем все значения из таблицы Типы_Стен
$walls=get_all_walls_and_count();

//Проверка на пост запрос о добавлении новой записи
if (isset($_POST['operation']))
{
    if ($_POST['operation']==='add')
    {
        $material=$_POST['material'];
        $description=$_POST['description'];
        add_new_wall($material, $description);
        header("Location:wall_types.php");
        die();
    }
}

mysqli_close($link);
require_once 'views/wall_types.php';