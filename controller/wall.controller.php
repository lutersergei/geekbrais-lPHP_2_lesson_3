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
    
    public function wall_edit()
    {
        //Проверка, передан ли в GET запросе id объекта недвижимости
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        else
        {
            header('Location:index.php?cat=wall&view=index_and_add');
            die();
        }

//Проверка на пост запрос об изменеии записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'edit')
            {
                $id = $_POST['id'];
                $wall = new Wall($id);
                $wall->material = $_POST['material'];
                $wall->description = $_POST['description'];
                $wall->update();
                header("Location:index.php?cat=wall&view=index_and_add");
                die();
            }
        }

//Получение информации об изменяемой записи для передачи в начальные значения
        $wall = new Wall($id);
        if (!$wall->is_loaded())
        {
            die('Объект не найден');
        }
        
        return render("wall_types/edit_types", ['wall' => $wall]);

    }

    public function wall_delete()
    {
        //Проверка, передан ли в GET запросе id объекта недвижимости
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            header('Location:index.php?cat=wall&view=index_and_add');
            die();
        }

//Получение информации об просматриваемой записи
        $wall = new Wall($id);
        if (!$wall->is_loaded())
        {
            die('Объект не найден');
        }

//Проверка на пост запрос об удалении записи
        if (isset($_POST['action'])) {
            if (($_POST['action'] === 'delete')) 
            {
                $id = $_POST['id'];
                $wall = new Wall($id);
                if ($wall->delete())
                {
                    header('Location:index.php?cat=wall&view=index_and_add');
                }
                else
                {
                    die('Невозможно удалить объект');
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
//Проверка, передан ли в GET запросе id материала
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            header('Location:index.php?cat=wall&view=index_and_add');
            die();
        }

//Получение информации об просматриваемой записи
        $wall = new Wall($id);
        if (!$wall->is_loaded())
        {
            die('Объект не найден');
        }
        return render("wall_types/preview_types", ['wall' => $wall, 'id' => $id]);

    }

    public function wall_index_and_add()
    {
        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::get_all();

        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'add') {
                $wall = new Wall();
                $wall->material = $_POST['material'];
                $wall->description = $_POST['description'];
                $wall->add();
                header("Location:index.php?cat=wall&view=index_and_add");
                die();
            }
        }

        return render("wall_types/wall_types", ['walls' => $walls]);

    }
}