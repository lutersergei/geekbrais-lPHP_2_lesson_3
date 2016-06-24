<!--системные переменные-->
<?php
$title="Изменение помещения";
foreach ($realty as $realty_one)
{
    $rooms=$realty_one['rooms'];
    $floor=$realty_one['floor'];
    $adress=$realty_one['adress'];
    $material=$realty_one['wall_id'];
    $area=$realty_one['area'];
    $price=$realty_one['price'];
    $description=$realty_one['description'];
}
?>

<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php?cat=realty&view=index_and_add">Список недвижимости и добавление</a></li>
                        <li class="active">Изменение помещения</li>
                    </ol>
                    <h1 class="page-header">Lesson_3</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Редактирование записи
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Комнат</th>
                                        <th>Этаж</th>
                                        <th>Адрес</th>
                                        <th>Материал стен</th>
                                        <th>Площадь, м<sup>2</sup></th>
                                        <th>Цена, <i class="fa fa-rub" aria-hidden="true"></i> </th>
                                        <th>Описание</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php echo <<<HTML
                                        <form method="post" action="">
                                            <tr>                                        
                                            <td><input style="width: 80px" type="number" name="rooms" value="{$rooms}"></td>
                                            <td><input style="width: 80px" type="number" name="floor" value="{$floor}"></td>
                                            <td><textarea name="adress" id="" cols="30" rows="2">{$adress}</textarea></td>
HTML;
?>
                                            <td>
                                                <select id="material" name="material" class="form-control">
                                                <?php foreach ($walls as $wall)
                                                {
                                                    $select=false;
                                                    if ($material == $wall['id']) $select="selected";
                                                    echo <<<HTML
                                                    <option {$select} value="{$wall['id']}">{$wall['material']}</option>
HTML;
                                                }
?>                                              </select>
                                            </td>
                                    <?php echo <<<HTML
                                            <td><input style="width: 80px" type="number" name="area" value="{$area}"></td>
                                            <td><input style="width: 120px" type="number" name="price" value="{$price}"></td>
                                            <td><textarea name="description" id="" cols="30" rows="2">{$description}</textarea></td>   
                                            <td><input type="hidden" name="operation" value="edit">
                                            <button class="btn btn-default" type="submit" >Изменить</button></td>
                                            </tr>   
                                         </form>
HTML;
?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->