<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= APP_NAME ?> Manage</title>

        <script>
            function confirmUrl(url) {
                if (confirm("Are you sure ?")) {
                    document.location = url;
                }
            }
        </script>

        <?php
        if (!isset($rootPath)) {
            $rootPath = '';
        }
        ?>

        <!-- Bootstrap Core CSS -->
        <link href="<?= $rootPath ?>css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= $rootPath ?>css/sidebar.css" rel="stylesheet">

    </head>

    <body>

        <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand"><a href="<?= BASE_URL ?>"> Home </a></li>
                    <li><a href="<?= BASE_URL ?>/city">Cities</a></li>
                    <li><a href="<?= BASE_URL ?>/logout">Close App</a></li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php require_once $content; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Menu Toggle Script -->
        <script>
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>

    </body>

</html>
