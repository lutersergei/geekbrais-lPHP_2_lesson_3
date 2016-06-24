<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 22.06.2016
 * Time: 20:54
 */
function render ($view_name, $data = [], $with_layout = true)
{
    ob_start();
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once ("views/$view_name.php");
    $content = ob_get_contents();
    ob_end_clean();

    if ($with_layout)
    {
        ob_start();
        require_once ('views/layout/index.php');
        $content = ob_get_contents();
        ob_end_clean();
    }
    return $content;
}