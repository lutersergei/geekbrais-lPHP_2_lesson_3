<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 18.06.2016
 * Time: 22:30
 */
function get_all_walls ()
{
    global $link;
    $query="SELECT * FROM `wall` WHERE 1";
    $data_result = mysqli_query($link,$query);
    $walls=array();
    while($row = mysqli_fetch_assoc($data_result))
    {
        $walls[]=$row;
    }
    return $walls;
}