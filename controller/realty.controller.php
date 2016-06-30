<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 22.06.2016
 * Time: 11:40
 */
function realty_edit()
{
    //Проверка, передан ли в GET запросе id объекта недвижимости
    if (isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
    else {
        header('Location:index.php?cat=realty&view=index_and_add');
        die();
    }

//Проверка на пост запрос об изменеии записи
    if (isset($_POST['operation']))
    {
        if ($_POST['operation']==='edit')
        {
            $rooms=$_POST['rooms'];
            $floor=$_POST['floor'];
            $adress=$_POST['adress'];
            $material=$_POST['material'];
            $area=$_POST['area'];
            $price=$_POST['price'];
            $description=$_POST['description'];
            update_realty($rooms, $floor, $adress, $material, $area, $price, $description, $id);
            header("Location:index.php?cat=realty&view=index_and_add");
            die();
        }
    }

//Получение информации об изменяемой записи для передачи в начальные значения
    if (!$realty_information=get_realty_information($id))
    {
        header('Location:index.php?cat=realty&view=index_and_add');
        die();
    }

//Запрашиваем все значения из таблицы Типы_Стен
    $walls=get_all_walls_and_count();


    return render("realty/edit", ['realty' => $realty_information, 'walls' => $walls]);
}

function realty_delete()
{
    //Проверка, передан ли в GET запросе id объекта недвижимости
    if (isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
    else {
        header('Location:index.php?cat=realty&view=index_and_add');
        die();
    }

//Проверка на пост запрос об удалении записи
    if (isset($_POST['operation']))
    {
        if ($_POST['operation']==='delete')
        {
            if (delete_by_id ($id)) header('Location:index.php?cat=realty&view=index_and_add');
            //тут можно придумать месседж об успешности
        }
        else header('Location:index.php?cat=realty&view=index_and_add');
    }

//Получение информации об просматриваемой записи
    if (!$realty_information=get_realty_information($id))
    {
        header('Location:index.php?cat=realty&view=index_and_add');
        die();
    }
    return render("realty/delete", ['realty' => $realty_information]);
}

function realty_preview()
{
    //Проверка, передан ли в GET запросе id объекта недвижимости
    if (isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
    else {
        header('Location:index.php?cat=realty&view=index_and_add');
        die();
    }

//Получение информации об просматриваемой записи
    if (!$realty_information=get_realty_information($id))
    {
        header('Location:index.php?cat=realty&view=index_and_add');
        die();
    }

    return render("realty/preview", ['realty' => $realty_information]);
}

function realty_index_and_add()
{
    //Запрашиваем все значения из таблицы Недвижимость, отсортированые по id
    $realty=get_all_realty_order_by_id();

//Запрашиваем все значения из таблицы Типы_Стен
    $walls=get_all_walls_and_count();

//Проверка на пост запрос о добавлении новой записи
    if (isset($_POST['operation']))
    {
        if ($_POST['operation']==='add')
        {
            $room=$_POST['room'];
            $floor=$_POST['floor'];
            $adress=$_POST['adress'];
            $material=$_POST['material'];
            $area=$_POST['area'];
            $price=$_POST['price'];
            $description=$_POST['description'];
            add_new_realty($room, $floor, $adress, $material, $area, $price, $description);
            header("Location:index.php?cat=realty&view=index_and_add");
            die();
        }
    }
    return render("realty/index", ['realty' => $realty, 'walls' => $walls]);
}

function realty_group_by_wall()
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
    $realty=get_realty_group_by_wall($id);

    //Запрашиваем все значения из таблицы Типы_Стен
    $walls=get_all_walls_and_count();

    //Проверка на пост запрос о добавлении новой записи
    if (isset($_POST['operation']))
    {
        if ($_POST['operation']==='add')
        {
            $room=$_POST['room'];
            $floor=$_POST['floor'];
            $adress=$_POST['adress'];
            $material=$_POST['material'];
            $area=$_POST['area'];
            $price=$_POST['price'];
            $description=$_POST['description'];
            add_new_realty($room, $floor, $adress, $material, $area, $price, $description);
            header("Location:index.php?cat=realty&view=index_and_add");
            die();
        }
    }
    return render("realty/index", ['realty' => $realty, 'walls' => $walls]);
}