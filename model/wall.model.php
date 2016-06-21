<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 18.06.2016
 * Time: 22:30
 */

function get_all_walls_and_count ()
{
    global $link;
    $query="
SELECT `wall`.*, COUNT(`realty`.`realty_id`) AS `count` 
FROM `wall` 
LEFT JOIN `realty` 
ON `realty`.`wall_id` = `wall`.`id` 
GROUP BY `wall`.`id`";
    $data_result = mysqli_query($link,$query);
    $walls=array();
    while($row = mysqli_fetch_assoc($data_result))
    {
        $walls[]=$row;
    }
    return $walls;
}
function get_wall_information_by_id ($id)
{
    global $link;
    $query="
SELECT `wall`.*, COUNT(`realty`.`realty_id`) AS `count` 
FROM `wall` 
LEFT JOIN `realty` 
ON `realty`.`wall_id` = `wall`.`id` 
WHERE `wall`.`id` = '$id'";
    $data_result = mysqli_query($link,$query);
    $walls=array();
    if ($row = mysqli_fetch_assoc($data_result))
    {
        $walls[]=$row;
        return $walls;
    }
    else return false;
}

