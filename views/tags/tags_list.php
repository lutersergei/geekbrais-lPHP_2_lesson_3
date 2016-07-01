<!--системные переменные-->
<?php
$title="Список тегов";
?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>Список тегов</li>
                </ol>
                <h1 class="page-header">Lesson_3</h1>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Теги
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Название</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($tags as $tag)
                                {
                                    echo <<<HTML
<tr>
                                            <td>{$tag['tag_id']}</td>
                                            <td>{$tag['title']}</td>       
                                            <td>
                                            <div class="btn-group" role="group">
                                            <a href="../index.php?cat=realty_tags&view=preview&id={$tag['tag_id']}" class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Просмотр</a>
                                            <a href="../index.php?cat=realty_tags&view=edit&id={$tag['tag_id']}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                                            <a href="../index.php?cat=realty_tags&view=delete&id={$tag['tag_id']}"  class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удаление</a>
                                            </div>
                                            </td>
                                            </tr>
                                            
HTML;
                                }?>

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
                        Добавление нового тега
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="room" class="col-sm-2 control-label">Название</label>
                                <div class="col-sm-3">
                                    <input type="text" required class="form-control" id="title" name="title" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="hidden" name="action" value="add">
                                    <button type="submit" class="btn btn-default">Добавить</button>
                                </div>
                            </div>
                        </form>
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
