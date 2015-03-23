<?php
/**
* The template for displaying all single posts
*
* @package WordPress
* @subpackage Twenty_Thirteen
* @since Twenty Thirteen 1.0
*/

get_header(); ?>
<!--content-blog-->
<div class="container">
    <div class="row">
        <div class="content-blog col-xs-12">
            <div class="row">
                <div class="col-xs-12 col-md-4 blog-posts">
                    <?php get_template_part('featured-posts-block', '');?>
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="row">
                        <div class="post-main">
                            <div class="post full-post">

                                <?php while ( have_posts() ) : the_post(); ?>

                                    <a href="<?php echo home_url()?>/blog/" class="back hidden-xs hidden-sm"><span></span>Back to Blog Home</a>
                                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                    <time datetime="<?php echo the_time('Y-m-d')  ?>"><?php echo the_time(get_option( 'date_format' ) ) ?></time>
                                    <?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
                                        <?php the_post_thumbnail('medium', array( 'class' => 'img-responsive' )); ?>
                                    <?php endif; ?>
                                    <?php the_content()?>
                                    <hr/>
                                    <div class="blog-post-link clearfix">
                                        <div class="post-social pull-left">
                                            <a href="https://twitter.com" class="tw"></a>
                                            <a href="https://www.pinterest.com" class="p"></a>
                                            <a href="https://facebook.com" class="f"></a>
                                            <a href="https://mail.ru" class="mail"></a>
                                            <a href="http://www.sharethis.com/" class="c"></a>
                                        </div>
                                        <?php $commentsNumber = get_comments_number(get_the_ID());?>
                                        <?php if ( comments_open() ) : ?>
                                            <a class="comment pull-left"><span></span><?php echo $commentsNumber?>&nbsp
                                                <?php comments_number( 'comments', 'comment', 'comments' ); ?>
                                            </a>
                                        <?php endif; // comments_open() ?>
                                    </div>
                                    <?php comments_template(); ?>

                                <?php endwhile; ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>