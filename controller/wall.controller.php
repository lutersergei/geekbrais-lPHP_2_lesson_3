<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 22.06.2016
 * Time: 11:41
 */
function wall_edit()
{
    //Проверка, передан ли в GET запросе id объекта недвижимости
    if (isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
    else {
        header('Location:index.php?cat=wall&view=index_and_add');
        die();
    }

//Проверка на пост запрос об изменеии записи
    if (isset($_POST['action']))
    {
        if ($_POST['action']==='edit')
        {
            $material=$_POST['material'];
            $description=$_POST['description'];
            update_wall($material,$description, $id);
            header("Location:index.php?cat=wall&view=index_and_add");
            die();
        }
    }

//Получение информации об изменяемой записи для передачи в начальные значения
    if (!$wall_information=get_wall_information_by_id($id))
    {
        header('Location:index.php?cat=wall&view=index_and_add');
        die();
    }
    
    return render("wall_types/edit_types", ['wall_information' => $wall_information, 'id' => $id]);

}

function wall_delete()
{
    //Проверка, передан ли в GET запросе id объекта недвижимости
    if (isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
    else {
        header('Location:index.php?cat=wall&view=index_and_add');
        die();
    }

//Получение информации об просматриваемой записи
    if (!$wall_information=get_wall_information_by_id($id))
    {
        header('Location:index.php?cat=wall&view=index_and_add');
        die();
    }
   
//Проверка на пост запрос об удалении записи
    if (isset($_POST['action']))
    {
        if (($_POST['action']==='delete'))
        {
            if (delete_wall_by_id ($id)) header('Location:index.php?cat=wall&view=index_and_add');
            //тут можно придумать месседж об успешности
        }
        else {
            header('Location:index.php?cat=wall&view=index_and_add');
            die();
        }
    }

    return render("wall_types/delete_types", ['wall_information' => $wall_information, 'id' => $id]);

}

function wall_preview()
{
//Проверка, передан ли в GET запросе id материала
    if (isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
    else {
        header('Location:index.php?cat=wall&view=index_and_add');
        die();
    }

//Получение информации об просматриваемой записи
    if (!$wall_information=get_wall_information_by_id($id))
    {
        header('Location:index.php?cat=wall&view=index_and_add');
        die();
    }

    return render("wall_types/preview_types", ['wall_information' => $wall_information, 'id' => $id]);
    
}

function wall_index_and_add()
{
    //Запрашиваем все значения из таблицы Типы_Стен
    $walls=get_all_walls_and_count();

//Проверка на пост запрос о добавлении новой записи
    if (isset($_POST['action']))
    {
        if ($_POST['action']==='add')
        {
            $material=$_POST['material'];
            $description=$_POST['description'];
            add_new_wall($material, $description);
            header("Location:index.php?cat=wall&view=index_and_add");
            die();
        }
    }

    return render("wall_types/wall_types", ['walls' => $walls]);

}
