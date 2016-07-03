<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 30.06.2016
 * Time: 13:30
 */
class RealtyTags
{
    function get_all_tags()
    {
        global $link;
        $query = "SELECT * FROM `tags`";
        $data_result = mysqli_query($link, $query);
        $tags = array();
        while ($row = mysqli_fetch_assoc($data_result)) {
            $tags[] = $row;
        }
        return $tags;
    }

    function get_tag_by_id($id)
    {
        global $link;
        $query = "SELECT * FROM `tags` WHERE `tag_id` = '$id'";
        $data_result = mysqli_query($link, $query);
        $tags = array();
        if ($row = mysqli_fetch_assoc($data_result)) {
            $tags[] = $row;
            return $tags;
        } else return false;
    }

    function edit_tag($title, $id)
    {
        global $link;
        $query = "UPDATE `tags` SET `title` = '$title' WHERE `tags`.`tag_id` = '$id'";
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }

    function add_new_tag($title)
    {
        global $link;
        $query = <<<SQL
INSERT INTO `tags` (`tag_id`, `title`) VALUES (NULL, '$title')
SQL;
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }

    function delete_tag_by_id($id)
    {
        global $link;
        $query = "DELETE FROM `tags` WHERE `tags`.`tag_id` = '$id'";
        $data_result = mysqli_query($link, $query);
        if ($data_result) return true;
        else return false;
    }

    function get_realty_tag_list($realty_id)
    {
        global $link;
        $query = "SELECT `realty_tags`.`id` AS `relation_id`, `tags`.* FROM `realty_tags` JOIN `tags` ON `tags`.`tag_id`= `realty_tags`.`tag_id` WHERE `realty_tags`.`realty_id` = '$realty_id'";
        $data_result = mysqli_query($link, $query);
        $tags = array();
        while ($row = mysqli_fetch_assoc($data_result)) {
            $tags[] = $row;
        }
        return $tags;
    }
}