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
    if (isset($_POST['operation']))
    {
        if ($_POST['operation']==='edit')
        {
            $material=$_POST['material'];
            $description=$_POST['description'];
            update_wall($material,$description, $id);
            header("Location:index.php?cat=wall&view=index_and_add");
            die();
        }
    }

//Получение информации об изменяемой записи для передачи в начальные значения
    if ($wall_information=get_wall_information_by_id($id))
    {
        foreach ($wall_information as $wall)
        {
            $material=$wall['material'];
            $description=$wall['description'];
        }
    }
    else {
        header('Location:index.php?cat=wall&view=index_and_add');
        die();
    }


    return render("edit_types", ['material' => $material, 'description' => $description, 'id' => $id]);

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
    if ($wall_information=get_wall_information_by_id($id))
    {
        foreach ($wall_information as $wall)
        {
            $disabled=false;
            $material=$wall['material'];
            $description=$wall['description'];
            $count=$wall['count'];
            if ($count>0) $disabled='disabled';
        }
    }
    else {
        header('Location:index.php?cat=wall&view=index_and_add');
        die();
    }

//Проверка на пост запрос об удалении записи
    if (isset($_POST['operation']))
    {
        if (($_POST['operation']==='delete') && (!$disabled))
        {
            if (delete_wall_by_id ($id)) header('Location:index.php?cat=wall&view=index_and_add');
            //тут можно придумать месседж об успешности
        }
        else {
            header('Location:index.php?cat=wall&view=index_and_add');
            die();
        }
    }

    return render("delete_types", ['material' => $material, 'description' => $description, 'count' => $count, 'disabled' => $disabled, 'id' => $id]);

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
    if ($wall_information=get_wall_information_by_id($id))
    {
        foreach ($wall_information as $wall)
        {
            $disabled=false;
            $material=$wall['material'];
            $description=$wall['description'];
            $count=$wall['count'];
            if ($count>0) $disabled='disabled';
        }
    }
    else {
        header('Location:index.php?cat=wall&view=index_and_add');
        die();
    }

    return render("preview_types", ['material' => $material, 'description' => $description, 'count' => $count, 'disabled' => $disabled, 'id' => $id]);


}

function wall_index_and_add()
{
    //Запрашиваем все значения из таблицы Типы_Стен
    $walls=get_all_walls_and_count();

//Проверка на пост запрос о добавлении новой записи
    if (isset($_POST['operation']))
    {
        if ($_POST['operation']==='add')
        {
            $material=$_POST['material'];
            $description=$_POST['description'];
            add_new_wall($material, $description);
            header("Location:index.php?cat=wall&view=index_and_add");
            die();
        }
    }

    return render("wall_types", ['walls' => $walls]);

}