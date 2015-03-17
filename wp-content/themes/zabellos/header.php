<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('«', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link href="<?php echo get_template_directory_uri(); ?>/font/fonts.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/header_menu.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="container-fluid menu-container-fluid">
            <div class="row">
                <a class="logo" href="<?php echo home_url()?>">
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
                                <?php wp_nav_menu(array('menu' => 'top-menu', 'menu_class' => 'nav navbar-nav', 'container' => false)); ?>
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