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
    
    public function realty_tags_index_and_add()
    {
        //Запрашиваем все значения из таблицы Типы_Стен
        $tags = get_all_tags();

//Проверка на пост запрос о добавлении новой записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'add') {
                $title = $_POST['title'];
                add_new_tag($title);
                header("Location:index.php?cat=realty_tags&view=index_and_add");
                die();
            }
        }

        return render("tags/tags_list", ['tags' => $tags]);

    }

    public function realty_tags_edit()
    {
        //Проверка, передан ли в GET запросе id объекта недвижимости
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            header('Location:index.php?cat=realty_tags&view=index_and_add');
            die();
        }

//Проверка на пост запрос об изменеии записи
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'edit') {
                $title = $_POST['title'];
                edit_tag($title, $id);
                header("Location:index.php?cat=realty_tags&view=index_and_add");
                die();
            }
        }

//Получение информации об изменяемой записи для передачи в начальные значения
        if (!$tag_information = get_tag_by_id($id)) {
            header('Location:index.php?cat=realty_tags&view=index_and_add');
            die();
        }

        return render("tags/edit_tags", ['tag_information' => $tag_information, 'id' => $id]);

    }

    public function realty_tags_delete()
    {
        //Проверка, передан ли в GET запросе id объекта недвижимости
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            header('Location:index.php?cat=realty_tags&view=index_and_add');
            die();
        }

//Получение информации об просматриваемой записи
        if (!$tag_information = get_tag_by_id($id)) {
            header('Location:index.php?cat=realty_tags&view=index_and_add');
            die();
        }

//Проверка на пост запрос об удалении записи
        if (isset($_POST['action'])) {
            if (($_POST['action'] === 'delete')) {
                if (delete_tag_by_id($id)) {
                    header('Location:index.php?cat=realty_tags&view=index_and_add');
                } else {
                    header('Location:index.php?cat=realty_tags&view=index_and_add');
                    die('404');
                }
                //тут можно придумать месседж об успешности
            } else {
                header('Location:index.php?cat=realty_tags&view=index_and_add');
                die('404');
            }
        }

        return render("tags/delete_tags", ['tag_information' => $tag_information, 'id' => $id]);

    }

    public function realty_tags_preview()
    {
//Проверка, передан ли в GET запросе id материала
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            header('Location:index.php?cat=realty_tags&view=index_and_add');
            die();
        }

//Получение информации об просматриваемой записи
        if (!$tag_information = get_tag_by_id($id)) {
            header('Location:index.php?cat=realty_tags&view=index_and_add');
            die();
        }

        return render("tags/preview_tags", ['tag_information' => $tag_information, 'id' => $id]);

    }
}