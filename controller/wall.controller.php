<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 22.06.2016
 * Time: 11:41
 */
class WallController
{
    function __call($name, $arguments)
    {
        die('404');
    }

    protected static function check_id()
    {
        //Проверка, передан ли в GET запросе id объекта недвижимости
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            return $id;
        }
        else
        {
            header('Location:index.php?cat=wall&view=index_and_add');
            die();
        }
    }

    protected static function create_and_load($function, $id = NULL)
    {
        //Создание нового объекта и загрузка полей информацией из POST, выполнение функции из модели
        $wall = new Wall($id);
        if (isset($_POST['material']))
        { /*       isset($_POST['material']) - определяет есть ли данные в POST запросе, кроме action. Сделано для delete. Нужен триггер получше               */
            $wall->material = $_POST['material'];
            $wall->description = $_POST['description'];
        }
        if ($wall->$function())
        {
            header("Location:index.php?cat=wall&view=index_and_add");
            die();
        }
        else return false;

    }

    protected static function get_wall($id)
    {
        //Получение информации об изменяемой записи для передачи в начальные значения
        $wall = new Wall($id);
        if (!$wall->is_loaded())
        {
            die(ERROR_VIEW);
        }
        return $wall;
    }

    public function wall_edit()
    {
        $id = WallController::check_id();

//Проверка на пост запрос об изменеии записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'edit')
            {
                $id = $_POST['id'];
                if (!WallController::create_and_load('update', $id))
                {
                    die(ERROR_UPDATE);
                }
            }
        }
        $wall = WallController::get_wall($id);

        return render("wall_types/edit_types", ['wall' => $wall]);
    }

    public function wall_delete()
    {
        $id = WallController::check_id();
        $wall = WallController::get_wall($id);

//Проверка на пост запрос об удалении записи
        if (isset($_POST['action']))
        {
            if (($_POST['action'] === 'delete')) 
            {
                $id = $_POST['id'];
                if (!WallController::create_and_load('delete', $id))
                {
                    die(ERROR_DELETE);
                }
            }
            else 
            {
                header('Location:index.php?cat=wall&view=index_and_add');
                die();
            }
        }

        return render("wall_types/delete_types", ['wall' => $wall]);
    }

    public function wall_preview()
    {
        $id = WallController::check_id();
        $wall = WallController::get_wall($id);
        return render("wall_types/preview_types", ['wall' => $wall]);
    }

    public function wall_index_and_add()
    {
        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::get_all();
        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'add') {
                if (!WallController::create_and_load('add'))
                {
                    die(ERROR_CREATE);
                }
            }
        }
        return render("wall_types/wall_types", ['walls' => $walls]);
    }
}