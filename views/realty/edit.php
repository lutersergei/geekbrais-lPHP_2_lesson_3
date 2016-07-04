<!--системные переменные-->
<?php
$title="Изменение помещения";
$rooms = $realty->rooms;
$floor = $realty->floor;
$adress = $realty->adress;
$id = $realty->realty_id;
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
                                                    if ($realty->wall_id == $wall->id) $select="selected";
                                                    echo <<<HTML
                                                    <option {$select} value="{$wall->id}">{$wall->material}</option>\n
HTML;
                                                }
?>                                              </select>
                                            </td>
                                    <?php echo <<<HTML
                                            <td><input style="width: 80px" type="number" name="area" value="{$realty->area}"></td>
                                            <td><input style="width: 120px" type="number" name="price" value="{$realty->price}"></td>
                                            <td><textarea name="description" id="" cols="30" rows="2">{$realty->description}</textarea></td>   
                                            <td><input type="hidden" name="action" value="edit">
                                            <td><input type="hidden" name="id" value="{$realty->realty_id}">
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Добавление тега
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <form method="post" class="form-horizontal">
                                        <select id="tag_id" name="tag_id" class="form-control">

                                            <?php foreach ($tags as $tag) {
                                                echo <<<HTML
           <option value="{$tag->tag_id}">{$tag->title}</option> \n
HTML;
                                            }     ?>                                      </select>
                                        <hr>
                                        <input type="hidden" name="action" value="add_tag">
                                        <input type="hidden" name="id" value="<?= $realty->realty_id ?>">
                                        <button type="submit" class="btn btn-default">Добавить</button>
                                    </form>
                                </div>
                                <div class="col-lg-10">
                                    <?php
                                    foreach ($relation_tags as $t)
                                    {
                                        ?>
                                        <form style="display: inline" method="post">
                                            <input type="hidden" name="action" value="delete_tag"/>
                                            <input type="hidden" name="id" value="<?= $id ?>">
                                            <input type="hidden" name="relation_id" value="<?= $t->relation_id ?>"/>
                                            <button class="btn" style="display: inline"><?= $t->title; ?> <i class="fa fa-times"></i></button></form>
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->