<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $config['siteName']; ?> / <?= $pageTitle ?></title>

        <meta name="author" content="<?= $config['metaData']['author']; ?>">
        <meta name="description" content="<?= $config['metaData']['description']; ?>">
        <meta name="keywords" content="<?= $config['metaData']['keywords']; ?>">
        <meta name="robots" content="<?= $config['metaData']['robots']; ?>">

        <link rel="icon" href="<?= base_url(); ?>assets/favicon.png">
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/favicon.png">
        <link rel="apple-touch-icon" href="<?= base_url(); ?>assets/favicon.png">

        <!-- Styles -->
        <?php foreach($datatable->css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>

        <link href="<?= base_url(); ?>assets/css/sb-admin.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand logo" href="<?= base_url(); ?>"><span><?= $config['siteName']; ?></span> <small><?= $pageTitle ?></small></a>
                </div>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] && isset($_SESSION['userType'])): ?>
                            <?php foreach($config['menu'] as $menu): ?>
                                <?php if($_SESSION['userType'] >= $menu['level']): ?>
                                <li class="<?= $pageTitle == $menu['name'] ? 'active' : '' ?>">
                                    <a href="<?= base_url() . $menu['controller']; ?>"><i class="fa fa-fw <?= $menu['ico']; ?>"></i> <?= $menu['name']; ?></a>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <li>
                            <a href="<?= base_url() ?>"><i class="fa fa-fw fa-key"></i> Login</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">

                <div class="container-fluid">
                                
                    <!-- Page Content -->
                    <div style="margin-top:10px"></div>
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <ol class="breadcrumb">
                                <li>
                                    <a href="javascript:history.back()"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-table"></i> <?= $pageSubtitle ?>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
                    
                    <!-- Table -->
                    <?= $datatable->output; ?>

                    <div style="margin-bottom:10px">&#160;</div>
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

            <footer>
                <div class="footer navbar-fixed-bottom">
                    Copyright <a href="http://www.cianaweb.it">@fvlgnn</a> (2008-<?= date('Y'); ?>) <?=  (ENVIRONMENT === 'development') ?  '| Render {elapsed_time} on CodeIgniter (' . ENVIRONMENT . ') ' . CI_VERSION . '' : '' ?>
                </div>
            </footer>

        </div>
        <!-- /#wrapper -->

        <!-- JS -->
        <?php foreach($datatable->js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>

    </body>
  
</html>