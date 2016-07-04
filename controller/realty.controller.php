<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 22.06.2016
 * Time: 11:40
 */
class RealtyController
{
    public function __call($name, $arguments)
    {
        die('404');
    }

    protected static function check_id()
    {
        //Проверка, передан ли в GET запросе id объекта недвижимости
        if ((isset($_GET['id'])) || (isset($_GET['wall_id'])))
        {
            if (isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
            if (isset($_GET['wall_id']))
            {
                $id = $_GET['wall_id'];
            }
            return $id;
        }
        else
        {
            header('Location:index.php?cat=realty&view=index_and_add');
            die();
        }
    }

    protected static function create_and_load($function, $id = NULL)
    {
        //Создание нового объекта и загрузка полей информацией из POST, выполнение функции из модели
        $realty = new Realty($id);
        if (isset($_POST['rooms']))
        {   /*       isset($_POST['rooms']) - определяет есть ли данные в POST запросе, кроме action. Сделано для delete. Нужен триггер получше               */
            $realty->rooms = $_POST['rooms'];
            $realty->floor = $_POST['floor'];
            $realty->adress = $_POST['adress'];
            $realty->wall_id = $_POST['material'];
            $realty->area = $_POST['area'];
            $realty->price = $_POST['price'];
            $realty->description = $_POST['description'];
        }
        if ($realty->$function())
        {
            header("Location:index.php?cat=realty&view=index_and_add");
            die();
        }
        else return false;
    }

    protected static function get_realty($id)
    {
        //Получение информации об изменяемой записи для передачи в начальные значения
        $realty = new Realty($id);
        if (!$realty->is_loaded())
        {
            die(ERROR_VIEW);
        }
        return $realty;
    }

    public function realty_edit()
    {
        $id = RealtyController::check_id();

//Проверка на пост запрос об изменеии записи
        if (isset($_POST['action']))
        {
            if ($_POST['action'] === 'edit')
            {
                $id = $_POST['id'];
                if (!RealtyController::create_and_load('update', $id))
                {
                    die(ERROR_UPDATE);
                }
            }
            if ($_POST['action'] === 'add_tag')
            {
                $id = $_POST['id'];
                $realty = new Realty($id);
                $realty->relation_tag_id = $_POST['tag_id'];
                if ($realty->realty_add_tag())
                {
                    header("Location:index.php?cat=realty&view=edit&id={$id}");
                }
                else
                {
                    die(ERROR_CREATE);
                }
            }
            if ($_POST['action'] === 'delete_tag')
            {
                $id = $_POST['id'];
                $realty = new Realty($id);
                $realty->relation_id = $_POST['relation_id'];
                if ($realty->realty_delete_tag())
                {
                    header("Location:index.php?cat=realty&view=edit&id={$id}");
                }
                else
                {
                    die(ERROR_DELETE);
                }
            }
        }
        $realty = RealtyController::get_realty($id);
        $walls = Wall::get_all();
        $tags = RealtyTags::get_all();

        //Получение всех связанных с квартирой тегов
        $relation_tags = RealtyTags::get_realtion_tag($id);

        return render("realty/edit", ['realty' => $realty, 'walls' => $walls, 'relation_tags' => $relation_tags, 'tags' => $tags]); 
    }

    public function realty_delete()
    {
        $id = RealtyController::check_id();

//Проверка на пост запрос об удалении записи
        if (isset($_POST['action']))
        {
            if ($_POST['action'] === 'delete')
            {
                if (!RealtyController::create_and_load('delete', $id))
                {
                    die(ERROR_DELETE);
                }
            }
        }
        $realty = RealtyController::get_realty($id);
        return render("realty/delete", ['realty' => $realty]);
    }

    public function realty_preview()
    {
        $id = RealtyController::check_id();
//Получение информации об просматриваемой записи
        $realty = RealtyController::get_realty($id);
        return render("realty/preview", ['realty' => $realty]);
    }

    public function realty_index_and_add()
    {
        //Запрашиваем все значения из таблицы Недвижимость, отсортированые по id
        $realty = Realty::get_all_realty();

        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::get_all();

        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action'])) 
        {
            if ($_POST['action'] === 'add')
            {
                if (!RealtyController::create_and_load('add'))
                {
                    die(ERROR_CREATE);
                }
            }
        }
        return render("realty/index", ['realty' => $realty, 'walls' => $walls]);
    }

    public function realty_group_by_wall()
    {
        $wall_id = RealtyController::check_id();
        $realty = Realty::load_wall_group($wall_id);

        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::get_all();

        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action'])) 
        {
            if ($_POST['action'] === 'add')
            {
                if (!RealtyController::create_and_load('add'))
                {
                    die(ERROR_CREATE);
                }
            }
        }
        return render("realty/index", ['realty' => $realty, 'walls' => $walls]);
    }
}