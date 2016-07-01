<?php
/**
 * Created by PhpStorm.
 * User: drKox
 * Date: 30.06.2016
 * Time: 14:21
 */
//системные переменные
foreach ($tag_information as $tag)
{
    $tag_title=$tag['title'];
}
$title="Просмотр тега";
?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="index.php?cat=realty_tags&view=index_and_add">Список тегов</a></li>
                    <li class="active">Просмотр тега</li>
                </ol>
                <h1 class="page-header">Lesson_3</h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Просмотр тега
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php echo <<<HTML
<tr>
                                            <td>{$tag_title}</td>
                                            <td>
                                            <div class="btn-group" role="group">
                                            <a href="index.php?cat=realty_tags&view=edit&id={$id}"  class="btn btn-default btn"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                                            <a href="index.php?cat=realty_tags&view=delete&id={$id}"  class="btn btn-default btn"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удаление</a>
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
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->