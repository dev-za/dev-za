<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link href="<?php echo get_template_directory_uri(); ?>/font/fonts.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<body>
    <header>
        <div class="container-fluid menu-container-fluid">
            <div class="row">
                <a class="logo" href="index.html">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" width="252" height="63" alt="" />
                </a>
                <!--navbar-->
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="navbar-header">
                                <div class="container">
                                    <div class="row">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-1">
                                            <span class="sr-only">Nav</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <a class="navbar-brand" href="index.html">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" width="252" height="63" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse navbar-collapse" id="top-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="gallery.html">Gallery</a><span class="back-s"></span></li>
                                    <li><a href="how-it-works.html">How it works</a><span class="back-s"></span></li>
                                    <li><a href="help.html">Help</a></li>
                                </ul>
                                <p class="navbar-text navbar-right">
                                    <a href="profile.html" class="navbar-link">My profile<span class="back-link"></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>