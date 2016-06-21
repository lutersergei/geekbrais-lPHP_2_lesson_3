<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 18.06.2016
 * Time: 10:22
 */
require_once ('initial.php');
require_once ('database_connection.php');
require_once('model/realty.model.php');
if (isset($_GET['id']))
{
    $id=$_GET['id'];
}
else {
    header('Location:index.php');
}
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
require 'views/preview.php';
