<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 22.06.2016
 * Time: 20:54
 */
function render ($view_name, $data = [])
{
    ob_start();
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once ("views/$view_name.php");
    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
}