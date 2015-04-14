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
    <![endif]-->
    <!--social networks-->
    <script charset="utf-8" type="text/javascript">var switchTo5x=true;</script>
    <script charset="utf-8" type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script charset="utf-8" type="text/javascript">stLight.options({"publisher":"wp.27ff5b1d-2652-434c-afbd-1b54c169302d"});var st_type="wordpress4.1.1";</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class();?>>
<?php
    //Add background class for pages login and forgot-password
    $arr = explode('/', $_SERVER['REQUEST_URI']);

    if(!empty($arr) && isset($arr[1]) && ($arr[1] == 'login' || $arr[1] == 'forgot-password' || $arr[1] == 'reset-password')){
        $wrapperClass = 'bg-profile';
    }
    else{
        $wrapperClass = '';
    }
?>
<div class="wrapper <?php echo $wrapperClass;?>">
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
                                        <a class="navbar-brand" href="<?php echo home_url()?>">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" width="252" height="63" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse navbar-collapse" id="top-1">
                                <?php wp_nav_menu(array('menu' => 'top-menu', 'menu_class' => 'nav navbar-nav', 'container' => false)); ?>
                                <?php if(!is_user_logged_in()):?>
                                <p class="navbar-text navbar-right">

                                        <a href="<?php echo home_url()?>/login" class="navbar-link">LOG IN<span class="back-link"></span></a>




                                </p>
                                <?php else:
                                    $current_user = wp_get_current_user();
                                    ?>
                                <div class="logout-menu">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li>
                                            <a href="account.html"><?php echo $current_user->user_firstname?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo wp_logout_url()?>" class="color-gray">LOG OUT</a>
                                        </li>
                                    </ul>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>