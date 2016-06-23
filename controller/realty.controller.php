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
    if ($realty_information=get_realty_information($id))
    {
        foreach ($realty_information as $realty_one)
        {
            $rooms=$realty_one['rooms'];
            $floor=$realty_one['floor'];
            $adress=$realty_one['adress'];
            $material=$realty_one['wall_id'];
            $area=$realty_one['area'];
            $price=$realty_one['price'];
            $description=$realty_one['description'];
        }
    }
    else {
        header('Location:index.php?cat=realty&view=index_and_add');
        die();
    }

//Запрашиваем все значения из таблицы Типы_Стен
    $walls=get_all_walls_and_count();


    return render("edit", ['rooms' => $rooms, 'floor' => $floor,'adress' => $adress, 'material' => $material, 'area' => $area, 'price' => $price, 'description' => $description, 'walls' => $walls]);
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
    if ($realty_information=get_realty_information($id))
    {
        foreach ($realty_information as $realty_one)
        {
            $rooms=$realty_one['rooms'];
            $floor=$realty_one['floor'];
            $adress=$realty_one['adress'];
            $material=$realty_one['material'];
            $area=$realty_one['area'];
            $price=$realty_one['price'];
            $description=$realty_one['description'];
        }
    }
    else {
        header('Location:index.php?cat=realty&view=index_and_add');
        die();
    }
    
    return render("delete", ['rooms' => $rooms, 'floor' => $floor,'adress' => $adress, 'material' => $material, 'area' => $area, 'price' => $price, 'description' => $description]);
    
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
    if ($realty_information=get_realty_information($id))
    {
        foreach ($realty_information as $realty_one)
        {
            $rooms=$realty_one['rooms'];
            $floor=$realty_one['floor'];
            $adress=$realty_one['adress'];
            $material=$realty_one['material'];
            $area=$realty_one['area'];
            $price=$realty_one['price'];
            $description=$realty_one['description'];
            $realty_id = $realty_one['realty_id'];
        }
    }
    else {
        header('Location:index.php?cat=realty&view=index_and_add');
        die();
    }
    
    return render("preview", ['rooms' => $rooms, 'floor' => $floor,'adress' => $adress, 'material' => $material, 'area' => $area, 'price' => $price, 'description' => $description, 'realty_id' => $realty_id]);
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
    return render("index", ['realty' => $realty, 'walls' => $walls]);
}