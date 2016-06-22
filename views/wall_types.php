<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Агентство недвижимости|Стены</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- /.navbar-header -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="index.php"><i class="fa fa-home fa-fw"></i>&nbsp; Объекты недвижимости</a>
                        <a class="active" href="index.php?cat=wall&view=index_and_add"><i class="fa fa-th-list fa-fw"></i>&nbsp; Материалы стен</a>
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Lesson_3. Объекты недвижимости.</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Материалы стен
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Материал</th>
                                        <th>Объектов недвижимости</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($walls as $wall)
                                    {
                                        $disabled=false;
                                        if ($wall['count']>0) $disabled='disabled';
                                        echo <<<HTML
<tr>
                                            <td>{$wall['material']}</td>
                                            <td>{$wall['count']}</td>       
                                            <td>
                                            <div class="btn-group" role="group">
                                            <a href="index.php?cat=wall&view=preview&id={$wall['id']}" class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Просмотр</a>
                                            <a href="index.php?cat=wall&view=edit&id={$wall['id']}" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактирование</a>
                                            <a href="index.php?cat=wall&view=delete&id={$wall['id']}"  class="btn btn-default $disabled"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удаление</a>
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
                            Добавление нового материала
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form method="post" class="form-horizontal">
                                <div class="form-group">
                                    <label for="room" class="col-sm-2 control-label">Название материала</label>
                                    <div class="col-sm-3">
                                        <input type="text" required class="form-control" id="material" name="material" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">Описание</label>
                                    <div class="col-sm-3">
                                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="hidden" name="operation" value="add">
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

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>