<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 22.06.2016
 * Time: 11:40
 */
class RealtyController
{
    function __call($name, $arguments)
    {
        die('404');
    }

    public function realty_edit()
    {
        //Проверка, передан ли в GET запросе id объекта недвижимости
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            header('Location:index.php?cat=realty&view=index_and_add');
            die();
        }

//Проверка на пост запрос об изменеии записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'edit') {
                $id = $_POST['id'];
                $realty = new Realty($id);
                $realty->rooms = $_POST['rooms'];
                $realty->floor = $_POST['floor'];
                $realty->adress = $_POST['adress'];
                $realty->material = $_POST['material'];
                $realty->area = $_POST['area'];
                $realty->price = $_POST['price'];
                $realty->description = $_POST['description'];
                $realty->update();
                header("Location:index.php?cat=realty&view=index_and_add");
                die();
            }
//            if ($_POST['action'] === 'add_tag') {
//                $id = $_POST['id'];
//                $tag_id = $_POST['tag_id'];
//                realty_add_tag($id, $tag_id);
//                header("Location:index.php?cat=realty&view=edit&id=$id");
//                die();
//            }
//            if ($_POST['action'] === 'delete_tag') {
//                $id = $_POST['id'];
//                $tag_id = $_POST['tag_id'];
//
//                realty_delete_tag($tag_id);
//                header("Location:index.php?cat=realty&view=edit&id=$id");
//                die();
//            }
        }

//Получение информации об изменяемой записи для передачи в начальные значения
        $realty = new Realty($id);
        if (!$realty->is_loaded())
        {
            die('Объект не найден');
        }

//Запрашиваем все значения из таблицы Типы_Стен
//        $walls = get_all_walls_and_count();
//        $tags = get_all_tags();
//        $realty_tags = get_realty_tag_list($id);


        return render("realty/edit", ['realty' => $realty]); /*  _information, 'walls' => $walls, 'realty_tags' => $realty_tags, 'tags' => $tags]   */
    }

    public function realty_delete()
    {
        //Проверка, передан ли в GET запросе id объекта недвижимости
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            header('Location:index.php?cat=realty&view=index_and_add');
            die();
        }

//Проверка на пост запрос об удалении записи
        if (isset($_POST['action']))
        {
            if ($_POST['action'] === 'delete')
            {
                $id = $_POST['id'];
                $realty = new Realty($id);
                if ($realty->delete())
                {
                    header('Location:index.php?cat=realty&view=index_and_add');
                }
                else
                {
                    die('Невозможно удалить объект');
                }
            }
        }
//Получение информации об просматриваемой записи
            $realty = new Realty($id);
            if (!$realty->is_loaded())
            {
                die('Объект не найден');
            }
        return render("realty/delete", ['realty' => $realty]);
    }

    public function realty_preview()
    {
        //Проверка, передан ли в GET запросе id объекта недвижимости
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            header('Location:index.php?cat=realty&view=index_and_add');
            die();
        }

//Получение информации об просматриваемой записи
        $realty = new Realty($id);
        if (!$realty->is_loaded())
        {
            die('Объект не найден');
        }
        return render("realty/preview", ['realty' => $realty]);
    }

    public function realty_index_and_add()
    {
        //Запрашиваем все значения из таблицы Недвижимость, отсортированые по id
        $realty = Realty::get_all_realty();

        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::get_all();

        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'add')
            {
                $realty = new Realty();
                $realty-> rooms = $_POST['rooms'];
                $realty-> floor = $_POST['floor'];
                $realty-> adress = $_POST['adress'];
                $realty-> wall_id = $_POST['material'];
                $realty-> area = $_POST['area'];
                $realty-> price = $_POST['price'];
                $realty-> description = $_POST['description'];
                $realty->add();
                header("Location:index.php?cat=realty&view=index_and_add");
                die();
            }
        }
        return render("realty/index", ['realty' => $realty, 'walls' => $walls]);
    }

    public function realty_group_by_wall()
    {
        //Проверка, передан ли в GET запросе id материала
        if (isset($_GET['wall_id'])) {
            $wall_id = $_GET['wall_id'];
        } else {
            header('Location:index.php?cat=wall&view=index_and_add');
            die();
        }
        $realty = Realty::load_wall_group($wall_id);

        //Запрашиваем все значения из таблицы Типы_Стен
        $walls = Wall::get_all();

        //Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'add')
            {
                $realty = new Realty();
                $realty-> rooms = $_POST['rooms'];
                $realty-> floor = $_POST['floor'];
                $realty-> adress = $_POST['adress'];
                $realty-> wall_id = $_POST['material'];
                $realty-> area = $_POST['area'];
                $realty-> price = $_POST['price'];
                $realty-> description = $_POST['description'];
                $realty->add();
                header("Location:index.php?cat=realty&view=index_and_add");
                die();
            }
        }
        return render("realty/index", ['realty' => $realty, 'walls' => $walls]);
    }
}