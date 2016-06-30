<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 18.06.2016
 * Time: 22:31
 */
function get_all_realty_order_by_id ()
{
    global $link;
    $query="SELECT * FROM `realty` LEFT JOIN `wall` ON `realty`.`wall_id`=`wall`.`id` ORDER BY `realty`.`realty_id` ASC ";
    $data_result = mysqli_query($link,$query);
    $realty=[];
    while($row = mysqli_fetch_assoc($data_result))
    {
        $realty[]=$row;
    }
    return $realty;
}


function add_new_realty ($room, $floor, $adress, $material, $area, $price, $description)
{
    global $link;
    $query=<<<SQL
INSERT INTO `realty` (`realty_id`, `area`, `rooms`, `floor`, `adress`, `price`, `description`, `wall_id`) VALUES (NULL, '$area', '$room', '$floor', '$adress', '$price', '$description', '$material');
SQL;
    mysqli_query($link,$query);
}


function get_realty_information ($id)
{
    global $link;
    $query="SELECT `realty`.*, `wall`.`material` FROM `realty` LEFT JOIN `wall` ON `realty`.`wall_id`=`wall`.`id`  WHERE `realty_id` = '$id'";
    $data_result = mysqli_query($link,$query);
    $realty_information=array();
    if ($row = mysqli_fetch_assoc($data_result))
    {
        $realty_information[]=$row;
        return $realty_information;
    }
    else return false;
}


function update_realty($rooms, $floor, $adress, $material, $area, $price, $description, $id)
{
    global $link;
    $query=<<<SQL
    UPDATE `realty` 
    SET 
    `area` = '$area', 
    `rooms` = '$rooms', 
    `floor` = '$floor', 
    `adress` = '$adress', 
    `price` = '$price', 
    `description` = '$description', 
    `wall_id` = '$material' 
    WHERE `realty`.`realty_id` = '$id'
SQL;
    $data_result = mysqli_query($link,$query);
    if ($data_result) return true;
    else return false;
}


function delete_by_id ($id)
{
    global $link;
    $query="DELETE FROM `realty` WHERE `realty_id` = '$id'";
    $data_result=mysqli_query($link,$query);
    if ($data_result) return true;
    else return false;
}

function get_realty_group_by_wall($id)
{
    global $link;
    $query="SELECT * FROM `realty` LEFT JOIN `wall` ON `realty`.`wall_id`=`wall`.`id`  WHERE `wall_id` = '$id' ORDER BY `realty`.`realty_id` ASC";
    $data_result=mysqli_query($link, $query);
    $realty=[];
    while($row = mysqli_fetch_assoc($data_result))
    {
        $realty[]=$row;
    }
    return $realty;
}