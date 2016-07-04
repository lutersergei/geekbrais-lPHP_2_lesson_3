<!--системные переменные-->
<?php
$title="Просмотр помещения";
$rooms = $realty->rooms;
$floor = $realty->floor;
$adress = $realty->adress;
$id = $realty->realty_id;
$relation_wall_material = $realty->relation_wall_material;
$area = $realty->area;
$price = $realty->price;
$description = $realty->description;
?>

<!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="index.php?cat=realty&view=index_and_add">Список недвижимости и добавление</a></li>
                        <li class="active">Просмотр помещения</li>
                    </ol>
                    <h1 class="page-header">Lesson_3</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Просмотр записи
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Комнат</th>
                                        <th>Этаж</th>
                                        <th>Адресс</th>
                                        <th>Материал стен</th>
                                        <th>Площадь, м<sup>2</sup></th>
                                        <th>Цена, <i class="fa fa-rub" aria-hidden="true"></i> </th>
                                        <th>Описание</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php echo <<<HTML
<tr>
                                            <td>{$rooms}</td>
                                            <td>{$floor}</td>
                                            <td>{$adress}</td>
                                            <td>{$relation_wall_material}</td>
                                            <td>{$area}</td>
                                            <td>{$price}</td>
                                            <td>{$description}</td> 
                                            <td>
                                            <div class="btn-group" role="group">
                                            <a href="index.php?cat=realty&view=edit&id={$id}"  class="btn btn-default btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                                            <a href="index.php?cat=realty&view=delete&id={$id}"  class="btn btn-default btn"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удаление</a>
                                            </div>
                                            </td>
                                            </tr>                                       
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
                            "Облако" тегов
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="pagination">
                                <?php
                                foreach ($relation_tags as $t)
                                {
                                    ?>
                                    <li><a href="index.php?realty=wall&view=group_by_tag&tag_id=<?= $t->tag_id; ?>"><?= $t->title; ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
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