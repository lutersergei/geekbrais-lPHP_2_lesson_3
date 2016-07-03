<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 18.06.2016
 * Time: 22:30
 */
class Wall
{
    function get_all_walls_and_count()
    {
        global $link;
        $query = "
SELECT `wall`.*, COUNT(`realty`.`realty_id`) AS `count` 
FROM `wall` 
LEFT JOIN `realty` 
ON `realty`.`wall_id` = `wall`.`id` 
GROUP BY `wall`.`id`";
        $data_result = mysqli_query($link, $query);
        $walls = array();
        while ($row = mysqli_fetch_assoc($data_result)) {
            $walls[] = $row;
        }
        return $walls;
    }

    function get_wall_information_by_id($id)
    {
        global $link;
        $query = "
SELECT `wall`.*, COUNT(`realty`.`realty_id`) AS `count` 
FROM `wall` 
LEFT JOIN `realty` 
ON `realty`.`wall_id` = `wall`.`id` 
WHERE `wall`.`id` = '$id'";
        $data_result = mysqli_query($link, $query);
        $walls = array();
        if ($row = mysqli_fetch_assoc($data_result)) {
            $walls[] = $row;
            return $walls;
        } else return false;
    }

    function update_wall($material, $description, $id)
    {
        global $link;
        $query = "UPDATE `wall` 
SET `material` = '$material', `description` = '$description' 
WHERE `wall`.`id` = '$id'";
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }

    function add_new_wall($material, $description)
    {
        global $link;
        $query = <<<SQL
INSERT INTO `wall` (`id`, `material`, `description`) VALUES (NULL, '$material', '$description');
SQL;
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }

    function delete_wall_by_id($id)
    {
        global $link;
        $query = "DELETE FROM `wall` WHERE `id` = '$id'";
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }
}