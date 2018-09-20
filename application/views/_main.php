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

        <?php if(isset($datatable)): ?>
            <?php foreach($datatable->css_files as $file): ?>
                <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Styles -->
            <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="<?= base_url(); ?>assets/css/plugins/morris.css" rel="stylesheet">
            <link href="<?= base_url(); ?>assets/css/bootstrap-datepicker.css" rel="stylesheet">
        <?php endif; ?>
        <link href="<?= base_url(); ?>assets/css/sb-admin.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <!--[if lt IE 9]>
        <script src="<?= base_url(); ?>assets/js/pugins/html5shiv.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/pugins/respond.min.js"></script>
        <![endif]-->
        
        <!-- JS -->
        <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>

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
                    <a class="navbar-brand" href="<?= base_url(); ?>"><?= $config['siteName']; ?> <em><?= $pageTitle ?></em></a>
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

                    <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?>
                    </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('info')): ?>
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-exclamation-circle"></i> <?= $this->session->flashdata('info') ?>
                    </div>
                    <?php endif; ?>
                
                    <!-- Page Content -->
                    <?= isset($pageContent) ? $pageContent : "" ?>
                    
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

        <?php if(isset($datatable)): ?>
            <?php foreach($datatable->js_files as $file): ?>
                <script src="<?php echo $file; ?>"></script>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- JS -->
            <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
            <script>
                jQuery(function($){
                    $('[data-toggle="tooltip"]').tooltip();
                });
            </script>
        <?php endif; ?>

        

    </body>
  
</html>