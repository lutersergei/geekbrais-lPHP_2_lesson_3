<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 30.06.2016
 * Time: 13:54
 */

class RealtyTagsController
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
            header('Location:index.php?cat=realty_tags&view=index_and_add');
            die();
        }
    }

    protected static function create_and_load($function, $id = NULL)
    {
        //Создание нового объекта и загрузка полей информацией из POST, выполнение функции из модели
        $tag = new RealtyTags($id);
        if (isset($_POST['title']))
        {
            $tag->title = $_POST['title'];
        }
        if ($tag->$function())
        {
            header("Location:index.php?cat=realty_tags&view=index_and_add");
            die();
        }
        else return false;

    }

    protected static function get_tag($id)
    {
        //Получение информации об изменяемой записи для передачи в начальные значения
        $tag = new RealtyTags($id);
        if (!$tag->is_loaded())
        {
            die(ERROR_VIEW);
        }
        return $tag;
    }
    
    public function realty_tags_index_and_add()
    {
        //Запрашиваем все значения из таблицы Типы_Стен
        $tags = RealtyTags::get_all();

//Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action'])) 
        {
            if ($_POST['action'] === 'add') 
            {
                if (!RealtyTagsController::create_and_load('add'))
                {
                    die(ERROR_CREATE);
                }
            }
        }
        return render("tags/tags_list", ['tags' => $tags]);
    }

    public function realty_tags_edit()
    {
        $id = RealtyTagsController::check_id();
//Проверка на пост запрос об изменеии записи
        if (isset($_POST['action']))
        {
            if ($_POST['action'] === 'edit')
            {
                $id = $_POST['id'];
                if (!RealtyTagsController::create_and_load('update',$id))
                {
                    die(ERROR_UPDATE);
                }
            }
        }
//Получение информации об изменяемой записи для передачи в начальные значения
        $tag = RealtyTagsController::get_tag($id);
        return render("tags/edit_tags", ['tag' => $tag]);
    }

    public function realty_tags_delete()
    {
        $id = RealtyTagsController::check_id();
//Проверка на пост запрос об удалении записи
        if (isset($_POST['action'])) {
            if (($_POST['action'] === 'delete'))
            {
                $id = $_POST['id'];
                if (!RealtyTagsController::create_and_load('delete',$id))
                {
                    die(ERROR_DELETE);
                }
            }
            else
            {
                header('Location:index.php?cat=realty_tags&view=index_and_add');
                die('404');
            }
        }
        //Получение информации об просматриваемой записи
        $tag = RealtyTagsController::get_tag($id);
        return render("tags/delete_tags", ['tag' => $tag]);
    }

    public function realty_tags_preview()
    {
        $id = RealtyTagsController::check_id();
        $tag = RealtyTagsController::get_tag($id);
        return render("tags/preview_tags", ['tag' => $tag]);
    }
}