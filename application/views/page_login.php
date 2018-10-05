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

        <link rel="icon" href="<?= base_url(); ?>assets/images/favicon.png">
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.png">
        <link rel="apple-touch-icon" href="<?= base_url(); ?>assets/images/favicon.png">

        <!-- Styles -->
        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/css/signin.css" rel="stylesheet" type="text/css" />
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
                    <a class="navbar-brand logo" href="<?= base_url(); ?>"><span><?= $config['siteName']; ?></span> <small><?= $pageTitle ?></small></a>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">

                <div class="container-fluid">
                
                    <!-- Page Content -->
                    <div class="container">

                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">

                                <form class="form-signin" method="post" action="<?= base_url(); ?>user/login">

                                    <h2 class="form-signin-heading">Please login</h2>

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
                                    
                                    <!-- <label for="inputEmail" class="sr-only">Email</label> -->
                                    <input name="email" class="form-control" placeholder="Email" required="" autofocus="" type="email">
                                    <!-- <label for="inputPassword" class="sr-only">Password</label> -->
                                    <input name="password" class="form-control" placeholder="Password" required="" type="password">
                                    <div class="checkbox">
                                        <label>
                                        <input name="remember" value="true" type="checkbox"> Remember me
                                        </label>
                                    </div>
                                    <button name="postSubmit" value="true" class="btn btn-lg btn-primary btn-block login-submit" type="submit">Login</button>

                                    <span class="forgot-password pull-right"><a href="#" data-toggle="modal" data-target="#passwordModal">Forgot password?</a></span>

                                </form>

                                <!-- Modal start-->
                                <div id="passwordModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Password reset</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>A new password will be sent to your email address if it's valid and enabled.</p>
                                                <form method="post" action="<?= base_url(); ?>user/password_reset">
                                                    <div class="form-group">
                                                        <label for="email">Login email address:</label>
                                                        <input name="email" type="email" class="form-control" placeholder="Email">
                                                    </div>
                                                    <button name="postSubmit" value="true" class="btn btn-primary btn-block" type="submit">Send</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal end-->

                            </div>
                        </div>
                    </div>

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
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

        <!-- <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?= $config['gaId']; ?>');
        </script> -->

    </body>
  
</html>