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
$realty=get_all_realty_order_by_id();
$walls=get_all_walls();
if (isset($_POST['operation']))
{
    if ($_POST['operation']==='add')
    {
        $room=$_POST['room'];
        $floor=$_POST['floor'];
        $adress=$_POST['adress'];
        $material=$_POST['material'];
        $area=$_POST['area'];
        $price=$_POST['price'];
        $description=$_POST['description'];
        add_new_realty($room, $floor, $adress, $material, $area, $price, $description);
        header("Location:index.php");
    }
}
mysqli_close($link);
require ('views/index.php');